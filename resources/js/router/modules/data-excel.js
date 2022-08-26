/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2022-08-02 23:43:12
 * File: DataExcel.js
 */

const dataExcel = {
  path: '/data-excels',
  component: () => import('@/layout'),
  meta: {
    title: 'data_excel',
    icon: 'menu',
    permissions: ['view menu data_excel'],
  },
  children: [
    {
      path: '/data-excels',
      name: 'DataExcel',
      component: () => import('@/views/data-excel'),
      meta: {
        title: 'data_excel',
        icon: 'list',
        activeMenu: '/data-excels',
        permissions: ['visit'],
      },
      hidden: true,
    },
    {
      path: 'create',
      name: 'DataExcelCreate',
      hidden: true,
      component: () => import('@/views/data-excel/Form'),
      meta: {
        activeMenu: '/data-excels',
        title: 'data_excel_create',
        icon: 'record_create',
        permissions: ['create'],
      },
    },
    {
      path: 'edit/:id(\\d+)',
      name: 'DataExcelEdit',
      hidden: true,
      component: () => import('@/views/data-excel/Form'),
      meta: {
        activeMenu: '/data-excels',
        title: 'data_excel_edit',
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
    {
      path: 'import',
      name: 'DataExcelImport',
      hidden: true,
      component: () => import('@/views/data-excel/ImportForm'),
      meta: {
        activeMenu: '/data-excels',
        title: 'data_excel_import',
        icon: 'record_create',
      },
    },
    {
      path: 'batch',
      name: 'DataExcelBatch',
      hidden: true,
      component: () => import('@/views/data-excel/indexBatch'),
      meta: {
        activeMenu: '/data-excels',
        title: 'data_excel',
        icon: 'list',
      },
    },
  ],
};

export default dataExcel;
