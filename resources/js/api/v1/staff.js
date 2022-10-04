/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2022-09-23 00:15:42
 * File: Staff.js
 */

import Resource from '@/api/resource';
import request from '@/utils/request';

export default class StaffResource extends Resource {
  constructor() {
    super('/staff');
  }

  getDataCreate() {
    return request({
      url: 'staff/get-data-create',
      method: 'get',
    });
  }

  // {{$API_NOT_DELETE_THIS_LINE$}}
}
