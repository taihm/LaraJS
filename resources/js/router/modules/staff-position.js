/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2022-09-23 00:33:37
 * File: StaffPosition.js
 */

const staffPosition = {
  path: '/staff-positions',
  component: () => import('@/layout'),
  meta: {
    title: 'staff_position',
    icon: 'menu',
    permissions: ['view menu staff_position'],
  },
  children: [
    {
      path: '/staff-positions',
      name: 'StaffPosition',
      component: () => import('@/views/staff-position'),
      meta: {
        title: 'staff_position',
        icon: 'list',
        activeMenu: '/staff-positions',
        permissions: ['visit'],
      },
      hidden: true,
    },
    {
      path: 'create',
      name: 'StaffPositionCreate',
      hidden: true,
      component: () => import('@/views/staff-position/Form'),
      meta: {
        activeMenu: '/staff-positions',
        title: 'staff_position_create',
        icon: 'record_create',
        permissions: ['create'],
      },
    },
    {
      path: 'edit/:id(\\d+)',
      name: 'StaffPositionEdit',
      hidden: true,
      component: () => import('@/views/staff-position/Form'),
      meta: {
        activeMenu: '/staff-positions',
        title: 'staff_position_edit',
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

export default staffPosition;
