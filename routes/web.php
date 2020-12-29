<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Product Categories
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::resource('product-categories', 'ProductCategoryController');

    // Products
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::resource('products', 'ProductController');

    // Fakturs
    Route::delete('fakturs/destroy', 'FakturController@massDestroy')->name('fakturs.massDestroy');
    Route::post('fakturs/media', 'FakturController@storeMedia')->name('fakturs.storeMedia');
    Route::post('fakturs/ckmedia', 'FakturController@storeCKEditorImages')->name('fakturs.storeCKEditorImages');
    Route::resource('fakturs', 'FakturController');

    // Pembayarans
    Route::delete('pembayarans/destroy', 'PembayaranController@massDestroy')->name('pembayarans.massDestroy');
    Route::post('pembayarans/media', 'PembayaranController@storeMedia')->name('pembayarans.storeMedia');
    Route::post('pembayarans/ckmedia', 'PembayaranController@storeCKEditorImages')->name('pembayarans.storeCKEditorImages');
    Route::resource('pembayarans', 'PembayaranController');

    // Pelanggans
    Route::delete('pelanggans/destroy', 'PelangganController@massDestroy')->name('pelanggans.massDestroy');
    Route::resource('pelanggans', 'PelangganController');

    // Weldings
    Route::post('weldings/import', 'WeldingController@import')->name('weldingImport');
    Route::get('weldings/import_template', 'WeldingController@importTemplate')->name('weldingImportTemplate');
    Route::delete('weldings/destroy', 'WeldingController@massDestroy')->name('weldings.massDestroy');
    Route::resource('weldings', 'WeldingController');

    // Attendances
    Route::delete('attendances/destroy', 'AttendanceController@massDestroy')->name('attendances.massDestroy');
    Route::resource('attendances', 'AttendanceController');

    // Carts
    Route::delete('carts/destroy', 'CartController@massDestroy')->name('carts.massDestroy');
    Route::resource('carts', 'CartController');

    // Overtimes
    Route::delete('overtimes/destroy', 'OvertimeController@massDestroy')->name('overtimes.massDestroy');
    Route::resource('overtimes', 'OvertimeController');

    // Deliveries
    Route::post('deliveries/import', 'DeliveryController@import')->name('deliveryImport');
    Route::delete('deliveries/destroy', 'DeliveryController@massDestroy')->name('deliveries.massDestroy');
    Route::resource('deliveries', 'DeliveryController');

    // Crews
    Route::delete('crews/destroy', 'CrewController@massDestroy')->name('crews.massDestroy');
    Route::resource('crews', 'CrewController');

    // Kasbons
    Route::delete('kasbons/destroy', 'KasbonController@massDestroy')->name('kasbons.massDestroy');
    Route::resource('kasbons', 'KasbonController');

    // Salaries
    Route::delete('salaries/destroy', 'SalaryController@massDestroy')->name('salaries.massDestroy');
    Route::resource('salaries', 'SalaryController');

    // Content Categories
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tags
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Pages
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');

    // Faq Categories
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Questions
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
