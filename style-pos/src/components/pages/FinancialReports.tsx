import React, { useState } from 'react';
import { 
  DollarSign, TrendingUp, TrendingDown, BarChart3, 
  Calendar, Download, Filter, CreditCard, Banknote,
  Smartphone, QrCode, Eye, ArrowUpRight, ArrowDownRight
} from 'lucide-react';

const FinancialReports: React.FC = () => {
  const [dateRange, setDateRange] = useState('today');
  const [reportType, setReportType] = useState('overview');

  const salesData = {
    today: {
      revenue: 2450000,
      orders: 47,
      cash: 1200000,
      card: 650000,
      qris: 400000,
      ewallet: 200000
    },
    yesterday: {
      revenue: 2180000,
      orders: 42
    },
    thisWeek: {
      revenue: 14850000,
      orders: 289
    },
    thisMonth: {
      revenue: 58200000,
      orders: 1245
    }
  };

  const expenses = [
    { category: 'Listrik', amount: 350000, date: '2025-01-14' },
    { category: 'Deterjen', amount: 125000, date: '2025-01-14' },
    { category: 'Gas', amount: 80000, date: '2025-01-13' },
    { category: 'Gaji Karyawan', amount: 2500000, date: '2025-01-01' }
  ];

  const recentTransactions = [
    {
      id: '1',
      type: 'income',
      description: 'Order LD-2025-001 - Budi Santoso',
      amount: 56000,
      method: 'cash',
      time: '14:30'
    },
    {
      id: '2',
      type: 'income',
      description: 'Order LD-2025-002 - Sari Dewi',
      amount: 120000,
      method: 'qris',
      time: '13:45'
    },
    {
      id: '3',
      type: 'expense',
      description: 'Pembelian deterjen',
      amount: 125000,
      method: 'cash',
      time: '10:15'
    },
    {
      id: '4',
      type: 'income',
      description: 'Order LD-2025-003 - Ahmad Rizki',
      amount: 50000,
      method: 'card',
      time: '09:20'
    }
  ];

  const getChangePercentage = (current: number, previous: number) => {
    return ((current - previous) / previous * 100).toFixed(1);
  };

  const revenueChange = getChangePercentage(salesData.today.revenue, salesData.yesterday.revenue);
  const ordersChange = getChangePercentage(salesData.today.orders, salesData.yesterday.orders);

  const getPaymentMethodIcon = (method: string) => {
    switch (method) {
      case 'cash':
        return <Banknote size={16} />;
      case 'card':
        return <CreditCard size={16} />;
      case 'qris':
        return <QrCode size={16} />;
      case 'ewallet':
        return <Smartphone size={16} />;
      default:
        return <DollarSign size={16} />;
    }
  };

  const getPaymentMethodColor = (method: string) => {
    switch (method) {
      case 'cash':
        return 'text-green-600 dark:text-green-400';
      case 'card':
        return 'text-blue-600 dark:text-blue-400';
      case 'qris':
        return 'text-purple-600 dark:text-purple-400';
      case 'ewallet':
        return 'text-orange-600 dark:text-orange-400';
      default:
        return 'text-gray-600 dark:text-gray-400';
    }
  };

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
          <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
            Laporan Keuangan
          </h1>
          <p className="text-gray-600 dark:text-gray-400 mt-1">
            Pantau performa keuangan bisnis laundry
          </p>
        </div>
        <div className="flex items-center space-x-3">
          <select
            value={dateRange}
            onChange={(e) => setDateRange(e.target.value)}
            className="border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 
                     bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
          >
            <option value="today">Hari Ini</option>
            <option value="yesterday">Kemarin</option>
            <option value="thisWeek">Minggu Ini</option>
            <option value="thisMonth">Bulan Ini</option>
            <option value="lastMonth">Bulan Lalu</option>
          </select>
          <button className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center space-x-2">
            <Download size={16} />
            <span>Export PDF</span>
          </button>
        </div>
      </div>

      {/* Revenue Overview */}
      <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                Omzet Hari Ini
              </p>
              <p className="text-2xl font-bold text-gray-900 dark:text-white">
                Rp {salesData.today.revenue.toLocaleString('id-ID')}
              </p>
            </div>
            <div className="w-12 h-12 bg-green-100 dark:bg-green-900/20 rounded-xl flex items-center justify-center">
              <DollarSign size={24} className="text-green-600 dark:text-green-400" />
            </div>
          </div>
          <div className="flex items-center mt-4">
            {Number(revenueChange) >= 0 ? (
              <ArrowUpRight size={16} className="text-green-500 mr-1" />
            ) : (
              <ArrowDownRight size={16} className="text-red-500 mr-1" />
            )}
            <span className={`text-sm font-medium ${
              Number(revenueChange) >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'
            }`}>
              {revenueChange}% dari kemarin
            </span>
          </div>
        </div>

        <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                Total Order
              </p>
              <p className="text-2xl font-bold text-gray-900 dark:text-white">
                {salesData.today.orders}
              </p>
            </div>
            <div className="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-xl flex items-center justify-center">
              <BarChart3 size={24} className="text-blue-600 dark:text-blue-400" />
            </div>
          </div>
          <div className="flex items-center mt-4">
            {Number(ordersChange) >= 0 ? (
              <ArrowUpRight size={16} className="text-green-500 mr-1" />
            ) : (
              <ArrowDownRight size={16} className="text-red-500 mr-1" />
            )}
            <span className={`text-sm font-medium ${
              Number(ordersChange) >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'
            }`}>
              {ordersChange}% dari kemarin
            </span>
          </div>
        </div>

        <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                Rata-rata Order
              </p>
              <p className="text-2xl font-bold text-gray-900 dark:text-white">
                Rp {Math.round(salesData.today.revenue / salesData.today.orders).toLocaleString('id-ID')}
              </p>
            </div>
            <div className="w-12 h-12 bg-purple-100 dark:bg-purple-900/20 rounded-xl flex items-center justify-center">
              <TrendingUp size={24} className="text-purple-600 dark:text-purple-400" />
            </div>
          </div>
          <div className="flex items-center mt-4">
            <span className="text-sm text-gray-500 dark:text-gray-400">
              Per transaksi
            </span>
          </div>
        </div>

        <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                Net Profit
              </p>
              <p className="text-2xl font-bold text-gray-900 dark:text-white">
                Rp {(salesData.today.revenue - expenses.reduce((sum, exp) => sum + exp.amount, 0)).toLocaleString('id-ID')}
              </p>
            </div>
            <div className="w-12 h-12 bg-orange-100 dark:bg-orange-900/20 rounded-xl flex items-center justify-center">
              <TrendingDown size={24} className="text-orange-600 dark:text-orange-400" />
            </div>
          </div>
          <div className="flex items-center mt-4">
            <span className="text-sm text-gray-500 dark:text-gray-400">
              Setelah pengeluaran
            </span>
          </div>
        </div>
      </div>

      {/* Payment Methods Breakdown */}
      <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
        <h2 className="text-lg font-semibold text-gray-900 dark:text-white mb-6">
          Breakdown Pembayaran
        </h2>
        <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
          <div className="text-center">
            <div className="w-16 h-16 bg-green-100 dark:bg-green-900/20 rounded-full flex items-center justify-center mx-auto mb-3">
              <Banknote size={24} className="text-green-600 dark:text-green-400" />
            </div>
            <div className="text-sm text-gray-600 dark:text-gray-400 mb-1">Cash</div>
            <div className="text-xl font-bold text-gray-900 dark:text-white">
              Rp {salesData.today.cash.toLocaleString('id-ID')}
            </div>
            <div className="text-xs text-gray-500 dark:text-gray-400">
              {((salesData.today.cash / salesData.today.revenue) * 100).toFixed(1)}%
            </div>
          </div>

          <div className="text-center">
            <div className="w-16 h-16 bg-blue-100 dark:bg-blue-900/20 rounded-full flex items-center justify-center mx-auto mb-3">
              <CreditCard size={24} className="text-blue-600 dark:text-blue-400" />
            </div>
            <div className="text-sm text-gray-600 dark:text-gray-400 mb-1">Card</div>
            <div className="text-xl font-bold text-gray-900 dark:text-white">
              Rp {salesData.today.card.toLocaleString('id-ID')}
            </div>
            <div className="text-xs text-gray-500 dark:text-gray-400">
              {((salesData.today.card / salesData.today.revenue) * 100).toFixed(1)}%
            </div>
          </div>

          <div className="text-center">
            <div className="w-16 h-16 bg-purple-100 dark:bg-purple-900/20 rounded-full flex items-center justify-center mx-auto mb-3">
              <QrCode size={24} className="text-purple-600 dark:text-purple-400" />
            </div>
            <div className="text-sm text-gray-600 dark:text-gray-400 mb-1">QRIS</div>
            <div className="text-xl font-bold text-gray-900 dark:text-white">
              Rp {salesData.today.qris.toLocaleString('id-ID')}
            </div>
            <div className="text-xs text-gray-500 dark:text-gray-400">
              {((salesData.today.qris / salesData.today.revenue) * 100).toFixed(1)}%
            </div>
          </div>

          <div className="text-center">
            <div className="w-16 h-16 bg-orange-100 dark:bg-orange-900/20 rounded-full flex items-center justify-center mx-auto mb-3">
              <Smartphone size={24} className="text-orange-600 dark:text-orange-400" />
            </div>
            <div className="text-sm text-gray-600 dark:text-gray-400 mb-1">E-Wallet</div>
            <div className="text-xl font-bold text-gray-900 dark:text-white">
              Rp {salesData.today.ewallet.toLocaleString('id-ID')}
            </div>
            <div className="text-xs text-gray-500 dark:text-gray-400">
              {((salesData.today.ewallet / salesData.today.revenue) * 100).toFixed(1)}%
            </div>
          </div>
        </div>
      </div>

      {/* Recent Transactions and Expenses */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Recent Transactions */}
        <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
          <div className="flex items-center justify-between mb-6">
            <h2 className="text-lg font-semibold text-gray-900 dark:text-white">
              Transaksi Terbaru
            </h2>
            <button className="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 text-sm font-medium">
              Lihat Semua
            </button>
          </div>
          <div className="space-y-4">
            {recentTransactions.map((transaction) => (
              <div key={transaction.id} className="flex items-center justify-between p-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-lg">
                <div className="flex items-center space-x-3">
                  <div className={`w-10 h-10 rounded-lg flex items-center justify-center ${
                    transaction.type === 'income' 
                      ? 'bg-green-100 dark:bg-green-900/20' 
                      : 'bg-red-100 dark:bg-red-900/20'
                  }`}>
                    {transaction.type === 'income' ? (
                      <ArrowUpRight size={16} className="text-green-600 dark:text-green-400" />
                    ) : (
                      <ArrowDownRight size={16} className="text-red-600 dark:text-red-400" />
                    )}
                  </div>
                  <div>
                    <div className="text-sm font-medium text-gray-900 dark:text-white">
                      {transaction.description}
                    </div>
                    <div className="text-xs text-gray-500 dark:text-gray-400 flex items-center">
                      <span className={getPaymentMethodColor(transaction.method)}>
                        {getPaymentMethodIcon(transaction.method)}
                      </span>
                      <span className="ml-1">{transaction.method.toUpperCase()}</span>
                      <span className="mx-1">•</span>
                      <span>{transaction.time}</span>
                    </div>
                  </div>
                </div>
                <div className={`text-sm font-medium ${
                  transaction.type === 'income' 
                    ? 'text-green-600 dark:text-green-400' 
                    : 'text-red-600 dark:text-red-400'
                }`}>
                  {transaction.type === 'income' ? '+' : '-'}Rp {transaction.amount.toLocaleString('id-ID')}
                </div>
              </div>
            ))}
          </div>
        </div>

        {/* Expenses */}
        <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
          <div className="flex items-center justify-between mb-6">
            <h2 className="text-lg font-semibold text-gray-900 dark:text-white">
              Pengeluaran Terbaru
            </h2>
            <button className="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 text-sm font-medium">
              Tambah
            </button>
          </div>
          <div className="space-y-4">
            {expenses.map((expense, index) => (
              <div key={index} className="flex items-center justify-between p-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-lg">
                <div className="flex items-center space-x-3">
                  <div className="w-10 h-10 bg-red-100 dark:bg-red-900/20 rounded-lg flex items-center justify-center">
                    <ArrowDownRight size={16} className="text-red-600 dark:text-red-400" />
                  </div>
                  <div>
                    <div className="text-sm font-medium text-gray-900 dark:text-white">
                      {expense.category}
                    </div>
                    <div className="text-xs text-gray-500 dark:text-gray-400">
                      {new Date(expense.date).toLocaleDateString('id-ID')}
                    </div>
                  </div>
                </div>
                <div className="text-sm font-medium text-red-600 dark:text-red-400">
                  -Rp {expense.amount.toLocaleString('id-ID')}
                </div>
              </div>
            ))}
          </div>
          <div className="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
            <div className="flex items-center justify-between text-sm font-medium">
              <span className="text-gray-600 dark:text-gray-400">Total Pengeluaran</span>
              <span className="text-red-600 dark:text-red-400">
                -Rp {expenses.reduce((sum, exp) => sum + exp.amount, 0).toLocaleString('id-ID')}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default FinancialReports;