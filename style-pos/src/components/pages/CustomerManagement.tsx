import React, { useState } from 'react';
import { Search, UserPlus, Phone, MapPin, Star, Gift, CreditCard as Edit, Trash2, Download, MessageSquare, Eye, TrendingUp, Calendar, Package } from 'lucide-react';

interface Customer {
  id: string;
  name: string;
  phone: string;
  email?: string;
  address: string;
  tier: 'Regular' | 'Silver' | 'Gold' | 'Premium';
  points: number;
  totalOrders: number;
  totalSpent: number;
  lastOrder: string;
  joinDate: string;
  discount: number;
}

const CustomerManagement: React.FC = () => {
  const [searchTerm, setSearchTerm] = useState('');
  const [tierFilter, setTierFilter] = useState('all');
  const [showAddModal, setShowAddModal] = useState(false);

  const customers: Customer[] = [
    {
      id: '1',
      name: 'Budi Santoso',
      phone: '08123456789',
      email: 'budi@email.com',
      address: 'Jl. Merdeka No. 123, Jakarta',
      tier: 'Gold',
      points: 850,
      totalOrders: 47,
      totalSpent: 2350000,
      lastOrder: '2025-01-14',
      joinDate: '2024-08-15',
      discount: 10
    },
    {
      id: '2',
      name: 'Sari Dewi',
      phone: '08987654321',
      address: 'Jl. Sudirman No. 456, Jakarta',
      tier: 'Premium',
      points: 1250,
      totalOrders: 78,
      totalSpent: 4200000,
      lastOrder: '2025-01-13',
      joinDate: '2024-03-22',
      discount: 15
    },
    {
      id: '3',
      name: 'Ahmad Rizki',
      phone: '08555666777',
      address: 'Jl. Thamrin No. 789, Jakarta',
      tier: 'Silver',
      points: 320,
      totalOrders: 18,
      totalSpent: 890000,
      lastOrder: '2025-01-12',
      joinDate: '2024-11-10',
      discount: 5
    },
    {
      id: '4',
      name: 'Rina Wati',
      phone: '08111222333',
      address: 'Jl. Gatot Subroto No. 321, Jakarta',
      tier: 'Regular',
      points: 120,
      totalOrders: 8,
      totalSpent: 340000,
      lastOrder: '2025-01-10',
      joinDate: '2024-12-05',
      discount: 0
    }
  ];

  const tierOptions = [
    { value: 'all', label: 'Semua Tier' },
    { value: 'Regular', label: 'Regular' },
    { value: 'Silver', label: 'Silver' },
    { value: 'Gold', label: 'Gold' },
    { value: 'Premium', label: 'Premium' }
  ];

  const getTierColor = (tier: string) => {
    switch (tier) {
      case 'Premium':
        return 'bg-purple-100 text-purple-800 dark:bg-purple-900/20 dark:text-purple-300';
      case 'Gold':
        return 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-300';
      case 'Silver':
        return 'bg-gray-100 text-gray-800 dark:bg-gray-900/20 dark:text-gray-300';
      default:
        return 'bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-300';
    }
  };

  const filteredCustomers = customers.filter(customer => {
    const matchesSearch = customer.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                         customer.phone.includes(searchTerm) ||
                         customer.address.toLowerCase().includes(searchTerm.toLowerCase());
    const matchesTier = tierFilter === 'all' || customer.tier === tierFilter;
    return matchesSearch && matchesTier;
  });

  const topCustomers = customers
    .sort((a, b) => b.totalSpent - a.totalSpent)
    .slice(0, 3);

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
          <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
            Manajemen Pelanggan
          </h1>
          <p className="text-gray-600 dark:text-gray-400 mt-1">
            Kelola data dan hubungan pelanggan
          </p>
        </div>
        <div className="flex items-center space-x-3">
          <button className="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 flex items-center space-x-2">
            <Download size={16} />
            <span>Export CSV</span>
          </button>
          <button 
            onClick={() => setShowAddModal(true)}
            className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center space-x-2"
          >
            <UserPlus size={16} />
            <span>Tambah Pelanggan</span>
          </button>
        </div>
      </div>

      {/* Stats Cards */}
      <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
          <div className="flex items-center">
            <div className="flex-shrink-0">
              <div className="w-10 h-10 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center">
                <Star size={20} className="text-blue-600 dark:text-blue-400" />
              </div>
            </div>
            <div className="ml-4">
              <div className="text-2xl font-bold text-gray-900 dark:text-white">
                {customers.length}
              </div>
              <div className="text-sm text-gray-600 dark:text-gray-400">
                Total Pelanggan
              </div>
            </div>
          </div>
        </div>

        <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
          <div className="flex items-center">
            <div className="flex-shrink-0">
              <div className="w-10 h-10 bg-yellow-100 dark:bg-yellow-900/20 rounded-lg flex items-center justify-center">
                <Gift size={20} className="text-yellow-600 dark:text-yellow-400" />
              </div>
            </div>
            <div className="ml-4">
              <div className="text-2xl font-bold text-gray-900 dark:text-white">
                {customers.filter(c => c.tier !== 'Regular').length}
              </div>
              <div className="text-sm text-gray-600 dark:text-gray-400">
                Member Premium
              </div>
            </div>
          </div>
        </div>

        <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
          <div className="flex items-center">
            <div className="flex-shrink-0">
              <div className="w-10 h-10 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center">
                <TrendingUp size={20} className="text-green-600 dark:text-green-400" />
              </div>
            </div>
            <div className="ml-4">
              <div className="text-2xl font-bold text-gray-900 dark:text-white">
                Rp {(customers.reduce((sum, c) => sum + c.totalSpent, 0) / customers.length).toLocaleString('id-ID', { maximumFractionDigits: 0 })}
              </div>
              <div className="text-sm text-gray-600 dark:text-gray-400">
                Avg. Spending
              </div>
            </div>
          </div>
        </div>

        <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
          <div className="flex items-center">
            <div className="flex-shrink-0">
              <div className="w-10 h-10 bg-purple-100 dark:bg-purple-900/20 rounded-lg flex items-center justify-center">
                <Calendar size={20} className="text-purple-600 dark:text-purple-400" />
              </div>
            </div>
            <div className="ml-4">
              <div className="text-2xl font-bold text-gray-900 dark:text-white">
                {customers.filter(c => {
                  const lastOrder = new Date(c.lastOrder);
                  const daysSince = (new Date().getTime() - lastOrder.getTime()) / (1000 * 3600 * 24);
                  return daysSince <= 7;
                }).length}
              </div>
              <div className="text-sm text-gray-600 dark:text-gray-400">
                Active (7 hari)
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Top Customers */}
      <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
        <h2 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
          Top Customers
        </h2>
        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
          {topCustomers.map((customer, index) => (
            <div key={customer.id} className="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
              <div className={`w-10 h-10 rounded-full flex items-center justify-center font-bold text-white
                ${index === 0 ? 'bg-yellow-500' : index === 1 ? 'bg-gray-400' : 'bg-orange-500'}
              `}>
                {index + 1}
              </div>
              <div className="flex-1">
                <div className="font-medium text-gray-900 dark:text-white">
                  {customer.name}
                </div>
                <div className="text-sm text-gray-600 dark:text-gray-400">
                  {customer.totalOrders} orders • Rp {customer.totalSpent.toLocaleString('id-ID')}
                </div>
              </div>
              <span className={`px-2 py-1 rounded-full text-xs font-medium ${getTierColor(customer.tier)}`}>
                {customer.tier}
              </span>
            </div>
          ))}
        </div>
      </div>

      {/* Filters */}
      <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
        <div className="flex flex-col md:flex-row gap-4">
          <div className="flex-1">
            <div className="relative">
              <Search size={16} className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" />
              <input
                type="text"
                placeholder="Cari nama, nomor HP, atau alamat..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="pl-10 pr-4 py-2 w-full border border-gray-300 dark:border-gray-600 rounded-lg 
                         bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 
                         focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              />
            </div>
          </div>
          <select
            value={tierFilter}
            onChange={(e) => setTierFilter(e.target.value)}
            className="border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 
                     bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
          >
            {tierOptions.map(option => (
              <option key={option.value} value={option.value}>
                {option.label}
              </option>
            ))}
          </select>
        </div>
      </div>

      {/* Customers Table */}
      <div className="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead className="bg-gray-50 dark:bg-gray-700/50">
              <tr>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Pelanggan
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Kontak
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Tier
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Statistik
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Poin
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Last Order
                </th>
                <th className="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Aksi
                </th>
              </tr>
            </thead>
            <tbody className="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
              {filteredCustomers.map((customer) => (
                <tr key={customer.id} className="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="flex items-center">
                      <div className="flex-shrink-0 w-10 h-10 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center">
                        <span className="text-blue-600 dark:text-blue-400 font-semibold">
                          {customer.name.charAt(0)}
                        </span>
                      </div>
                      <div className="ml-4">
                        <div className="text-sm font-medium text-gray-900 dark:text-white">
                          {customer.name}
                        </div>
                        <div className="text-sm text-gray-500 dark:text-gray-400 flex items-center">
                          <MapPin size={12} className="mr-1" />
                          {customer.address.length > 30 
                            ? `${customer.address.substring(0, 30)}...`
                            : customer.address
                          }
                        </div>
                      </div>
                    </div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="text-sm text-gray-900 dark:text-white flex items-center">
                      <Phone size={12} className="mr-2" />
                      {customer.phone}
                    </div>
                    {customer.email && (
                      <div className="text-sm text-gray-500 dark:text-gray-400">
                        {customer.email}
                      </div>
                    )}
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getTierColor(customer.tier)}`}>
                      {customer.tier}
                      {customer.discount > 0 && (
                        <span className="ml-1">({customer.discount}%)</span>
                      )}
                    </span>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="text-sm text-gray-900 dark:text-white">
                      {customer.totalOrders} orders
                    </div>
                    <div className="text-sm text-gray-500 dark:text-gray-400">
                      Rp {customer.totalSpent.toLocaleString('id-ID')}
                    </div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="flex items-center">
                      <Gift size={16} className="text-yellow-500 mr-2" />
                      <span className="text-sm font-medium text-gray-900 dark:text-white">
                        {customer.points}
                      </span>
                    </div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                    {new Date(customer.lastOrder).toLocaleDateString('id-ID')}
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div className="flex items-center justify-end space-x-2">
                      <button className="p-1 text-gray-400 hover:text-blue-600 dark:hover:text-blue-400">
                        <Eye size={16} />
                      </button>
                      <button className="p-1 text-gray-400 hover:text-green-600 dark:hover:text-green-400">
                        <MessageSquare size={16} />
                      </button>
                      <button className="p-1 text-gray-400 hover:text-orange-600 dark:hover:text-orange-400">
                        <Edit size={16} />
                      </button>
                      <button className="p-1 text-gray-400 hover:text-red-600 dark:hover:text-red-400">
                        <Trash2 size={16} />
                      </button>
                    </div>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>

        {filteredCustomers.length === 0 && (
          <div className="text-center py-12">
            <Star size={48} className="mx-auto text-gray-400 mb-4" />
            <h3 className="text-lg font-medium text-gray-900 dark:text-white mb-2">
              Tidak ada pelanggan
            </h3>
            <p className="text-gray-500 dark:text-gray-400">
              {searchTerm || tierFilter !== 'all' 
                ? 'Tidak ada pelanggan yang sesuai dengan filter'
                : 'Belum ada pelanggan terdaftar'
              }
            </p>
          </div>
        )}
      </div>
    </div>
  );
};

export default CustomerManagement;