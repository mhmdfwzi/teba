<?php

// admin controllers
use  App\Http\Controllers\Backend\Admin\{
    AdminController,
    AttributesController,
    AttributeValuesController,
    BannerController,
    BrandsController,
    CategoriesController,
    ConfigNotificationsController,
    ConfigPaymentsController,
    ConfigSettingsController,
    ConfigSMSController,
    CouponController,
    DashboardController,
    DestinationController,
    OrderController,
    ProductsController,
    ProductVariantsController,
    RoleController,
    StoresController,
    VendorController,
    WebsitePartsController,
    DeliveryController,
    PaymentGatewayController,
    ProductPropertiesController,
    ReportsController,
};
use App\Http\Controllers\Backend\Admin\BlogsNewsController ;
use  App\Http\Controllers\Backend\Vendor\{

    DashboardController as VendorDashboardController,
    ProductsController as VendorProductsController,
    ProductVariantsController as VendorProductVariantsController,
    AttributesController as VendorAttributesController,
    AttributeValuesController as VendorAttributeValuesController,
    NotificationsController as VendorNotificationsController ,
    OrderController as VendorOrderController,
    CouponController as VendorCouponController


};

use  App\Http\Controllers\Backend\Delivery\{

    DashboardController as DeliveryDashboardController,
    OrdersController as DeliveryOrdersController,
    ReportsController as DeliveryReportsController,
};

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

//// admin routes
Route::group(
    [
    //// url prefix => ar/admin/
    'prefix' => LaravelLocalization::setLocale() . '/admin',
    'as' => 'admin.',
    'middleware' => [
      'auth:admin',
      'verified',
      'localeCookieRedirect', 'localizationRedirect', 'localeViewPath'
    ],
  ],
    function () {



        Route::get('/notifications_config', [ConfigNotificationsController::class, 'index'])->name('config.notifications');
        Route::post('/updatePusherSettings', [ConfigNotificationsController::class, 'updatePusherSettings'])
        ->name('config.updatePusherSettings');

        Route::get('/sms_config', [ConfigSMSController::class, 'index'])->name('config.sms');
        Route::post('/updateUltraMessageSettings', [ConfigSMSController::class, 'updateUltraMessageSettings'])
        ->name('config.updateUltraMessageSettings');



        Route::get('/payment_config', [ConfigPaymentsController::class, 'paymentConfig'])->name('config.payment');
        Route::post('/updatePaymobSettings', [ConfigPaymentsController::class, 'updatePaymobSettings'])
        ->name('config.updatePaymobSettings');


        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/charts', function () {
            return view('backend.Admin_Dashboard.dashboard.charts');
        });

        Route::resource('/categories', CategoriesController::class);
        Route::get('/trash', [CategoriesController::class, 'trash'])->name('categories.trash');
        Route::put('/restore/{category_id}', [CategoriesController::class, 'restore'])->name('categories.restore');
        Route::delete('/force_delete/{category_id}', [CategoriesController::class, 'forceDelete'])->name('categories.forceDelete');

        Route::resource('/banners', BannerController::class);

        Route::resource('/stores', StoresController::class);
        Route::get('/get-cities', [StoresController::class, 'getCities']);
        Route::get('/get-neighborhoods', [StoresController::class, 'getNeighborhoods']);
        Route::put('/updateStoreFeatured/{store_id}', [StoresController::class, 'updateStoreFeatured'])->name('stores.updateStoreFeatured');
        Route::put('/updateStoreStatus/{store_id}', [StoresController::class, 'updateStoreStatus'])->name('stores.updateStoreStatus');



        Route::resource('/destinations', DestinationController::class);


        Route::group([], function () {
          Route::get('blogs_news', [BlogsNewsController::class,'index'])->name('blogsNews.index');
          Route::get('blogs_news/create', [BlogsNewsController::class,'create'])->name('blogsNews.create');
          Route::post('blogs_news/store', [BlogsNewsController::class,'store'])->name('blogsNews.store');
          Route::get('blogs_news/edit/{id}', [BlogsNewsController::class,'edit'])->name('blogsNews.edit');
          Route::put('blogs_news/update/{id}', [BlogsNewsController::class,'update'])->name('blogsNews.update');
          Route::delete('blogs_news/destroy/{id}', [BlogsNewsController::class,'destroy'])->name('blogsNews.destroy');
      });
      
        Route::resource('/vendors', VendorController::class);
        Route::put('/updateVendorStatus/{vendor_id}', [VendorController::class, 'updateVendorStatus'])->name('vendors.updateVendorStatus');


        Route::resource('/products', ProductsController::class);
        Route::get('/add_variant/{product_id}', [ProductsController::class, 'add_variant'])->name('products.add_variant');

        Route::resource('/product_variants', ProductVariantsController::class);
        Route::get('/create_variant/{product_id}', [ProductVariantsController::class, 'create'])->name('product_variants.create');
        Route::get('/get_attribute_value/{attribute_id}', [ProductVariantsController::class, 'get_attribute_value'])->name('get_attribute_value');

        Route::resource('/attributes', AttributesController::class);

        Route::resource('/attribute_values', AttributeValuesController::class);

        Route::resource('/product_properties', ProductPropertiesController::class);

        Route::resource('/coupons', CouponController::class);

        Route::resource('/orders', OrderController::class);

        Route::get('/changeStatus/{order}/{status}', [OrderController::class,'changeStatus'])->name('orders.changeStatus');

        // Route::post('/order/assign_delivery', [OrderController::class,'assignDelivery'])->name('orders.assignDelivery');

        Route::resource('/websiteParts', WebsitePartsController::class);

        Route::resource('/brands', BrandsController::class);

        Route::resource('/deliveries', DeliveryController::class);

        Route::resource('/roles', RoleController::class);

        Route::resource('/admins', AdminController::class);

        Route::get('/orders_report/{status?}', [ReportsController::class,'index'])->name('reports.orders');

        Route::get('paymentGateways', [PaymentGatewayController::class,'index'])->name('paymentGateways.index');
        Route::get('paymentGateways/create', [PaymentGatewayController::class,'create'])->name('paymentGateways.create');
        Route::post('paymentGateways/store', [PaymentGatewayController::class,'store'])->name('paymentGateways.store');

        Route::get('paymentGateways/edit/{id}', [PaymentGatewayController::class,'edit'])->name('paymentGateways.edit');
        Route::put('paymentGateways/update/{id}', [PaymentGatewayController::class,'update'])->name('paymentGateways.update');
        Route::delete('paymentGateways/delete/{id}', [PaymentGatewayController::class,'delete'])->name('paymentGateways.destroy');

    }
);





