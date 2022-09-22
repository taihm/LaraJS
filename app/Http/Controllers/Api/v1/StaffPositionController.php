<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2022-09-23 00:33:37
 * File: StaffPosition.php
 */

namespace App\Http\Controllers\Api\v1;

use App\Models\StaffPosition;
use App\Services\QueryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreStaffPositionRequest;

class StaffPositionController extends Controller
{
    /**
     * StaffPosition constructor.
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
			$limit = $request->get('limit', 25);
			$ascending = $request->get('ascending', '');
			$orderBy = $request->get('orderBy', '');
			$search = $request->get('search', '');
			$betweenDate = $request->get('updated_at', []);

			$queryService = new QueryService(new StaffPosition);
            $queryService->select = [];
            $queryService->columnSearch = [];
            $queryService->withRelationship = [];
            $queryService->search = $search;
            $queryService->betweenDate = $betweenDate;
            $queryService->limit = $limit;
            $queryService->ascending = $ascending;
            $queryService->orderBy = $orderBy;

            $query = $queryService->queryTable();
            $query = $query->paginate($limit);
            $staffPosition = $query->toArray();

			return $this->jsonTable($staffPosition);
		} catch (\Exception $e) {
			return $this->jsonError($e);
		}
	}

	/**
	 * create
	 * @param StoreStaffPositionRequest $request
	 * @return JsonResponse
	 * @author tanmnt
	 */
	public function store(StoreStaffPositionRequest $request): JsonResponse
	{
		try {
		    $staffPosition = new StaffPosition();
		    $staffPosition->fill($request->all());
            $staffPosition->save();
			//{{CONTROLLER_RELATIONSHIP_MTM_CREATE_NOT_DELETE_THIS_LINE}}

			return $this->jsonData($staffPosition, Response::HTTP_CREATED);
		} catch (\Exception $e) {
			return $this->jsonError($e);
		}
	}

	/**
	 * get once by id
	 * @param StaffPosition $staffPosition
	 * @return JsonResponse
	 * @author tanmnt
	 */
	public function show(StaffPosition $staffPosition): JsonResponse
	{
		try {
		    //{{CONTROLLER_RELATIONSHIP_MTM_SHOW_NOT_DELETE_THIS_LINE}}

			return $this->jsonData($staffPosition);
		} catch (\Exception $e) {
			return $this->jsonError($e);
		}
	}

	/**
	 * update once by id
	 * @param StoreStaffPositionRequest $request
	 * @param StaffPosition $staffPosition
	 * @return JsonResponse
	 * @author tanmnt
	 */
	public function update(StoreStaffPositionRequest $request, StaffPosition $staffPosition): JsonResponse
	{
		try {
		    $staffPosition->fill($request->all());
            $staffPosition->save();
            //{{CONTROLLER_RELATIONSHIP_MTM_UPDATE_NOT_DELETE_THIS_LINE}}

			return $this->jsonData($staffPosition);
		} catch (\Exception $e) {
			return $this->jsonError($e);
		}
	}

	/**
	 * delete once by id
	 * @param StaffPosition $staffPosition
	 * @return JsonResponse
	 * @author tanmnt
	 */
    public function destroy(StaffPosition $staffPosition): JsonResponse
    {
	    try {
	        //{{CONTROLLER_RELATIONSHIP_MTM_DELETE_NOT_DELETE_THIS_LINE}}
			$staffPosition->delete();

		    return $this->jsonMessage(trans('messages.delete'));
	    } catch (\Exception $e) {
	    	return $this->jsonError($e);
	    }
    }

    //{{CONTROLLER_RELATIONSHIP_NOT_DELETE_THIS_LINE}}
}
