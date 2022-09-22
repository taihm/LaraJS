/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2022-09-22 23:20:18
 * File: Building.js
 */

import { superAdmin } from '@/settings';

const building = {
  path: '/buildings',
  component: () => import('@/layout'),
  meta: {
    title: 'building',
    icon: 'menu',
    roles: [superAdmin],
  },
  children: [
    {
      path: '/buildings',
      name: 'Building',
      component: () => import('@/views/building'),
      meta: {
        title: 'building',
        icon: 'list',
        activeMenu: '/buildings',
      },
      hidden: true,
    },
    {
      path: 'create',
      name: 'BuildingCreate',
      hidden: true,
      component: () => import('@/views/building/Form'),
      meta: {
        activeMenu: '/buildings',
        title: 'building_create',
        icon: 'record_create',
      },
    },
    {
      path: 'edit/:id(\\d+)',
      name: 'BuildingEdit',
      hidden: true,
      component: () => import('@/views/building/Form'),
      meta: {
        activeMenu: '/buildings',
        title: 'building_edit',
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

export default building;
