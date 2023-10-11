Route::controller(HomeController::class)->group(function () {

     Route::get('/shipping-and-discounts','shipping_and_discounts')->name('admin.shipping-discounts');

     Route::post('/free-shipping-status', 'update_free_shipping_status')->name('free_shipping.published');

     Route::post('/free-shipping-update','shipping_and_discounts_update')->name('free.shipping.update');

     Route::post('/country-shipping-charge','add_country_shipping_charge')->name('add.country.shipping.charge');

     Route::get('/edit/country-shipping-charge/{id}','edit_country_shipping_charge')->name('edit.country.shipping.charge');

     Route::post('/update-country-shipping-charge','update_country_shipping_charge')->name('update.country.shipping.charge');

     Route::get('/delete-country-shipping-charge/{id}','delete_country_shipping_charge')->name('delete.country.shipping.charge');

     Route::post('/add-customer-type-discount','add_customer_type_discount')->name('add.customer.discount');

     Route::post('/update-customer-type-discount','update_customer_type_discount')->name('update.customer.discount');

     Route::get('/delete-customer-type-discount/{id}','delete_customer_type_discount')->name('delete.customer.discount');

     Route::post('/add-customer-type','add_customer_type')->name('add.customer.type');

     Route::post('/update-customer-type','update_customer_type')->name('update.customer.type');

     Route::post('/update-customer-type-status','update_ecustomer_type_status')->name('update.customer_type.status');

     

     Route::get('/warehouse/location','warehouse_location')->name('warehouse.location');

     Route::post('/add/warehouse/location','add_warehouse_location')->name('add.warehouse.location');

     Route::post('/update/warehouse/location','update_warehouse_location')->name('update.warehouse.location');

     Route::get('/delete/warehouse/location/{id}','delete_warehouse_location')->name('delete.warehouse.location');

     Route::post('/ajax/warehouse/location/search','ajax_warehouse_location_search')->name('location.ajax.search');

     Route::post('/update/warehouse/location/status','update_warehouse_location_status')->name('update.location.status');

     

     Route::post('/add-author', 'add_author')->name('add.author');

     Route::post('/popup-status', 'update_popup_status')->name('update.popup.status');

     Route::post('/update-popup', 'update_popup')->name('update.popup.content');

     });