<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Files
    Route::post('files/media', 'FilesApiController@storeMedia')->name('files.storeMedia');
    Route::apiResource('files', 'FilesApiController');

    // Teams
    Route::apiResource('teams', 'TeamApiController');
});
