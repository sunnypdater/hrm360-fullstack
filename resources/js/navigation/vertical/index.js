export default [
  {
    title: 'Home',
    to: { name: 'root' },
    icon: { icon: 'tabler-smart-home' },
  },
  { heading: 'Dashboard' },
  {
    title: 'Dashboards',
    icon: { icon: 'tabler-smart-home' },
    children: [
      {
        title: 'Analytics',
        to: 'dashboards-analytics',
      },
      {
        title: 'CRM',
        to: 'dashboards-crm',
      },
      {
        title: 'Ecommerce',
        to: 'dashboards-ecommerce',
      },
    ],
  },

  { heading: 'Management' },
  {
    title: 'Company Portal',
    to: 'apps-user-list',
    icon: { icon: 'tabler-smart-home' },
  },
  {
    title: 'Postion Portal',
    icon: { icon: 'tabler-file-dollar' },
    children: [
      { title: 'List', to: 'apps-invoice-list' },
      { title: 'Preview', to: { name: 'apps-invoice-preview-id', params: { id: '5036' } } },
      { title: 'Edit', to: { name: 'apps-invoice-edit-id', params: { id: '5036' } } },
      { title: 'Add', to: 'apps-invoice-add' },
    ],
  },
  {
    title: 'Employee Portal',
    to: 'employee-list',
    icon: { icon: 'tabler-smart-home' },
  },
  {
    title: 'User Portal',
    to: 'user-list',
    icon: { icon: 'tabler-smart-home' },
  },
]
