/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2022-09-23 01:00:48
 * File: SupportService.js
 */

const supportService = {
  path: '/support-services',
  component: () => import('@/layout'),
  meta: {
    title: 'support_service',
    icon: 'menu',
    permissions: ['view menu support_service'],
  },
  children: [
    {
      path: '/support-services',
      name: 'SupportService',
      component: () => import('@/views/support-service'),
      meta: {
        title: 'support_service',
        icon: 'list',
        activeMenu: '/support-services',
        permissions: ['visit'],
      },
      hidden: true,
    },
    {
      path: 'create',
      name: 'SupportServiceCreate',
      hidden: true,
      component: () => import('@/views/support-service/Form'),
      meta: {
        activeMenu: '/support-services',
        title: 'support_service_create',
        icon: 'record_create',
        permissions: ['create'],
      },
    },
    {
      path: 'edit/:id(\\d+)',
      name: 'SupportServiceEdit',
      hidden: true,
      component: () => import('@/views/support-service/Form'),
      meta: {
        activeMenu: '/support-services',
        title: 'support_service_edit',
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

export default supportService;
