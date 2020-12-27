<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Product Categories
    Route::apiResource('product-categories', 'ProductCategoryApiController');

    // Products
    Route::apiResource('products', 'ProductApiController');

    // Fakturs
    Route::post('fakturs/media', 'FakturApiController@storeMedia')->name('fakturs.storeMedia');
    Route::apiResource('fakturs', 'FakturApiController');

    // Pembayarans
    Route::post('pembayarans/media', 'PembayaranApiController@storeMedia')->name('pembayarans.storeMedia');
    Route::apiResource('pembayarans', 'PembayaranApiController');

    // Pelanggans
    Route::apiResource('pelanggans', 'PelangganApiController');

    // Weldings
    Route::post('weldings/media', 'WeldingApiController@storeMedia')->name('weldings.storeMedia');
    Route::apiResource('weldings', 'WeldingApiController');

    // Attendances
    Route::apiResource('attendances', 'AttendanceApiController');

    // Carts
    Route::apiResource('carts', 'CartApiController');

    // Overtimes
    Route::apiResource('overtimes', 'OvertimeApiController');

    // Deliveries
    Route::apiResource('deliveries', 'DeliveryApiController');

    // Crews
    Route::apiResource('crews', 'CrewApiController');

    // Kasbons
    Route::apiResource('kasbons', 'KasbonApiController');
});
