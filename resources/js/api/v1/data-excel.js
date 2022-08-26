/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2022-08-02 23:43:12
 * File: DataExcel.js
 */

import Resource from '@/api/resource';
import request from '@/utils/request';

export default class DataExcelResource extends Resource {
  constructor() {
    super('/data-excels');
  }

  listBatch() {
    return request({
      url: 'data-excels/batch',
      method: 'get',
    });
  }

  import(resource) {
    return request({
      url: 'data-excels/import',
      method: 'post',
      data: resource,
    });
  }

  export() {
    return request({
      url: 'data-excels/export',
      method: 'get',
    });
  }

  // {{$API_NOT_DELETE_THIS_LINE$}}
}
