Route::controller(ProductImportExportController::class)->group(function () {

     Route::get('/products/export/{attribute}','export')->name('products.export');

     Route::get('/products/import','import')->name('products.import');

     Route::post('/products/import', 'bulk_import')->name('bulk.import');

     Route::get('/excel/sample/download','sample_download')->name('excel.sample.download');

     Route::get('/excel/brand/download','brand_download')->name('excel.brand.download');

     Route::get('/excel/location/download','location_download')->name('excel.location.download');

     });