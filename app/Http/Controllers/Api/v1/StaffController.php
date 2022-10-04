<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2022-09-23 00:15:42
 * File: Staff.php
 */

namespace App\Http\Controllers\Api\v1;

use App\Models\Building;
use App\Models\Staff;
use App\Models\StaffPosition;
use App\Services\QueryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreStaffRequest;

class StaffController extends Controller
{
    /**
     * Staff constructor.
     * @author tanmnt
     */
    public function __construct()
    {
        $this->middleware('permission:' . \ACL::PERMISSION_VISIT, ['only' => ['index']]);
        $this->middleware('permission:' . \ACL::PERMISSION_CREATE, ['only' => ['store']]);
        $this->middleware('permission:' . \ACL::PERMISSION_EDIT, ['only' => ['show', 'update']]);
        $this->middleware('permission:' . \ACL::PERMISSION_DELETE, ['only' => ['destroy']]);
    }

    /**
     * lists
     * @param Request $request
     * @return JsonResponse
     * @author tanmnt
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $limit       = $request->get('limit', 25);
            $ascending   = $request->get('ascending', '');
            $orderBy     = $request->get('orderBy', '');
            $search      = $request->get('search', '');
            $betweenDate = $request->get('updated_at', []);

            $queryService                   = new QueryService(new Staff);
            $queryService->select           = [];
            $queryService->columnSearch     = [];
            $queryService->withRelationship = [];
            $queryService->search           = $search;
            $queryService->betweenDate      = $betweenDate;
            $queryService->limit            = $limit;
            $queryService->ascending        = $ascending;
            $queryService->orderBy          = $orderBy;

            $query = $queryService->queryTable();
            $query = $query->paginate($limit);
            $staff = $query->toArray();

            return $this->jsonTable($staff);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * create
     * @param StoreStaffRequest $request
     * @return JsonResponse
     * @author tanmnt
     */
    public function store(StoreStaffRequest $request): JsonResponse
    {
        try {
            $staff = new Staff();
            $staff->fill($request->all());
            $staff->save();
            //{{CONTROLLER_RELATIONSHIP_MTM_CREATE_NOT_DELETE_THIS_LINE}}

            return $this->jsonData($staff, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * get once by id
     * @param Staff $staff
     * @return JsonResponse
     * @author tanmnt
     */
    public function show(Staff $staff): JsonResponse
    {
        try {
            //{{CONTROLLER_RELATIONSHIP_MTM_SHOW_NOT_DELETE_THIS_LINE}}

            return $this->jsonData($staff);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * update once by id
     * @param StoreStaffRequest $request
     * @param Staff $staff
     * @return JsonResponse
     * @author tanmnt
     */
    public function update(StoreStaffRequest $request, Staff $staff): JsonResponse
    {
        try {
            $staff->fill($request->all());
            $staff->save();
            //{{CONTROLLER_RELATIONSHIP_MTM_UPDATE_NOT_DELETE_THIS_LINE}}

            return $this->jsonData($staff);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * delete once by id
     * @param Staff $staff
     * @return JsonResponse
     * @author tanmnt
     */
    public function destroy(Staff $staff): JsonResponse
    {
        try {
            //{{CONTROLLER_RELATIONSHIP_MTM_DELETE_NOT_DELETE_THIS_LINE}}
            $staff->delete();

            return $this->jsonMessage(trans('messages.delete'));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    public function getDataCreate(): JsonResponse
    {
        try {
            $result             = [];
            $building           = Building::all()->toArray();
            $staffPosition      = StaffPosition::all()->toArray();
            $result['building'] = $building;
            $result['position'] = $staffPosition;
            return $this->jsonData($result);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }


    //{{CONTROLLER_RELATIONSHIP_NOT_DELETE_THIS_LINE}}
}
