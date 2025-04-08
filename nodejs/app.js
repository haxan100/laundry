require("dotenv").config();
const express = require("express");
const http = require("http");
const socketIo = require("socket.io");
const cors = require("cors");

const app = express();
const server = http.createServer(app);
const io = socketIo(server, {
	cors: {
		origin: "*",
		methods: ["GET", "POST"],
	},
});

app.use(cors());
app.use(express.json());

// Saat client Flutter atau web terhubung
io.on("connection", (socket) => {
	console.log("Client connected:", socket.id);

	// ✅ **Client Join ke Room berdasarkan ID transaksi**
	socket.on("join_room", (tradeId, callback) => {
		socket.join(tradeId);
		console.log(`✅ User ${socket.id} joined room: ${tradeId}`);

		// Kirim konfirmasi ke client
		if (callback) callback({ success: true, room: tradeId });
	});

	// Kirim event ke semua client yang terhubung
	socket.on("new_transaction", (data) => {
		console.log("New transaction event:", data);
		io.emit("refresh_datatable", data); // Notif ke Admin Dashboard
		io.emit("flutter_notification", data); // Notif ke Flutter
	});
	// ✅ **Terima event dari API & broadcast hanya ke Room tertentu**
	socket.on("update_trade_kelengkapan", (data) => {
		console.log("Mengirim update ke room:", data.id_transaction_tradein);

		// **Kirim hanya ke room yang sesuai dengan ID transaksi**
		io.to(data.id_transaction_tradein).emit(
			"update_trade_" + data.id_transaction_tradein,
			data
		);
	});

	socket.on("disconnect", () => {
		console.log("Client disconnected:", socket.id);
	});
});

// API untuk menerima notifikasi dari CI3
app.post("/send-notification", (req, res) => {
	const { event, data } = req.body;
	console.log("event:", event);
	
	if (event === "new_transaction") {
		console.log(`🚀 Broadcasting new transaction:`, data);
		io.emit("refresh_datatable", data);
		io.emit("flutter_notification", data);
	}
	if (!event || !data || !data.id_transaction_tradein) {
		console.log("❌ Invalid request data received");
		return res
			.status(400)
			.json({ success: false, message: "Invalid request data" });
	}

	console.log(
		`📢 Received event: ${event} for transaction ID: ${data.id_transaction_tradein}`
	);

	// **Cek apakah socket sudah ada di room**
	const roomClients = io.sockets.adapter.rooms.get(data.id_transaction_tradein);
	console.log(
		`👥 Clients in room ${data.id_transaction_tradein}:`,
		roomClients ? [...roomClients] : "No clients"
	);

	// **Pastikan ada client di room sebelum mengirim event**
	if (roomClients && roomClients.size > 0) {
		io.to(data.id_transaction_tradein).emit(
			"update_trade_" + data.id_transaction_tradein,
			data
		);
		console.log(`✅ Event sent to room ${data.id_transaction_tradein}`);
	} else {
		console.log(
			`⚠️ No clients in room ${data.id_transaction_tradein}, event not sent.`
		);
	}

	res.status(200).json({ success: true, message: "Notification sent to room" });
});
// Jalankan server
const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
	console.log(`Realtime server running on port ${PORT}`);
});
