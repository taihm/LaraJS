<?php
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => 'optimizeImages'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::get('/language/{language}', 'LaraJSController@setLanguage');
Route::post('/logging', 'LaraJSController@logging');
// Send reset password mail
Route::post('/forgot-password', 'AuthController@forgotPassword');
// Handle reset password form process
Route::post('/reset-password', 'AuthController@resetPassword');
// START - Auth
Route::post('/fe-login', 'AuthController@feLogin');
Route::post('/refresh-token', 'AuthController@refreshToken');
Route::post('/login', 'AuthController@login');

Route::group(['prefix' => 'data-excels'], function () {
    Route::get('export', 'DataExcelController@export');
    Route::get('batch', 'DataExcelController@getBatch');
    Route::post('import', 'DataExcelController@import');
});

Route::group(['prefix' => 'staff'], function () {
    Route::get('get-data-create', 'StaffController@getDataCreate');
});
// END - Auth
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/fe-logout', 'AuthController@feLogout');
    Route::get('/user-info', 'UserController@userInfo');
    Route::get('/logout', 'AuthController@logout');
    Route::group(['middleware' => 'verify_request'], function () {});
    // permission manage permission
    Route::group(
        [
            'middleware' => 'permission:' . \ACL::PERMISSION_PERMISSION_MANAGE,
        ],
        function () {
            Route::apiResource('roles', 'RoleController');
            Route::apiResource('permissions', 'PermissionController');
        }
    );
    // role Admin (Super admin)
    Route::group(['middleware' => 'role:' . \ACL::ROLE_ADMIN], function () {
        Route::group(['prefix' => 'generators'], function () {
            Route::get('check-model', 'GeneratorController@checkModel');
            Route::get('check-column', 'GeneratorController@checkColumn');
            Route::get('get-models', 'GeneratorController@getModels');
            Route::get('get-all-models', 'GeneratorController@getAllModels');
            Route::get('get-columns', 'GeneratorController@getColumns');
            Route::post('relationship', 'GeneratorController@generateRelationship');
            Route::get('diagram', 'GeneratorController@generateDiagram');
        });
        Route::apiResource('generators', 'GeneratorController');
        Route::apiResource('users', 'UserController');
        /*<==> Building Route - 2022-09-22 23:20:18 <==>*/
    Route::apiResource('buildings', 'BuildingController');
        //{{ROUTE_ADMIN_NOT_DELETE_THIS_LINE}}
    });

    /*<==> DataExcel Route - 2022-08-02 23:43:11 <==>*/

    Route::apiResource('data-excels', 'DataExcelController');
    /*<==> Staff Route - 2022-09-23 00:15:42 <==>*/
    Route::apiResource('staff', 'StaffController');
    /*<==> StaffPosition Route - 2022-09-23 00:33:37 <==>*/
    Route::apiResource('staff-positions', 'StaffPositionController');
    /*<==> SupportService Route - 2022-09-23 01:00:48 <==>*/
    Route::apiResource('support-services', 'SupportServiceController');
    //{{ROUTE_USER_NOT_DELETE_THIS_LINE}}
});

Route::fallback(function () {
    return response()->json(
        [
            'message' => trans('error.404'),
        ],
        404
    );
});
