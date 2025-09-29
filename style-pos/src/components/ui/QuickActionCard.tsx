import React from 'react';

interface QuickActionCardProps {
  title: string;
  description: string;
  icon: React.ReactNode;
  color: 'blue' | 'green' | 'purple' | 'orange';
  shortcut: string;
  onClick?: () => void;
}

const QuickActionCard: React.FC<QuickActionCardProps> = ({ 
  title, 
  description, 
  icon, 
  color, 
  shortcut,
  onClick 
}) => {
  const getColorClasses = (color: string) => {
    switch (color) {
      case 'blue':
        return 'border-blue-200 dark:border-blue-800 hover:border-blue-300 dark:hover:border-blue-700 hover:bg-blue-50 dark:hover:bg-blue-900/10';
      case 'green':
        return 'border-green-200 dark:border-green-800 hover:border-green-300 dark:hover:border-green-700 hover:bg-green-50 dark:hover:bg-green-900/10';
      case 'purple':
        return 'border-purple-200 dark:border-purple-800 hover:border-purple-300 dark:hover:border-purple-700 hover:bg-purple-50 dark:hover:bg-purple-900/10';
      case 'orange':
        return 'border-orange-200 dark:border-orange-800 hover:border-orange-300 dark:hover:border-orange-700 hover:bg-orange-50 dark:hover:bg-orange-900/10';
      default:
        return 'border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600';
    }
  };

  const getIconColor = (color: string) => {
    switch (color) {
      case 'blue':
        return 'text-blue-600 dark:text-blue-400';
      case 'green':
        return 'text-green-600 dark:text-green-400';
      case 'purple':
        return 'text-purple-600 dark:text-purple-400';
      case 'orange':
        return 'text-orange-600 dark:text-orange-400';
      default:
        return 'text-gray-600 dark:text-gray-400';
    }
  };

  return (
    <button
      onClick={onClick}
      className={`w-full p-6 bg-white dark:bg-gray-800 rounded-xl border-2 border-dashed transition-all duration-200 text-left group ${getColorClasses(color)}`}
    >
      <div className="flex flex-col items-center text-center space-y-3">
        <div className={`${getIconColor(color)} group-hover:scale-110 transition-transform`}>
          {icon}
        </div>
        <div>
          <h3 className="font-medium text-gray-900 dark:text-white mb-1">
            {title}
          </h3>
          <p className="text-sm text-gray-600 dark:text-gray-400 mb-2">
            {description}
          </p>
          <span className="text-xs text-gray-500 dark:text-gray-500 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
            {shortcut}
          </span>
        </div>
      </div>
    </button>
  );
};

export default QuickActionCard;