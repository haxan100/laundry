import React, { useState } from 'react';
import { 
  Clock, AlertCircle, CheckCircle, Package, 
  ArrowRight, Eye, MessageSquare, Camera
} from 'lucide-react';

interface Order {
  id: string;
  orderNumber: string;
  customer: string;
  service: string;
  weight: number;
  priority: 'normal' | 'express' | 'urgent';
  estimatedFinish: string;
  notes?: string;
  qcChecklist?: {
    stainRemoval: boolean;
    ironing: boolean;
    packaging: boolean;
  };
}

interface Column {
  id: string;
  title: string;
  color: string;
  orders: Order[];
}

const ProductionBoard: React.FC = () => {
  const [draggedOrder, setDraggedOrder] = useState<string | null>(null);

  const initialColumns: Column[] = [
    {
      id: 'checkin',
      title: 'Check-in',
      color: 'blue',
      orders: [
        {
          id: '1',
          orderNumber: 'LD-2025-001',
          customer: 'Budi Santoso',
          service: 'Cuci Setrika Kiloan',
          weight: 7,
          priority: 'normal',
          estimatedFinish: '2025-01-15 16:00'
        },
        {
          id: '2',
          orderNumber: 'LD-2025-005',
          customer: 'Sinta Maharani',
          service: 'Cuci Express',
          weight: 3,
          priority: 'express',
          estimatedFinish: '2025-01-15 12:00'
        }
      ]
    },
    {
      id: 'wash',
      title: 'Washing',
      color: 'purple',
      orders: [
        {
          id: '3',
          orderNumber: 'LD-2025-002',
          customer: 'Ahmad Rizki',
          service: 'Cuci Kering Kiloan',
          weight: 5,
          priority: 'normal',
          estimatedFinish: '2025-01-15 14:00',
          notes: 'Pisahkan pakaian putih'
        }
      ]
    },
    {
      id: 'dry',
      title: 'Drying',
      color: 'orange',
      orders: [
        {
          id: '4',
          orderNumber: 'LD-2025-003',
          customer: 'Rina Wati',
          service: 'Cuci Setrika Kiloan',
          weight: 4,
          priority: 'urgent',
          estimatedFinish: '2025-01-15 13:00'
        }
      ]
    },
    {
      id: 'iron',
      title: 'Ironing',
      color: 'yellow',
      orders: []
    },
    {
      id: 'qc',
      title: 'Quality Check',
      color: 'indigo',
      orders: [
        {
          id: '5',
          orderNumber: 'LD-2025-004',
          customer: 'Dedi Kurnia',
          service: 'Sepatu Sneakers',
          weight: 2,
          priority: 'normal',
          estimatedFinish: '2025-01-15 15:00',
          qcChecklist: {
            stainRemoval: true,
            ironing: false,
            packaging: false
          }
        }
      ]
    },
    {
      id: 'ready',
      title: 'Ready',
      color: 'green',
      orders: [
        {
          id: '6',
          orderNumber: 'LD-2025-006',
          customer: 'Maya Sari',
          service: 'Cuci Kering Kiloan',
          weight: 6,
          priority: 'normal',
          estimatedFinish: '2025-01-15 10:00'
        }
      ]
    }
  ];

  const [columns, setColumns] = useState<Column[]>(initialColumns);

  const getPriorityColor = (priority: string) => {
    switch (priority) {
      case 'urgent':
        return 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300';
      case 'express':
        return 'bg-orange-100 text-orange-800 dark:bg-orange-900/20 dark:text-orange-300';
      default:
        return 'bg-gray-100 text-gray-800 dark:bg-gray-900/20 dark:text-gray-300';
    }
  };

  const getColumnColor = (color: string) => {
    switch (color) {
      case 'blue':
        return 'border-blue-200 dark:border-blue-800 bg-blue-50 dark:bg-blue-900/10';
      case 'purple':
        return 'border-purple-200 dark:border-purple-800 bg-purple-50 dark:bg-purple-900/10';
      case 'orange':
        return 'border-orange-200 dark:border-orange-800 bg-orange-50 dark:bg-orange-900/10';
      case 'yellow':
        return 'border-yellow-200 dark:border-yellow-800 bg-yellow-50 dark:bg-yellow-900/10';
      case 'indigo':
        return 'border-indigo-200 dark:border-indigo-800 bg-indigo-50 dark:bg-indigo-900/10';
      case 'green':
        return 'border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900/10';
      default:
        return 'border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-900/10';
    }
  };

  const isOverdue = (estimatedFinish: string) => {
    return new Date(estimatedFinish) < new Date();
  };

  const handleDragStart = (e: React.DragEvent, orderId: string) => {
    setDraggedOrder(orderId);
    e.dataTransfer.effectAllowed = 'move';
  };

  const handleDragOver = (e: React.DragEvent) => {
    e.preventDefault();
    e.dataTransfer.dropEffect = 'move';
  };

  const handleDrop = (e: React.DragEvent, targetColumnId: string) => {
    e.preventDefault();
    
    if (!draggedOrder) return;

    const sourceColumn = columns.find(col => 
      col.orders.some(order => order.id === draggedOrder)
    );
    const targetColumn = columns.find(col => col.id === targetColumnId);
    
    if (!sourceColumn || !targetColumn || sourceColumn.id === targetColumn.id) {
      setDraggedOrder(null);
      return;
    }

    const orderToMove = sourceColumn.orders.find(order => order.id === draggedOrder);
    if (!orderToMove) return;

    setColumns(prev => prev.map(col => {
      if (col.id === sourceColumn.id) {
        return {
          ...col,
          orders: col.orders.filter(order => order.id !== draggedOrder)
        };
      }
      if (col.id === targetColumn.id) {
        return {
          ...col,
          orders: [...col.orders, orderToMove]
        };
      }
      return col;
    }));

    setDraggedOrder(null);
  };

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="flex items-center justify-between">
        <div>
          <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
            Produksi Board
          </h1>
          <p className="text-gray-600 dark:text-gray-400 mt-1">
            Kelola proses produksi laundry dengan sistem kanban
          </p>
        </div>
        <div className="flex items-center space-x-3">
          <div className="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
            <AlertCircle size={16} className="text-red-500" />
            <span>2 order terlambat</span>
          </div>
          <button className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center space-x-2">
            <Package size={16} />
            <span>Scan QR Update</span>
          </button>
        </div>
      </div>

      {/* Production Board */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 min-h-screen">
        {columns.map((column) => (
          <div
            key={column.id}
            className={`rounded-lg border-2 border-dashed p-4 ${getColumnColor(column.color)}`}
            onDragOver={handleDragOver}
            onDrop={(e) => handleDrop(e, column.id)}
          >
            <div className="flex items-center justify-between mb-4">
              <h3 className="font-semibold text-gray-900 dark:text-white flex items-center">
                {column.title}
                <span className="ml-2 px-2 py-1 bg-white dark:bg-gray-800 rounded-full text-xs">
                  {column.orders.length}
                </span>
              </h3>
            </div>

            <div className="space-y-3">
              {column.orders.map((order) => (
                <div
                  key={order.id}
                  draggable
                  onDragStart={(e) => handleDragStart(e, order.id)}
                  className={`bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700 cursor-move hover:shadow-md transition-shadow
                    ${isOverdue(order.estimatedFinish) ? 'ring-2 ring-red-500 ring-opacity-50' : ''}
                    ${draggedOrder === order.id ? 'opacity-50' : ''}
                  `}
                >
                  <div className="flex items-start justify-between mb-2">
                    <div className="flex-1">
                      <div className="font-medium text-sm text-gray-900 dark:text-white">
                        {order.orderNumber}
                      </div>
                      <div className="text-xs text-gray-600 dark:text-gray-400 mt-1">
                        {order.customer}
                      </div>
                    </div>
                    <span className={`px-2 py-1 rounded-full text-xs font-medium ${getPriorityColor(order.priority)}`}>
                      {order.priority}
                    </span>
                  </div>

                  <div className="text-xs text-gray-600 dark:text-gray-400 mb-3">
                    <div>{order.service}</div>
                    <div className="flex items-center justify-between mt-1">
                      <span>{order.weight} kg</span>
                      <span className={isOverdue(order.estimatedFinish) ? 'text-red-600 dark:text-red-400 font-medium' : ''}>
                        {new Date(order.estimatedFinish).toLocaleTimeString('id-ID', { 
                          hour: '2-digit', 
                          minute: '2-digit' 
                        })}
                      </span>
                    </div>
                  </div>

                  {order.notes && (
                    <div className="flex items-center text-xs text-orange-600 dark:text-orange-400 mb-3">
                      <MessageSquare size={12} className="mr-1" />
                      <span className="truncate">{order.notes}</span>
                    </div>
                  )}

                  {order.qcChecklist && (
                    <div className="space-y-1 mb-3">
                      <div className="text-xs font-medium text-gray-700 dark:text-gray-300">QC Checklist:</div>
                      <div className="space-y-1">
                        <label className="flex items-center text-xs">
                          <input 
                            type="checkbox" 
                            checked={order.qcChecklist.stainRemoval}
                            className="mr-2 w-3 h-3"
                            readOnly
                          />
                          <span>Noda hilang</span>
                        </label>
                        <label className="flex items-center text-xs">
                          <input 
                            type="checkbox" 
                            checked={order.qcChecklist.ironing}
                            className="mr-2 w-3 h-3"
                            readOnly
                          />
                          <span>Setrika rapi</span>
                        </label>
                        <label className="flex items-center text-xs">
                          <input 
                            type="checkbox" 
                            checked={order.qcChecklist.packaging}
                            className="mr-2 w-3 h-3"
                            readOnly
                          />
                          <span>Kemasan baik</span>
                        </label>
                      </div>
                    </div>
                  )}

                  <div className="flex items-center justify-between">
                    <div className="flex space-x-1">
                      <button className="p-1 text-gray-400 hover:text-blue-600 dark:hover:text-blue-400">
                        <Eye size={14} />
                      </button>
                      <button className="p-1 text-gray-400 hover:text-green-600 dark:hover:text-green-400">
                        <MessageSquare size={14} />
                      </button>
                      <button className="p-1 text-gray-400 hover:text-purple-600 dark:hover:text-purple-400">
                        <Camera size={14} />
                      </button>
                    </div>
                    {isOverdue(order.estimatedFinish) && (
                      <AlertCircle size={14} className="text-red-500" />
                    )}
                  </div>
                </div>
              ))}
            </div>

            {column.orders.length === 0 && (
              <div className="text-center py-8 text-gray-400 dark:text-gray-500">
                <Package size={32} className="mx-auto mb-2 opacity-50" />
                <p className="text-sm">Kosong</p>
              </div>
            )}
          </div>
        ))}
      </div>

      {/* Legend */}
      <div className="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
        <h3 className="font-medium text-gray-900 dark:text-white mb-3">Keterangan:</h3>
        <div className="flex flex-wrap gap-4 text-sm">
          <div className="flex items-center space-x-2">
            <div className="w-3 h-3 bg-red-500 rounded-full"></div>
            <span className="text-gray-600 dark:text-gray-400">Terlambat dari estimasi</span>
          </div>
          <div className="flex items-center space-x-2">
            <span className="px-2 py-1 bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300 rounded-full text-xs">urgent</span>
            <span className="text-gray-600 dark:text-gray-400">Prioritas urgent</span>
          </div>
          <div className="flex items-center space-x-2">
            <span className="px-2 py-1 bg-orange-100 text-orange-800 dark:bg-orange-900/20 dark:text-orange-300 rounded-full text-xs">express</span>
            <span className="text-gray-600 dark:text-gray-400">Express service</span>
          </div>
          <div className="flex items-center space-x-2">
            <MessageSquare size={14} className="text-orange-500" />
            <span className="text-gray-600 dark:text-gray-400">Ada catatan khusus</span>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ProductionBoard;