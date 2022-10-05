<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Building;
use App\Models\Staff;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{

    /**
     * DataExcel constructor.
     * @author tanmnt
     */
    public function __construct()
    {
        $this->middleware('permission:' . \ACL::PERMISSION_VISIT, ['only' => ['index']]);
        $this->middleware('permission:' . \ACL::PERMISSION_CREATE, ['only' => ['store']]);
        $this->middleware('permission:' . \ACL::PERMISSION_EDIT, ['only' => ['show', 'update']]);
        $this->middleware('permission:' . \ACL::PERMISSION_DELETE, ['only' => ['destroy']]);
    }

    public function getAllData(): JsonResponse
    {
        $result             = [];
        $result['building'] = Building::all()->toArray();
        $result['staff']    = Staff::all()->toArray();

        return $this->jsonData($result);
    }
    //{{CONTROLLER_RELATIONSHIP_NOT_DELETE_THIS_LINE}}
}
