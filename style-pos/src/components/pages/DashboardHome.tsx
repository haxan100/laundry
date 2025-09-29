import React from 'react';
import { 
  TrendingUp, TrendingDown, DollarSign, Package, Clock, 
  Users, AlertCircle, CheckCircle, BarChart3, Calendar,
  Plus, Scan, Printer, MessageSquare
} from 'lucide-react';
import StatsCard from '../ui/StatsCard';
import QuickActionCard from '../ui/QuickActionCard';
import RecentActivity from '../ui/RecentActivity';
import ProductionChart from '../ui/ProductionChart';

const DashboardHome: React.FC = () => {
  const stats = [
    {
      title: 'Omzet Hari Ini',
      value: 'Rp 2,450,000',
      change: '+12.5%',
      changeType: 'positive' as const,
      icon: <DollarSign className="w-6 h-6" />,
      color: 'green'
    },
    {
      title: 'Order Aktif',
      value: '47',
      change: '+8 dari kemarin',
      changeType: 'positive' as const,
      icon: <Package className="w-6 h-6" />,
      color: 'blue'
    },
    {
      title: 'Antrian Produksi',
      value: '23',
      change: '-5 dari kemarin',
      changeType: 'negative' as const,
      icon: <Clock className="w-6 h-6" />,
      color: 'orange'
    },
    {
      title: 'Pelanggan Hari Ini',
      value: '31',
      change: '+15.2%',
      changeType: 'positive' as const,
      icon: <Users className="w-6 h-6" />,
      color: 'purple'
    }
  ];

  const quickActions = [
    {
      title: 'Buat Order Baru',
      description: 'Tambah order kiloan/satuan',
      icon: <Plus className="w-8 h-8" />,
      color: 'blue',
      shortcut: 'Ctrl+N'
    },
    {
      title: 'Scan Barcode',
      description: 'Update status via QR/Barcode',
      icon: <Scan className="w-8 h-8" />,
      color: 'green',
      shortcut: 'Ctrl+S'
    },
    {
      title: 'Cetak Ulang',
      description: 'Struk atau label order',
      icon: <Printer className="w-8 h-8" />,
      color: 'purple',
      shortcut: 'Ctrl+P'
    },
    {
      title: 'WA Broadcast',
      description: 'Kirim notifikasi selesai',
      icon: <MessageSquare className="w-8 h-8" />,
      color: 'orange',
      shortcut: 'Ctrl+W'
    }
  ];

  const alerts = [
    {
      type: 'warning' as const,
      message: '5 order terlambat dari estimasi',
      time: '10 menit lalu'
    },
    {
      type: 'info' as const,
      message: '12 order siap untuk pickup',
      time: '25 menit lalu'
    },
    {
      type: 'success' as const,
      message: 'Target harian tercapai 85%',
      time: '1 jam lalu'
    }
  ];

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="flex items-center justify-between">
        <div>
          <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
            Dashboard
          </h1>
          <p className="text-gray-600 dark:text-gray-400 mt-1">
            Selamat datang kembali! Berikut ringkasan hari ini.
          </p>
        </div>
        <div className="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
          <Calendar size={16} />
          <span>{new Date().toLocaleDateString('id-ID', { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
          })}</span>
        </div>
      </div>

      {/* Stats Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        {stats.map((stat, index) => (
          <StatsCard key={index} {...stat} />
        ))}
      </div>

      {/* Alerts */}
      <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
        <h2 className="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
          <AlertCircle size={20} className="mr-2" />
          Notifikasi Penting
        </h2>
        <div className="space-y-3">
          {alerts.map((alert, index) => (
            <div key={index} className={`
              flex items-center justify-between p-3 rounded-lg border
              ${alert.type === 'warning' ? 'bg-yellow-50 dark:bg-yellow-900/20 border-yellow-200 dark:border-yellow-800' :
                alert.type === 'info' ? 'bg-blue-50 dark:bg-blue-900/20 border-blue-200 dark:border-blue-800' :
                'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800'}
            `}>
              <div className="flex items-center space-x-3">
                {alert.type === 'warning' ? (
                  <AlertCircle size={16} className="text-yellow-600 dark:text-yellow-400" />
                ) : alert.type === 'info' ? (
                  <Clock size={16} className="text-blue-600 dark:text-blue-400" />
                ) : (
                  <CheckCircle size={16} className="text-green-600 dark:text-green-400" />
                )}
                <span className={`text-sm font-medium
                  ${alert.type === 'warning' ? 'text-yellow-800 dark:text-yellow-200' :
                    alert.type === 'info' ? 'text-blue-800 dark:text-blue-200' :
                    'text-green-800 dark:text-green-200'}
                `}>
                  {alert.message}
                </span>
              </div>
              <span className="text-xs text-gray-500 dark:text-gray-400">
                {alert.time}
              </span>
            </div>
          ))}
        </div>
      </div>

      {/* Quick Actions Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        {quickActions.map((action, index) => (
          <QuickActionCard key={index} {...action} />
        ))}
      </div>

      {/* Charts and Activity */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
          <div className="flex items-center justify-between mb-6">
            <h2 className="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
              <BarChart3 size={20} className="mr-2" />
              Tren Produksi 7 Hari
            </h2>
            <select className="text-sm border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-1 
                             bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
              <option>7 hari</option>
              <option>30 hari</option>
              <option>90 hari</option>
            </select>
          </div>
          <ProductionChart />
        </div>

        <RecentActivity />
      </div>

      {/* Status Overview */}
      <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div className="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700 text-center">
          <div className="text-2xl font-bold text-blue-600 dark:text-blue-400">12</div>
          <div className="text-sm text-gray-600 dark:text-gray-400">Check-in</div>
        </div>
        <div className="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700 text-center">
          <div className="text-2xl font-bold text-yellow-600 dark:text-yellow-400">8</div>
          <div className="text-sm text-gray-600 dark:text-gray-400">Washing</div>
        </div>
        <div className="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700 text-center">
          <div className="text-2xl font-bold text-orange-600 dark:text-orange-400">5</div>
          <div className="text-sm text-gray-600 dark:text-gray-400">Ironing</div>
        </div>
        <div className="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700 text-center">
          <div className="text-2xl font-bold text-green-600 dark:text-green-400">15</div>
          <div className="text-sm text-gray-600 dark:text-gray-400">Ready</div>
        </div>
      </div>
    </div>
  );
};

export default DashboardHome;