// vendor dashboard
Route::group([
  // url prefix
  'prefix' => LaravelLocalization::setLocale() . '/vendor',
  'as' => 'vendor.',
  'middleware' => [
    'auth:vendor',
    'verified',
    'localeCookieRedirect', 'localizationRedirect', 'localeViewPath'
  ],

  ], function () {
      Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('dashboard');

      Route::resource('/products', VendorProductsController::class);

      Route::get('/edit_products_price', [VendorProductsController::class,'edit_products_price'])->name('products.edit_products_price');

      Route::put('/update_products_price', [VendorProductsController::class,'updateProductsPrice'])->name('products.update_products_price');

     
      Route::get('/product_variant', [VendorProductVariantsController::class, 'index'])->name('product_variants.index');
      Route::get('/create_product_variant/{product_id}', [VendorProductVariantsController::class, 'create'])->name('product_variants.create');
      Route::post('/store_product_variant', [VendorProductVariantsController::class, 'store'])->name('product_variants.store');

      Route::get('/edit_product_variant/{product_id}', [VendorProductVariantsController::class, 'edit'])->name('product_variants.edit');
      Route::delete('/delete_product_variant/{variant_id}', [VendorProductVariantsController::class, 'destroy'])->name('product_variants.delete');
      
	Route::put('/update_product_variant/{product_id}', [VendorProductVariantsController::class, 'update'])->name('product_variants.update');

      Route::get('/show_product_variant/{product_id}', [VendorProductVariantsController::class, 'show'])->name('product_variants.show');

      Route::get('/delete_product_variant/{product_id}', [VendorProductVariantsController::class, 'destroy'])->name('product_variants.destroy');

      // notes
      // Route::get('/create_product_variant/{product_id}', [VendorProductVariantsController::class, 'create'])->name('vendor.product_variants.create');

      Route::get('/get_attribute_value/{attribute_id}', [VendorProductVariantsController::class, 'get_attribute_value'])->name('get_attribute_value');

      Route::resource('/attributes', VendorAttributesController::class);

      Route::resource('/attribute_values', VendorAttributeValuesController::class);

      Route::resource('/coupons', VendorCouponController::class);

      Route::resource('/orders', VendorOrderController::class);

      Route::get('/notifications', [VendorNotificationsController::class, 'index'])->name('notifications.index');

  });





// vendor dashboard
Route::group([
  // url prefix
  'prefix' => LaravelLocalization::setLocale() . '/delivery',
  'as' => 'delivery.',
  'middleware' => [
    'auth:delivery',
    'verified',
    'localeCookieRedirect', 'localizationRedirect', 'localeViewPath'
  ],

  ], function () {


      Route::get('/dashboard', [DeliveryDashboardController::class, 'index'])->name('dashboard');

      Route::resource('/orders', DeliveryOrdersController::class);

      // not completed orders
      Route::get('/notCompletedOrders', [DeliveryOrdersController::class,'notCompletedOrders'])->name('orders.notCompletedOrders');

      Route::get('/adminOrders', [DeliveryOrdersController::class,'adminOrders'])->name('orders.adminOrders');


      Route::post('/delivery_admin/assign_delivery', [DeliveryOrdersController::class,'assignDelivery'])->name('orders.assignDelivery');

      Route::get('/changeStatus/{order_id}/{status}', [DeliveryOrdersController::class,'changeStatus'])->name('orders.changeStatus');
      Route::get('/changeOrdersStatus/{cart_id}/{status}', [DeliveryOrdersController::class,'changeOrdersStatusToComplete'])->name('orders.changeOrdersStatus');


      Route::get('/orders_report/{status?}', [DeliveryOrdersController::class,'orderReports'])->name('orders.reports');


      // reports
      Route::get('/delivered_reports', [DeliveryReportsController::class,'deliveredOrdersReport'])->name('deliveredOrders.reports');

      Route::get('/delivery_reports/{date?}', [DeliveryReportsController::class,'deliveryReport'])->name('reports.deliveryReport');

      Route::get('/admin_reports/{date?}', [DeliveryReportsController::class,'adminReport'])->name('reports.adminReport');

      Route::get('/admin_full_reports/{date?}', [DeliveryReportsController::class,'adminFullReport'])->name('reports.adminFullReport');


      
 
 
  });