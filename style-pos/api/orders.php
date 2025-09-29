<?php
require_once '../config.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];
$conn = getConnection();

switch($method) {
    case 'GET':
        getOrders($conn);
        break;
    case 'POST':
        createOrder($conn);
        break;
    case 'PUT':
        updateOrder($conn);
        break;
    case 'DELETE':
        deleteOrder($conn);
        break;
    default:
        jsonResponse(['error' => 'Method not allowed'], 405);
}

function getOrders($conn) {
    $sql = "SELECT o.*, c.name as customer_name, c.phone as customer_phone 
            FROM orders o 
            LEFT JOIN customers c ON o.customer_id = c.id 
            ORDER BY o.created_at DESC";
    
    $result = $conn->query($sql);
    $orders = [];
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    }
    
    jsonResponse($orders);
}

function createOrder($conn) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $customer_id = getOrCreateCustomer($conn, $data['customer_name'], $data['customer_phone']);
    
    $sql = "INSERT INTO orders (customer_id, service_type, weight, notes, status, total, created_at) 
            VALUES (?, ?, ?, ?, 'pending', ?, NOW())";
    
    $total = calculateTotal($data['service_type'], $data['weight']);
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isdsd", $customer_id, $data['service_type'], $data['weight'], $data['notes'], $total);
    
    if ($stmt->execute()) {
        jsonResponse(['success' => true, 'order_id' => $conn->insert_id]);
    } else {
        jsonResponse(['error' => 'Failed to create order'], 500);
    }
}

function getOrCreateCustomer($conn, $name, $phone) {
    $sql = "SELECT id FROM customers WHERE phone = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['id'];
    } else {
        $sql = "INSERT INTO customers (name, phone, created_at) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $name, $phone);
        $stmt->execute();
        return $conn->insert_id;
    }
}

function calculateTotal($service_type, $weight) {
    $prices = [
        'wash-dry' => 8000,
        'wash-iron' => 10000,
        'dry-clean' => 15000,
        'iron-only' => 5000
    ];
    
    return $prices[$service_type] * $weight;
}

function updateOrder($conn) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $sql = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $data['status'], $data['id']);
    
    if ($stmt->execute()) {
        jsonResponse(['success' => true]);
    } else {
        jsonResponse(['error' => 'Failed to update order'], 500);
    }
}

function deleteOrder($conn) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM orders WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        jsonResponse(['success' => true]);
    } else {
        jsonResponse(['error' => 'Failed to delete order'], 500);
    }
}
?>