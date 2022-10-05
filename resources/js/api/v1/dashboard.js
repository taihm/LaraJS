/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2022-09-22 23:20:18
 * File: Building.js
 */

import Resource from '@/api/resource';
import request from '@/utils/request';

export default class BuildingResource extends Resource {
  constructor() {
    super('/buildings');
  }

  getData() {
    return request({
      url: 'dashboard/get-all',
      method: 'get',
    });
  }

  // {{$API_NOT_DELETE_THIS_LINE$}}
}
