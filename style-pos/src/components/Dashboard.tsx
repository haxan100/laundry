import React, { useState } from 'react';
import Sidebar from './layout/Sidebar';
import TopBar from './layout/TopBar';
import DashboardHome from './pages/DashboardHome';
import POSOrder from './pages/POSOrder';
import OrderManagement from './pages/OrderManagement';
import ProductionBoard from './pages/ProductionBoard';
import CustomerManagement from './pages/CustomerManagement';
import FinancialReports from './pages/FinancialReports';
import Settings from './pages/Settings';

export type ActivePage = 'dashboard' | 'pos' | 'orders' | 'production' | 'delivery' | 'customers' | 'finance' | 'reports' | 'settings';

const Dashboard: React.FC = () => {
  const [activePage, setActivePage] = useState<ActivePage>('dashboard');
  const [sidebarOpen, setSidebarOpen] = useState(false);

  const renderPage = () => {
    switch (activePage) {
      case 'dashboard':
        return <DashboardHome />;
      case 'pos':
        return <POSOrder />;
      case 'orders':
        return <OrderManagement />;
      case 'production':
        return <ProductionBoard />;
      case 'customers':
        return <CustomerManagement />;
      case 'finance':
        return <FinancialReports />;
      case 'reports':
        return <FinancialReports />;
      case 'settings':
        return <Settings />;
      default:
        return <DashboardHome />;
    }
  };

  return (
    <div className="flex h-screen bg-gray-50 dark:bg-gray-900">
      <Sidebar 
        activePage={activePage}
        setActivePage={setActivePage}
        isOpen={sidebarOpen}
        setIsOpen={setSidebarOpen}
      />
      
      <div className="flex-1 flex flex-col overflow-hidden">
        <TopBar setSidebarOpen={setSidebarOpen} />
        
        <main className="flex-1 overflow-y-auto bg-gray-50 dark:bg-gray-900 p-4 lg:p-6">
          {renderPage()}
        </main>
      </div>
    </div>
  );
};

export default Dashboard;