import React from 'react';

const ProductionChart: React.FC = () => {
  const chartData = [
    { day: 'Sen', orders: 45, revenue: 2200000 },
    { day: 'Sel', orders: 38, revenue: 1800000 },
    { day: 'Rab', orders: 52, revenue: 2600000 },
    { day: 'Kam', orders: 41, revenue: 2100000 },
    { day: 'Jum', orders: 47, revenue: 2450000 },
    { day: 'Sab', orders: 59, revenue: 3100000 },
    { day: 'Min', orders: 33, revenue: 1650000 }
  ];

  const maxOrders = Math.max(...chartData.map(d => d.orders));
  const maxRevenue = Math.max(...chartData.map(d => d.revenue));

  return (
    <div className="h-64 flex items-end justify-between space-x-2 p-4">
      {chartData.map((data, index) => {
        const orderHeight = (data.orders / maxOrders) * 200;
        const revenueHeight = (data.revenue / maxRevenue) * 200;
        
        return (
          <div key={index} className="flex flex-col items-center flex-1">
            <div className="w-full flex justify-center space-x-1 mb-2">
              {/* Orders bar */}
              <div className="relative group">
                <div 
                  className="w-4 bg-blue-500 dark:bg-blue-400 rounded-t transition-all duration-300 hover:bg-blue-600"
                  style={{ height: `${orderHeight}px` }}
                />
                <div className="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 bg-gray-900 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                  {data.orders} orders
                </div>
              </div>
              
              {/* Revenue bar */}
              <div className="relative group">
                <div 
                  className="w-4 bg-green-500 dark:bg-green-400 rounded-t transition-all duration-300 hover:bg-green-600"
                  style={{ height: `${revenueHeight}px` }}
                />
                <div className="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 bg-gray-900 text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                  Rp {(data.revenue / 1000000).toFixed(1)}M
                </div>
              </div>
            </div>
            
            <span className="text-xs text-gray-600 dark:text-gray-400 font-medium">
              {data.day}
            </span>
          </div>
        );
      })}
    </div>
  );
};

export default ProductionChart;