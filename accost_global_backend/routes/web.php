<?php

Route::get('/', 'Admin\AdminController@index');
Route::redirect('/home', url('/admin/dashboard'));
/*Route::get('/new-return-dealers', 'Admin\AdminController@getNewReturnDealers')->name('new_return_dealers');*/
Auth::routes();

/* Admin Routes  */
Route::middleware(['adminUser'])->prefix('admin')->group(function () {
    Route::get('/dashboard', 'Admin\AdminController@viewDashboard')->name('admin-dashboard');
    Route::get('/settings', 'Admin\AdminController@viewAccountSetting')->name('admin-settings');
    Route::get('/toggle-status/{model}/{column}/{id}/{msg?}/{redirect_page?}', 'Admin\AdminController@toggleStatus')->name('toggle-status');
    Route::post('/change-password', 'Admin\AdminController@updateAuthUserPassword')->name('change-password');
    Route::get('/edit-profile', 'Admin\AdminController@editAdminProfile')->name('edit-admin-profile');
    Route::get('/msg-notification', 'Admin\AdminController@get_msg_notification')->name('msg-notification');
    Route::post('/update-profile', 'Admin\AdminController@updateAdminProfile')->name('update-admin-profile');
    /*Product Super Category*/
    Route::get('/product-super-category', 'Admin\ProductSuperCategoryController@listSuperCategory')->name('listSuperCategory');
    Route::get('/product-super-category/new', 'Admin\ProductSuperCategoryController@newSuperCategory')->name('newSuperCategory');
    Route::post('/product-super-category/new', 'Admin\ProductSuperCategoryController@saveSuperCategory')->name('saveSuperCategory');
    Route::get('/product-super-category/super-category-data','Admin\ProductSuperCategoryController@superCatData')->name('pro-super-category-data');
    Route::get('/product-super-category/{id}/edit','Admin\ProductSuperCategoryController@edit')->name('edit-super-category');
    Route::post('/product-super-category/{id}/edit','Admin\ProductSuperCategoryController@update')->name('update-super-category');
    Route::get('/product-super-category/{id}/delete','Admin\ProductSuperCategoryController@destroy')->name('delete-super-category');
    Route::get('/product-super-category/{id}','Admin\ProductSuperCategoryController@view')->name('detail-super-category');
    Route::post('/product-super-category/unique','Admin\ProductSuperCategoryController@findUniqueSuperCat')->name('unique-super-category');
    /*Product Category*/
    Route::get('/product-category','Admin\ProductCategoryController@listCategory')->name('pro-category');
    Route::get('/product-category/product-category-data','Admin\ProductCategoryController@productCatData')->name('pro-category-data');
    Route::get('/product-category/new','Admin\ProductCategoryController@newCategory')->name('get-new-pro-category');
    Route::post('/product-category/new','Admin\ProductCategoryController@saveCategory')->name('post-new-pro-category');
    Route::get('/product-category/{id}/edit','Admin\ProductCategoryController@edit')->name('edit-pro-category');
    Route::post('/product-category/{id}/edit','Admin\ProductCategoryController@update')->name('update-pro-category');
    Route::get('/product-category/{id}/delete','Admin\ProductCategoryController@destroy')->name('delete-pro-category');
    Route::get('/product-category/{id}','Admin\ProductCategoryController@view')->name('detail-pro-category');


    /*Product Subcategory*/
    Route::get('/product-subcategory', 'Admin\catalog/product/edit@listSubcategory')->name('list-pro-subcat');
    Route::get('/product-subcategory/product-subcategory-data', 'Admin\ProductSubcategoryController@productSubcatData')->name('pro-subcat-data');
    Route::get('/product-subcategory/new', 'Admin\ProductSubcategoryController@newSubcategory')->name('new-pro-subcat');
    Route::post('/product-subcategory/new', 'Admin\ProductSubcategoryController@saveSubcategory')->name('save-pro-subcat');
    Route::get('/product-subcategory/{id}/edit','Admin\ProductSubcategoryController@edit')->name('edit-pro-subcat');
    Route::post('/product-subcategory/{id}/edit','Admin\ProductSubcategoryController@update')->name('update-pro-subcat');
    Route::get('/product-subcategory/{id}/delete','Admin\ProductSubcategoryController@destroy')->name('delete-pro-subcat');
    Route::get('/product-subcategory/{id}','Admin\ProductSubcategoryController@view')->name('view-pro-subcat');

    /*Manage pages*/
    Route::get('/manage-pages/', 'Admin\PagesController@listPages')->name('list-pages');
    Route::get('/manage-pages/page-data','Admin\PagesController@pageData')->name('static-pages-data');
    Route::get('/manage-pages/{id}/edit','Admin\PagesController@edit')->name('edit-static-pages');
    Route::post('/manage-pages/{id}/edit','Admin\PagesController@update')->name('update-static-pages');
    Route::get('/manage-pages/{id}','Admin\PagesController@view')->name('view-static-pages');
    Route::get('/manage-faq-pages/faq-data','Admin\PagesController@faqData')->name('data-faq-pages');
    Route::get('/manage-faq-pages/list','Admin\PagesController@listFaq')->name('list-faq-pages');
    Route::get('/manage-faq-pages/data','Admin\PagesController@faqData')->name('data-faq-pages');
    Route::get('/manage-faq-pages','Admin\PagesController@newFaq')->name('add-faq-pages');
    Route::post('/manage-faq-pages','Admin\PagesController@newFaq')->name('post-view-faq-pages');
    Route::get('/manage-faq-pages/{id}/edit','Admin\PagesController@editFaq')->name('edit-view-faq-pages');
    Route::post('/manage-faq-pages/{id}/edit','Admin\PagesController@editFaq')->name('post-edit-view-faq-pages');
    Route::get('/manage-faq-pages/{id}/view','Admin\PagesController@viewFaq')->name('view-faq-pages');
    Route::get('/manage-faq-pages/{id}/delete','Admin\PagesController@deleteFaq')->name('delete-faq-pages');

    /*Home Banner*/
    Route::get('/home-banner', 'Admin\HomeBannerController@listCategory')->name('list-home-banner');
    Route::get('/home-banner/home-banner-data', 'Admin\HomeBannerController@homeBannerData')->name('data-home-banner');
    Route::get('/home-banner/new', 'Admin\HomeBannerController@newBanner')->name('new-home-banner');
    Route::post('/home-banner/new', 'Admin\HomeBannerController@save')->name('save-home-banner');
    Route::get('/home-banner/{id}/edit', 'Admin\HomeBannerController@edit')->name('edit-home-banner');
    Route::post('/home-banner/{id}/edit', 'Admin\HomeBannerController@update')->name('update-home-banner');
    Route::get('/home-banner/{id}/delete', 'Admin\HomeBannerController@destroy')->name('delete-home-banner');
    Route::get('/home-banner/{id}', 'Admin\HomeBannerController@view')->name('view-home-banner');
    /*Products*/
    Route::get('/catalog/product/list', 'Admin\ProductController@productList')->name('product-list');
    Route::get('/catalog/product/new', 'Admin\ProductController@newProduct')->name('new-product');
    Route::post('/catalog/product/save', 'Admin\ProductController@saveProduct')->name('product-save');
    Route::post('/catalog/product/save-size/{prod_id}', 'Admin\ProductController@saveProductSize')->name('product-size');
    Route::get('/catalog/product/delete-size/{prod_id}/{size_id}', 'Admin\ProductController@deleteProductSize')->name('delete-product-size');
    Route::post('/catalog/product/getHighlight', 'Admin\ProductController@getHighlights')->name('product-highlights');
    Route::post('/catalog/product/save-highlight/{prod_id}', 'Admin\ProductController@saveProductHighlight')->name('product-save-highlight');
    Route::post('/catalog/product/get-related-products','Admin\ProductController@getRelatedProduct')->name('get-related-products');
    Route::post('/catalog/product/save-related-products','Admin\ProductController@saveRelatedProduct')->name('save-related-products');
    Route::post('/catalog/product/save-tag/{prod_id}','Admin\ProductController@saveProductTag')->name('save-products-tag');
    Route::post('/catalog/product/save-seo/{prod_id}','Admin\ProductController@saveProductSeo')->name('save-products-seo');
    Route::get('/catalog/product/view/{id}', 'Admin\ProductController@viewProduct')->name('view-product');
    Route::post('/catalog/product/save-related-product/{prod_id}', 'Admin\ProductController@saveRelatedProduct')->name('related-product-save');
    Route::get('/catalog/product/edit/{id}', 'Admin\ProductController@editProduct')->name('edit-product');
    Route::post('/catalog/product/update/{id}', 'Admin\ProductController@updateProduct')->name('update-product');
    Route::get('/catalog/product/status-update/{id}', 'Admin\ProductController@product_status_update')->name('status-update');
        /*softdelete*/
    Route::get('/catalog/product/trash', 'Admin\ProductController@trash_product')->name('trash');
    Route::get('/catalog/product/trash-product-data','Admin\ProductController@trash_productData')->name('trash_product-data');
    Route::get('/catalog/product/restore/{id}', 'Admin\ProductController@restore_single_product')->name('restore-single');
    Route::get('/catalog/product/restore', 'Admin\ProductController@restore_trash_product')->name('restore-all-product');
    Route::get('/catalog/product/destroy/{id}', 'Admin\ProductController@force_delete_product')->name('delete-trash-product');
    Route::delete('/catalog/product/destroy', 'Admin\ProductController@allTrashProductDelete')->name('delete-all-trash-product');
    /*end softdelete*/
    Route::get('/catalog/product/delete/{id}', 'Admin\ProductController@destroy')->name('delete-product');
    Route::delete('/catalog/product/delete-selected-product','Admin\ProductController@allProductDelete')->name('delete-selected-product');
    Route::get('/catalog/product/product-data','Admin\ProductController@productData')->name('product-data');
    Route::post('/catalog/product/image/upload/store/{id?}','Admin\ProductController@fileStore')->name('product-image-upload');
    Route::get('/catalog/product/image/delete/{id}/{image_id}','Admin\ProductController@fileDestroy')->name('product-image-delete');
    Route::get('/catalog/product/image/primary-image/{id}/{image_id}','Admin\ProductController@setPrimaryImage')->name('product-image-primary');
    Route::get('/catalog/product/edit/get/product/images','Admin\ProductController@getImages')->name('product-images-get');
    Route::post('/catalog/product/view/get/product/images','Admin\ProductController@getImages')->name('product-images-get');
    Route::get('/catalog/product/attribute/data','Admin\ProductController@getAttributeData')->name('attribute-data');
    Route::get('/catalog/product/get-product-category','Admin\ProductController@getProductCategory')->name('get-product-category');
    Route::get('/catalog/product/brand','Admin\ProductController@getBrand')->name('get-brand');
    Route::get('/catalog/product/get-product-sub-category','Admin\ProductController@getProductSubCategory')->name('get-product-subcategory');
    Route::get('/catalog/product/filter-products','Admin\ProductController@filterProducts')->name('filter-products');
    Route::get('/catalog/product/filter-results','Admin\ProductController@filterResults')->name('filter-results');
    Route::post('/catalog/product/unique','Admin\ProductController@findUniqueName')->name('unique-product-name');
    Route::get('/top-deals','Admin\ProductController@topDeals')->name('list-top-deals');

/* Manage Dealers*/
    Route::get('/dealers/add','Admin\DealerController@addDealer')->name('add-dealer');
    Route::post('dealers/save','Admin\DealerController@saveDealer')->name('save-dealer');
    Route::get('dealers/list','Admin\DealerController@listDealer')->name('list-dealer');
    Route::get('dealers/view/{id}','Admin\DealerController@viewDealer')->name('view-dealer');
    Route::get('dealers/edit/{id}','Admin\DealerController@editDealer')->name('edit-dealer');
    Route::post('dealers/{id}/update','Admin\DealerController@updateDealer')->name('update-dealer');
    Route::get('dealers/{id}/delete','Admin\DealerController@deleteDealer')->name('delete-dealer');
    Route::get('/dealers/dealer-data','Admin\DealerController@dealerData')->name('dealer-data');
    Route::get('dealers/export', 'Admin\DealerController@export')->name('export');
    Route::get('dealers/importExportView', 'Admin\DealerController@importExportView');
    Route::post('dealers/import', 'Admin\DealerController@import')->name('import');
    Route::get('dealers/import', 'Admin\DealerController@import');
    /* Manage Product Types */
    Route::get('/product-types/add','Admin\ProductTypeController@addProductType')->name('add-product-type');
    Route::post('/product-types/save','Admin\ProductTypeController@saveProductType')->name('save-product-type');
    Route::get('/product-types/list','Admin\ProductTypeController@listProductType')->name('list-product-type');
    Route::get('/product-types/product-type-data','Admin\ProductTypeController@productTypeData')->name('product-type-data');
    Route::get('/product-types/view/{id}','Admin\ProductTypeController@viewProductType')->name('view-product-type');
    Route::get('product-types/edit/{id}','Admin\ProductTypeController@editProductType')->name('edit-product-type');
    Route::post('product-types/update/{id}','Admin\ProductTypeController@updateProductType')->name('update-product-type');
    Route::get('product-types/delete/{id}','Admin\ProductTypeController@deleteProductType')->name('delete-product-type');
    Route::post('product-types/unique','Admin\ProductTypeController@findUniqueType')->name('unique-product-type');

    /* Manage Taxes */
    Route::get('/taxes/list','Admin\TaxController@listTaxes')->name('list-taxes');
    Route::get('/taxes/add','Admin\TaxController@addTaxes')->name('add-taxes');
    Route::post('/taxes/save','Admin\TaxController@saveTaxes')->name('save-taxes');
    Route::get('/taxes/view/{id}','Admin\TaxController@viewTaxes')->name('view-taxes');
    Route::get('/taxes/edit/{id}','Admin\TaxController@editTaxes')->name('edit-taxes');
    Route::post('/taxes/update/{id}','Admin\TaxController@updateTaxes')->name('update-taxes');
    Route::get('taxes/delete/{id}','Admin\TaxController@deleteTaxes')->name('delete-taxes');
    Route::get('/taxes/taxes-data','Admin\TaxController@taxesData')->name('taxes-data');
    Route::post('taxes/add-country','Admin\TaxController@addCountry')->name('add-country');
    Route::post('taxes/add-state','Admin\TaxController@addState')->name('add-state');
    Route::get('taxes/get-related-states','Admin\TaxController@getRelatedStates')->name('get-related-states');
    Route::post('/taxes/verify-taxes','Admin\TaxController@verifyUniqueTaxes')->name('verify-taxes');

    /* Discount & Promotion Management */
    Route::get('/discount-coupons/list','Admin\CouponController@listDiscountCoupons')->name('list-coupons');
    Route::get('/discount-coupons/new','Admin\CouponController@newDiscountCoupons')->name('new-coupons');
    Route::post('/discount-coupons/save','Admin\CouponController@saveDiscountCoupons')->name('save-coupons');
    Route::get('/discount-coupons/coupon-data','Admin\CouponController@couponData')->name('coupons-data');
    Route::get('/discount-coupons/edit/{id}','Admin\CouponController@editDiscountCoupons')->name('edit-coupons');
    Route::post('/discount-coupons/update/{id}','Admin\CouponController@updateDiscountCoupons')->name('update-coupons');
    Route::get('/discount-coupons/view/{id}','Admin\CouponController@viewDiscountCoupons')->name('view-coupons');
    Route::get('/discount-coupons/delete/{id}','Admin\CouponController@deleteDiscountCoupons')->name('delete-coupons');
    Route::get('/discount-coupons/{coupon_id}/apply-coupon/new','Admin\CouponController@ApplyCoupons')->name('apply-coupons');
    Route::post('/discount-coupons/apply-coupon/save/{coupon_id}','Admin\CouponController@saveApplyCoupons')->name('save-apply-coupons-category');
    Route::post('/save_coupon_categories','Admin\CouponController@save_coupon_categories')->name('save_coupon_categories');
    Route::post('/delete_coupon_categories','Admin\CouponController@delete_coupon_categories')->name('delete_coupon_categories');
    Route::post('/add_products','Admin\CouponController@add_products')->name('add_products');
    Route::get('/product-list/{coupon_id?}','Admin\CouponController@product_list')->name('list-product');
    Route::post('/unique-coupon-name','Admin\CouponController@findUniqueCouponName')->name('unique-coupon-name');
    Route::post('/unique-coupon-code','Admin\CouponController@findUniqueCouponCode')->name('unique-coupon-code');
    /*Highlisht Set*/
    Route::get('/catalog/highlight/new','Admin\HighlightController@newHighlight')->name('new-highlight');
    Route::post('/catalog/highlight/new','Admin\HighlightController@saveHighlight')->name('save-highlight');
    Route::get('/catalog/highlight/{id}/edit','Admin\HighlightController@edit')->name('edit-highlight');
    Route::get('/catalog/highlight/list','Admin\HighlightController@listHighlight')->name('list-highlight');
    Route::get('/catalog/highlight/highlight-data','Admin\HighlightController@highlightData')->name('highlight-data');
    Route::get('/catalog/highlight/view/{id}','Admin\HighlightController@viewHighlight')->name('view-highlight');
    Route::get('/catalog/highlight/{id}/delete','Admin\HighlightController@deleteHighlight')->name('delete-highlight');
    Route::post('/catalog/highlight/{id}/update','Admin\HighlightController@update')->name('update-highlight');
    Route::post('/catalog/highlight/unique','Admin\HighlightController@findUniqueHighlight')->name('unique-highlight-name');

    /*homepage */
    Route::get('/top-categories','Admin\HomePageController@topCategories')->name('list-top-categories');
    Route::get('/products','Admin\HomePageController@getProductList')->name('list-products');
    Route::get('/top-ranked-products','Admin\HomePageController@getTopRankedProducts')->name('list-top-ranked-products');
    Route::post('/top-ranked-products/save','Admin\HomePageController@saveTopRankedProducts')->name('save-top-ranked-products');

    /*Product Stocks*/
    Route::get('/catalog/product/stocks','Admin\ProductController@productStockList')->name('product-stock');
    Route::get('/catalog/product/stocks-view/{id}','Admin\ProductController@addProductStock')->name('view-product-stock');
    Route::post('/catalog/product/stocks-view/{id}','Admin\ProductController@addProductStock')->name('add-product-stock');

    /*brand*/
    Route::get('/catalog/brand','Admin\BrandController@listBrand')->name('list-brand');
    Route::get('/catalog/brand/brand-data','Admin\BrandController@brandData')->name('brand-data');
    Route::get('/catalog/brand/add-brand','Admin\BrandController@addBrand')->name('add-brand');
    Route::post('/catalog/brand/new','Admin\BrandController@saveBrand')->name('save-brand');
    Route::get('/catalog/brand/{id}/edit','Admin\BrandController@edit')->name('edit-brand');
    Route::post('/catalog/brand/{id}/edit','Admin\BrandController@update')->name('update-brand');
    Route::get('/catalog/brand/{id}/delete','Admin\BrandController@destroy')->name('delete-brand');
    Route::get('/catalog/brand/{id}','Admin\BrandController@view')->name('detail-brand');
    Route::post('brand/unique','Admin\BrandController@findUniqueBrand')->name('unique-brand');

    /*Message*/
    Route::get('/messages','Admin\MessageController@listMessages')->name('list-messages');
    Route::get('/messages/message-data','Admin\MessageController@messageData')->name('messages-data');

    Route::get('/messages/{id}/delete','Admin\MessageController@destroy')->name('delete-message');
    Route::get('/messages/{id}/view','Admin\MessageController@view')->name('view-message');
    Route::get('/messages/filter-messages','Admin\MessageController@filterMessages')->name('filter-messages');
    Route::get('/messages/filter-results','Admin\MessageController@filterResults')->name('filter-messages-results');
    Route::post('/messages/send-message/send','Admin\MessageController@sendMessage')->name('send-message');
    Route::post('/messages/getCoupon','Admin\MessageController@getCoupon')->name('get-coupon');
    Route::get('/messages/notification','Admin\MessageController@get_msg_all_notification')->name('messages-notification');
    Route::post('/messages/notification-status','Admin\MessageController@notification_status')->name('notification-status');
    Route::get('/messages/conversation/{sender_id}/{product_id}','Admin\MessageController@get_conversation')->name('get-conversation');
    Route::get('/clear-all','Admin\MessageController@clear_all_notification')->name('clear-all');
    Route::get('/test','Admin\MessageController@test')->name('test');
    Route::get('/notification-automation','Admin\MessageController@notification_automation')->name('notification_automation');

    /*order management*/
    Route::get('/order','Admin\OrderController@listOrder')->name('list-order');
    Route::get('/order/{canceld-orders ?}','Admin\OrderController@listOrder')->name('canceld-orders');
    Route::get('/order/order-data','Admin\OrderController@orderData')->name('order-data');
    Route::get('/order/{id}/edit','Admin\OrderController@edit')->name('edit-order');
    Route::post('/order/{id}/edit','Admin\OrderController@update')->name('update-order');
    Route::get('/order/{id}/edit-payment-status','Admin\OrderController@edit')->name('edit-payment-status');
    Route::post('/order/{id}/edit-payment-status','Admin\OrderController@update')->name('update-payment-status');
    Route::get('/order/{id}/delete','Admin\OrderController@destroy')->name('delete-order');
    Route::get('/order/{id}/address_details','Admin\OrderController@order_details')->name('order-address-details');
    Route::get('/order/{id}/shipping_details','Admin\OrderController@order_details')->name('order-shipping-details');
    Route::get('/order/{id}/payment_details','Admin\OrderController@order_details')->name('order-payment-details');
    Route::get('/order/{id}/items_details','Admin\OrderController@order_details')->name('order-items-details');
    Route::get('order/export', 'Admin\OrderController@export')->name('export-order');
    /*Sales management*/
    Route::get('/sales','Admin\SalesController@listSales')->name('list-sales');
    Route::get('/sales/sales-data','Admin\SalesController@salesData')->name('sales-data');
    Route::get('/sales/{id}/delete','Admin\SalesController@destroy')->name('delete-sales');
    Route::get('/sales/{id}/address_details','Admin\SalesController@sales_details')->name('sales-address-details');
    Route::get('/sales/{id}/shipping_details','Admin\SalesController@sales_details')->name('sales-shipping-details');
    Route::get('/sales/{id}/payment_details','Admin\SalesController@sales_details')->name('sales-payment-details');
    Route::get('/sales/{id}/items_details','Admin\SalesController@sales_details')->name('sales-items-details');
    Route::get('sales/export', 'Admin\SalesController@export')->name('export-sales');
    Route::get('/sales/filter-products','Admin\SalesController@filterSales')->name('filter-sales');
    Route::get('/sales/filter-results','Admin\SalesController@filterResults')->name('filter-sales-results');
    /*top selling product */
    Route::get('/top-selling-product','Admin\TopSellingProductController@listTopSellingProduct')->name('top_sell_product_list');
    Route::get('/top-selling-product/product-data','Admin\TopSellingProductController@TopSellProductData')->name('top_sell_product_data');
    Route::get('/top-selling-product/filter-products','Admin\TopSellingProductController@filterProducts')->name('top-filter-products');
    Route::get('/top-selling-product/filter-results','Admin\TopSellingProductController@filterResults')->name('top-filter-results');
    Route::get('top-selling-product/export', 'Admin\TopSellingProductController@export')->name('export-top-selling-product');
});
