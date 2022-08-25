<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2022-08-02 23:43:11
 * File: DataExcel.php
 */

namespace App\Http\Controllers\Api\v1;

use App\Jobs\ImportJob;
use App\Models\DataExcel;
use App\Services\QueryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreDataExcelRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DataExcelController extends Controller
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

            $queryService                   = new QueryService(new DataExcel);
            $queryService->select           = [];
            $queryService->columnSearch     = [];
            $queryService->withRelationship = [];
            $queryService->search           = $search;
            $queryService->betweenDate      = $betweenDate;
            $queryService->limit            = $limit;
            $queryService->ascending        = $ascending;
            $queryService->orderBy          = $orderBy;

            $query     = $queryService->queryTable();
            $query     = $query->paginate($limit);
            $dataExcel = $query->toArray();

            return $this->jsonTable($dataExcel);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * create
     * @param StoreDataExcelRequest $request
     * @return JsonResponse
     * @author tanmnt
     */
    public function store(StoreDataExcelRequest $request): JsonResponse
    {
        try {
            $dataExcel = new DataExcel();
            $dataExcel->fill($request->all());
            $dataExcel->save();
            //{{CONTROLLER_RELATIONSHIP_MTM_CREATE_NOT_DELETE_THIS_LINE}}

            return $this->jsonData($dataExcel, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * get once by id
     * @param DataExcel $dataExcel
     * @return JsonResponse
     * @author tanmnt
     */
    public function show(DataExcel $dataExcel): JsonResponse
    {
        try {
            //{{CONTROLLER_RELATIONSHIP_MTM_SHOW_NOT_DELETE_THIS_LINE}}

            return $this->jsonData($dataExcel);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * update once by id
     * @param StoreDataExcelRequest $request
     * @param DataExcel $dataExcel
     * @return JsonResponse
     * @author tanmnt
     */
    public function update(StoreDataExcelRequest $request, DataExcel $dataExcel): JsonResponse
    {
        try {
            $dataExcel->fill($request->all());
            $dataExcel->save();
            //{{CONTROLLER_RELATIONSHIP_MTM_UPDATE_NOT_DELETE_THIS_LINE}}

            return $this->jsonData($dataExcel);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * delete once by id
     * @param DataExcel $dataExcel
     * @return JsonResponse
     * @author tanmnt
     */
    public function destroy(DataExcel $dataExcel): JsonResponse
    {
        try {
            //{{CONTROLLER_RELATIONSHIP_MTM_DELETE_NOT_DELETE_THIS_LINE}}
            $dataExcel->delete();

            return $this->jsonMessage(trans('messages.delete'));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    public function import(Request $request)
    {
        try {
            ini_set('memory_limit', '-1');
            if ($request->hasFile('importFile')) {
                $disk     = \Storage::disk();
                $nameFile = Str::random(40);
                $extensionFile = $request->file('importFile')->getClientOriginalExtension();
                $fileName = $disk->putFileAs('/imports', $request->file('importFile'), $nameFile . '.' . $extensionFile);
                $fileName = 'public/' . $fileName;
//                $batch = \Bus::batch([
//                    new ImportJob($fileName),
//                ])->dispatch();
//                ImportJob::dispatch($fileName);

                return $this->jsonMessage('upload done, path: ' .$fileName);
            }
            return $this->jsonMessage('not upload file');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->jsonError($e);
        }
    }

    public function export()
    {
        return $this->jsonMessage('function export');
    }
    //{{CONTROLLER_RELATIONSHIP_NOT_DELETE_THIS_LINE}}
}
