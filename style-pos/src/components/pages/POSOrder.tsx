import React, { useState } from 'react';
import { 
  Search, UserPlus, Package, Plus, Minus, Calculator,
  CreditCard, Banknote, Smartphone, Receipt, QrCode
} from 'lucide-react';

interface OrderItem {
  id: string;
  service: string;
  quantity: number;
  unit: string;
  price: number;
  total: number;
}

interface Customer {
  id: string;
  name: string;
  phone: string;
  address: string;
  tier: 'Regular' | 'Silver' | 'Gold' | 'Premium';
  points: number;
}

const POSOrder: React.FC = () => {
  const [customer, setCustomer] = useState<Customer | null>(null);
  const [orderItems, setOrderItems] = useState<OrderItem[]>([]);
  const [searchPhone, setSearchPhone] = useState('');
  const [paymentMethod, setPaymentMethod] = useState('cash');
  const [paymentAmount, setPaymentAmount] = useState('');

  const services = [
    { id: '1', name: 'Cuci Kering Kiloan', unit: 'kg', price: 7000 },
    { id: '2', name: 'Cuci Setrika Kiloan', unit: 'kg', price: 8000 },
    { id: '3', name: 'Setrika Saja', unit: 'kg', price: 5000 },
    { id: '4', name: 'Cuci Express', unit: 'kg', price: 12000 },
    { id: '5', name: 'Sepatu Sneakers', unit: 'pasang', price: 25000 },
    { id: '6', name: 'Sepatu Formal', unit: 'pasang', price: 30000 },
  ];

  const addOnServices = [
    { id: 'parfum', name: 'Parfum', price: 3000 },
    { id: 'antisep', name: 'Antiseptik', price: 2000 },
    { id: 'softener', name: 'Softener Premium', price: 5000 },
  ];

  const searchCustomer = () => {
    // Mock customer search
    if (searchPhone) {
      setCustomer({
        id: '1',
        name: 'Budi Santoso',
        phone: searchPhone,
        address: 'Jl. Merdeka No. 123',
        tier: 'Gold',
        points: 850
      });
    }
  };

  const addOrderItem = (service: any) => {
    const newItem: OrderItem = {
      id: Date.now().toString(),
      service: service.name,
      quantity: 1,
      unit: service.unit,
      price: service.price,
      total: service.price
    };
    setOrderItems([...orderItems, newItem]);
  };

  const updateQuantity = (id: string, newQuantity: number) => {
    if (newQuantity <= 0) {
      setOrderItems(orderItems.filter(item => item.id !== id));
      return;
    }
    
    setOrderItems(orderItems.map(item => 
      item.id === id 
        ? { ...item, quantity: newQuantity, total: item.price * newQuantity }
        : item
    ));
  };

  const calculateTotal = () => {
    const subtotal = orderItems.reduce((sum, item) => sum + item.total, 0);
    const discount = customer?.tier === 'Gold' ? subtotal * 0.1 : 0;
    const tax = (subtotal - discount) * 0.1;
    return { subtotal, discount, tax, total: subtotal - discount + tax };
  };

  const { subtotal, discount, tax, total } = calculateTotal();

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
          POS / Order Baru
        </h1>
        <div className="flex space-x-2">
          <button className="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
            Draft Order
          </button>
          <button className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Scan QR
          </button>
        </div>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {/* Left Column - Customer & Services */}
        <div className="lg:col-span-2 space-y-6">
          {/* Customer Section */}
          <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
            <h2 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
              Data Pelanggan
            </h2>
            
            <div className="flex space-x-3 mb-4">
              <div className="flex-1">
                <input
                  type="text"
                  placeholder="Masukkan nomor HP..."
                  value={searchPhone}
                  onChange={(e) => setSearchPhone(e.target.value)}
                  className="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg 
                           bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                />
              </div>
              <button
                onClick={searchCustomer}
                className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center space-x-2"
              >
                <Search size={16} />
                <span>Cari</span>
              </button>
              <button className="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center space-x-2">
                <UserPlus size={16} />
                <span>Baru</span>
              </button>
            </div>

            {customer && (
              <div className="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                <div className="flex items-center justify-between mb-2">
                  <h3 className="font-semibold text-gray-900 dark:text-white">
                    {customer.name}
                  </h3>
                  <span className={`px-2 py-1 rounded-full text-xs font-medium
                    ${customer.tier === 'Gold' ? 'bg-yellow-100 text-yellow-800' :
                      customer.tier === 'Silver' ? 'bg-gray-100 text-gray-800' :
                      'bg-purple-100 text-purple-800'}`}>
                    {customer.tier}
                  </span>
                </div>
                <p className="text-sm text-gray-600 dark:text-gray-400">
                  {customer.phone} • {customer.address}
                </p>
                <p className="text-sm text-green-600 dark:text-green-400 mt-1">
                  Poin: {customer.points}
                </p>
              </div>
            )}
          </div>

          {/* Services Section */}
          <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
            <h2 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
              Pilih Layanan
            </h2>
            
            <div className="grid grid-cols-2 md:grid-cols-3 gap-3">
              {services.map((service) => (
                <button
                  key={service.id}
                  onClick={() => addOrderItem(service)}
                  className="p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-blue-500 
                           dark:hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors text-left"
                >
                  <div className="font-medium text-gray-900 dark:text-white text-sm">
                    {service.name}
                  </div>
                  <div className="text-blue-600 dark:text-blue-400 text-sm font-semibold mt-1">
                    Rp {service.price.toLocaleString('id-ID')}
                  </div>
                  <div className="text-xs text-gray-500 dark:text-gray-400">
                    per {service.unit}
                  </div>
                </button>
              ))}
            </div>

            <div className="mt-6">
              <h3 className="font-medium text-gray-900 dark:text-white mb-3">
                Add-on Services
              </h3>
              <div className="flex flex-wrap gap-2">
                {addOnServices.map((addon) => (
                  <button
                    key={addon.id}
                    className="px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg 
                             hover:border-blue-500 dark:hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20"
                  >
                    {addon.name} (+{addon.price.toLocaleString('id-ID')})
                  </button>
                ))}
              </div>
            </div>
          </div>
        </div>

        {/* Right Column - Order Summary */}
        <div className="space-y-6">
          {/* Order Items */}
          <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
            <h2 className="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
              <Package size={20} className="mr-2" />
              Ringkasan Order
            </h2>

            {orderItems.length === 0 ? (
              <p className="text-center text-gray-500 dark:text-gray-400 py-8">
                Belum ada item dalam order
              </p>
            ) : (
              <div className="space-y-3">
                {orderItems.map((item) => (
                  <div key={item.id} className="flex items-center justify-between py-3 border-b border-gray-200 dark:border-gray-700">
                    <div className="flex-1">
                      <div className="font-medium text-gray-900 dark:text-white text-sm">
                        {item.service}
                      </div>
                      <div className="text-xs text-gray-500 dark:text-gray-400">
                        Rp {item.price.toLocaleString('id-ID')} / {item.unit}
                      </div>
                    </div>
                    <div className="flex items-center space-x-2">
                      <button
                        onClick={() => updateQuantity(item.id, item.quantity - 1)}
                        className="p-1 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700"
                      >
                        <Minus size={14} />
                      </button>
                      <span className="w-8 text-center text-sm">
                        {item.quantity}
                      </span>
                      <button
                        onClick={() => updateQuantity(item.id, item.quantity + 1)}
                        className="p-1 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700"
                      >
                        <Plus size={14} />
                      </button>
                    </div>
                    <div className="w-20 text-right text-sm font-medium">
                      Rp {item.total.toLocaleString('id-ID')}
                    </div>
                  </div>
                ))}
              </div>
            )}

            {/* Summary */}
            {orderItems.length > 0 && (
              <div className="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700 space-y-2">
                <div className="flex justify-between text-sm">
                  <span>Subtotal</span>
                  <span>Rp {subtotal.toLocaleString('id-ID')}</span>
                </div>
                {discount > 0 && (
                  <div className="flex justify-between text-sm text-green-600 dark:text-green-400">
                    <span>Diskon ({customer?.tier})</span>
                    <span>-Rp {discount.toLocaleString('id-ID')}</span>
                  </div>
                )}
                <div className="flex justify-between text-sm">
                  <span>Pajak (10%)</span>
                  <span>Rp {tax.toLocaleString('id-ID')}</span>
                </div>
                <div className="flex justify-between font-bold text-lg pt-2 border-t border-gray-200 dark:border-gray-700">
                  <span>Total</span>
                  <span>Rp {total.toLocaleString('id-ID')}</span>
                </div>
              </div>
            )}
          </div>

          {/* Payment */}
          {orderItems.length > 0 && (
            <div className="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
              <h3 className="font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <Calculator size={20} className="mr-2" />
                Pembayaran
              </h3>

              <div className="space-y-4">
                <div>
                  <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Metode Pembayaran
                  </label>
                  <div className="grid grid-cols-2 gap-2">
                    <button
                      onClick={() => setPaymentMethod('cash')}
                      className={`p-3 rounded-lg border flex flex-col items-center space-y-1 transition-colors
                        ${paymentMethod === 'cash'
                          ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300'
                          : 'border-gray-300 dark:border-gray-600 hover:border-gray-400'
                        }`}
                    >
                      <Banknote size={20} />
                      <span className="text-xs">Cash</span>
                    </button>
                    <button
                      onClick={() => setPaymentMethod('card')}
                      className={`p-3 rounded-lg border flex flex-col items-center space-y-1 transition-colors
                        ${paymentMethod === 'card'
                          ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300'
                          : 'border-gray-300 dark:border-gray-600 hover:border-gray-400'
                        }`}
                    >
                      <CreditCard size={20} />
                      <span className="text-xs">Card</span>
                    </button>
                    <button
                      onClick={() => setPaymentMethod('qris')}
                      className={`p-3 rounded-lg border flex flex-col items-center space-y-1 transition-colors
                        ${paymentMethod === 'qris'
                          ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300'
                          : 'border-gray-300 dark:border-gray-600 hover:border-gray-400'
                        }`}
                    >
                      <QrCode size={20} />
                      <span className="text-xs">QRIS</span>
                    </button>
                    <button
                      onClick={() => setPaymentMethod('ewallet')}
                      className={`p-3 rounded-lg border flex flex-col items-center space-y-1 transition-colors
                        ${paymentMethod === 'ewallet'
                          ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300'
                          : 'border-gray-300 dark:border-gray-600 hover:border-gray-400'
                        }`}
                    >
                      <Smartphone size={20} />
                      <span className="text-xs">E-Wallet</span>
                    </button>
                  </div>
                </div>

                <div>
                  <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Jumlah Bayar
                  </label>
                  <input
                    type="number"
                    value={paymentAmount}
                    onChange={(e) => setPaymentAmount(e.target.value)}
                    placeholder={`Rp ${total.toLocaleString('id-ID')}`}
                    className="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg 
                             bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                  />
                  {paymentAmount && Number(paymentAmount) > total && (
                    <p className="text-sm text-green-600 dark:text-green-400 mt-1">
                      Kembalian: Rp {(Number(paymentAmount) - total).toLocaleString('id-ID')}
                    </p>
                  )}
                </div>

                <div className="space-y-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                  <button className="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-medium flex items-center justify-center space-x-2">
                    <Receipt size={16} />
                    <span>Proses & Cetak</span>
                  </button>
                  <button className="w-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 py-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                    Simpan Draft
                  </button>
                </div>
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default POSOrder;