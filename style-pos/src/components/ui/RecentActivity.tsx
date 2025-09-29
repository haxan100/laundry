import React from 'react';
import { 
  Package, CheckCircle, Clock, User, Truck,
  MoreHorizontal 
} from 'lucide-react';

interface Activity {
  id: string;
  type: 'order_created' | 'order_completed' | 'order_picked_up' | 'customer_added';
  description: string;
  time: string;
  user: string;
  details?: string;
}

const RecentActivity: React.FC = () => {
  const activities: Activity[] = [
    {
      id: '1',
      type: 'order_created',
      description: 'Order baru dibuat - LD-2025-001',
      time: '5 menit lalu',
      user: 'Kasir 1',
      details: 'Budi Santoso - Cuci Setrika 7kg'
    },
    {
      id: '2',
      type: 'order_completed',
      description: 'Order selesai - LD-2025-002',
      time: '15 menit lalu',
      user: 'Operator',
      details: 'Sari Dewi - Cuci Express 10kg'
    },
    {
      id: '3',
      type: 'order_picked_up',
      description: 'Order diambil - LD-2025-003',
      time: '32 menit lalu',
      user: 'Kurir 1',
      details: 'Ahmad Rizki - Delivery completed'
    },
    {
      id: '4',
      type: 'customer_added',
      description: 'Pelanggan baru terdaftar',
      time: '1 jam lalu',
      user: 'Admin',
      details: 'Rina Wati - Member Silver'
    },
    {
      id: '5',
      type: 'order_created',
      description: 'Order baru dibuat - LD-2025-005',
      time: '1.5 jam lalu',
      user: 'Kasir 2',
      details: 'Maya Sari - Sepatu Sneakers 2 pasang'
    }
  ];

  const getActivityIcon = (type: string) => {
    switch (type) {
      case 'order_created':
        return <Package size={16} className="text-blue-600 dark:text-blue-400" />;
      case 'order_completed':
        return <CheckCircle size={16} className="text-green-600 dark:text-green-400" />;
      case 'order_picked_up':
        return <Truck size={16} className="text-purple-600 dark:text-purple-400" />;
      case 'customer_added':
        return <User size={16} className="text-orange-600 dark:text-orange-400" />;
      default:
        return <Clock size={16} className="text-gray-600 dark:text-gray-400" />;
    }
  };

  const getActivityColor = (type: string) => {
    switch (type) {
      case 'order_created':
        return 'bg-blue-100 dark:bg-blue-900/20';
      case 'order_completed':
        return 'bg-green-100 dark:bg-green-900/20';
      case 'order_picked_up':
        return 'bg-purple-100 dark:bg-purple-900/20';
      case 'customer_added':
        return 'bg-orange-100 dark:bg-orange-900/20';
      default:
        return 'bg-gray-100 dark:bg-gray-900/20';
    }
  };

  return (
    <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
      <div className="flex items-center justify-between mb-6">
        <h2 className="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
          <Clock size={20} className="mr-2" />
          Aktivitas Terbaru
        </h2>
        <button className="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 text-sm font-medium">
          Lihat Semua
        </button>
      </div>

      <div className="space-y-4">
        {activities.map((activity) => (
          <div key={activity.id} className="flex items-start space-x-3 group hover:bg-gray-50 dark:hover:bg-gray-700/50 p-2 rounded-lg -mx-2 transition-colors">
            <div className={`w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 ${getActivityColor(activity.type)}`}>
              {getActivityIcon(activity.type)}
            </div>
            <div className="flex-1 min-w-0">
              <div className="flex items-center justify-between">
                <p className="text-sm font-medium text-gray-900 dark:text-white truncate">
                  {activity.description}
                </p>
                <button className="opacity-0 group-hover:opacity-100 transition-opacity">
                  <MoreHorizontal size={16} className="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" />
                </button>
              </div>
              {activity.details && (
                <p className="text-xs text-gray-600 dark:text-gray-400 mt-1">
                  {activity.details}
                </p>
              )}
              <div className="flex items-center justify-between mt-2">
                <p className="text-xs text-gray-500 dark:text-gray-500">
                  {activity.time}
                </p>
                <p className="text-xs text-gray-500 dark:text-gray-500">
                  oleh {activity.user}
                </p>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

export default RecentActivity;