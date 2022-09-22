/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2022-09-23 00:15:42
 * File: Staff.js
 */

const staff = {
  path: '/staff',
  component: () => import('@/layout'),
  meta: {
    title: 'staff',
    icon: 'menu',
    permissions: ['view menu staff'],
  },
  children: [
    {
      path: '/staff',
      name: 'Staff',
      component: () => import('@/views/staff'),
      meta: {
        title: 'staff',
        icon: 'list',
        activeMenu: '/staff',
        permissions: ['visit'],
      },
      hidden: true,
    },
    {
      path: 'create',
      name: 'StaffCreate',
      hidden: true,
      component: () => import('@/views/staff/Form'),
      meta: {
        activeMenu: '/staff',
        title: 'staff_create',
        icon: 'record_create',
        permissions: ['create'],
      },
    },
    {
      path: 'edit/:id(\\d+)',
      name: 'StaffEdit',
      hidden: true,
      component: () => import('@/views/staff/Form'),
      meta: {
        activeMenu: '/staff',
        title: 'staff_edit',
        permissions: ['edit'],
        icon: 'edit',
      },
      props: route => {
        return {
          ...route,
          props: true,
        };
      },
    },
  ],
};

export default staff;
