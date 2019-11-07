<?php

use App\User as User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* For clear cache and etc */
    //Clear Cache facade value:
    Route::get('/clear-cache', function() {
        $exitCode = Artisan::call('cache:clear');
        return '<h1>Cache facade value cleared</h1>';
    });

    //Reoptimized class loader:
    Route::get('/optimize', function() {
        $exitCode = Artisan::call('optimize');
        return '<h1>Reoptimized class loader</h1>';
    });

    //Route cache:
    Route::get('/route-cache', function() {
        $exitCode = Artisan::call('route:cache');
        return '<h1>Routes cached</h1>';
    });

    //Clear Route cache:
    Route::get('/route-clear', function() {
        $exitCode = Artisan::call('route:clear');
        return '<h1>Route cache cleared</h1>';
    });

    //Clear View cache:
    Route::get('/view-clear', function() {
        $exitCode = Artisan::call('view:clear');
        return '<h1>View cache cleared</h1>';
    });

    //Clear Config cache:
    Route::get('/config-cache', function() {
        $exitCode = Artisan::call('config:cache');
        return '<h1>Clear Config cleared</h1>';
    });

Route::get('/', function () {
    $vendors=User::where('user_type','=','vendor')->skip(0)->take(6)->get();
    $data['vendors']=$vendors;
    return view('welcome', compact('data'));
});

Auth::routes();

// *************************** Frontend Page Start here ***********************
Route::get('/events', 'HomeController@events')->name('events');
Route::get('/event-details/{slug?}', 'HomeController@event_details')->name('event_details');
Route::get('/event-verticals/{slug?}', 'HomeController@event_vertical_list')->name('event_details');
Route::post('/login_check', 'AjaxController@login_check')->name('login_check');
Route::post('/popup_login', 'AjaxController@popup_login')->name('popup_login');
Route::post('/add_event_ajax', 'AjaxController@add_event_ajax')->name('add_event_ajax');
Route::post('/get_vendor_company_details', 'AjaxController@get_vendor_company_details')->name('get_vendor_company_details');
Route::post('/get_service_list_ajax', 'AjaxController@get_service_list_ajax')->name('get_service_list_ajax');
Route::post('/ajax_image_upload', 'AjaxController@ajax_image_upload')->name('ajax_image_upload');
Route::get('/vendors/{state?}/{v_cat?}', 'HomeController@vendors')->name('vendors');
Route::get('/vendor/{state?}/{v_cat?}/{id?}', 'HomeController@vendor')->name('vendor');

Route::get('/getquoteexhibitor', 'HomeController@getquoteexhibitor')->name('getquoteexhibitor');
Route::get('/company/{id?}', 'HomeController@company')->name('company');
Route::get('/companies', 'HomeController@companies')->name('companies');
// *************************** Frontend Page End here ***********************

// *************************** User Part Start here ***********************
Route::get('/my-account', 'UserController@index')->name('my-account');
Route::get('/dashboard', 'UserController@index')->name('dashboard');
Route::get('/edit-profile', 'UserController@edit_profile')->name('edit-profile');
Route::post('/edit-profile', 'UserController@edit_profile_submit')->name('edit-profile.submit');
Route::get('/my-event-calender', 'UserController@my_event_calender')->name('my-event-calender');
Route::get('/calender_data', 'UserController@calender_data')->name('calender_data');
Route::post('/calender_data_add', 'UserController@calender_data_add')->name('calender_data_add');
Route::get('/my-event-edit/{id?}', 'UserController@my_event_edit')->name('my_event_edit');
Route::post('/my-event-edit/', 'UserController@my_event_edit_submit')->name('my_event_edit.submit');
Route::get('/event-calender', 'UserController@event_calender')->name('event-calender');
Route::get('/edit-profile-gallery', 'UserController@edit_profile_gallery')->name('edit-profile-gallery');
Route::post('/edit-profile-gallery', 'UserController@edit_profile_gallery_submit')->name('edit-profile-gallery.submit');

// *************************** User Part end here ***********************


// *********************** Admin Part start here *************************
Route::prefix('admin')->group(function(){
    Route::get('/', 'AdminController@index');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('/general_settings', 'AdminController@general_settings')->name('admin.settings.general');
    Route::get('/pages', 'AdminController@pages')->name('admin.pages');
    Route::get('/add_page', 'AdminController@add_page')->name('admin.add_page');
    Route::post('/add_page', 'AdminController@addpagetodb')->name('admin.add_page.submit');
    /* ********************* For Event ********************************/
    Route::get('/events', 'AdminController@events')->name('admin.events');
    Route::get('/event_view/{id?}', 'AdminController@event_view')->name('admin.event_view');
    Route::post('/event_view/', 'AdminController@event_view_submit')->name('admin.event_view.submit');
    Route::get('/add_event/', 'AdminController@add_event')->name('admin.add_event');
    Route::post('/add_event/', 'AdminController@add_event_submit')->name('admin.add_event_submit');
    Route::get('/import_events', 'AdminController@import_events')->name('admin.import_events');
    Route::post('/import_events', 'AdminController@import_events_submit')->name('admin.import_events.submit');
    Route::post('/import_events_update', 'AdminController@event_import_update')->name('admin.import_events_update.submit');
    /*for event verticals only*/
    Route::get('/event_verticals', 'AdminController@event_verticals')->name('admin.event_verticals');
    Route::get('/add_verticals', 'AdminController@add_verticals')->name('admin.add_verticals');
    Route::post('/add_verticals', 'AdminController@add_event_verticals')->name('admin.add_event_verticals.submit');
    Route::get('/edit_event_verticals/{id?}', 'AdminController@edit_event_verticals')->name('admin.edit_event_verticals');
    Route::post('/edit_event_verticals', 'AdminController@edit_event_verticals_submit')->name('admin.edit_event_verticals.submit');
    Route::get('/import_event_verticals', 'AdminController@import_event_verticals')->name('admin.import_event_verticals');
    Route::post('/import_event_verticals', 'AdminController@import_event_verticals_submit')->name('admin.import_event_verticals.submit');
    /*event verticals end here*/

    /*for event type only*/
    Route::get('/event_types', 'AdminController@event_types')->name('admin.event_types');
    Route::get('/add_event_type', 'AdminController@add_event_type')->name('admin.add_event_type');
    Route::post('/add_event_type', 'AdminController@add_event_type_submit')->name('admin.add_event_type.submit');
    Route::get('/edit_event_type/{id?}', 'AdminController@edit_event_type')->name('admin.edit_event_type');
    Route::post('/edit_event_type', 'AdminController@edit_event_type_submit')->name('admin.edit_event_type.submit');
    /*event type end here*/

    /*For vendor category only*/
    Route::get('/vendor_categories', 'AdminController@vendor_categories')->name('admin.vendor_categories');
    Route::get('/add_vendor_category', 'AdminController@add_vendor_category')->name('admin.add_vendor_category');
    Route::post('/add_vendor_category', 'AdminController@add_vendor_category_submit')->name('admin.add_vendor_category.submit');
    Route::get('/edit_vendor_category/{id?}', 'AdminController@edit_vendor_category')->name('admin.edit_vendor_category');
    Route::post('/edit_vendor_category', 'AdminController@edit_vendor_category_submit')->name('admin.edit_vendor_category.submit');
    Route::get('/import_vendor_category', 'AdminController@import_vendor_category')->name('admin.import_vendor_category');
    Route::post('/import_vendor_category', 'AdminController@import_vendor_category_submit')->name('admin.import_vendor_category.submit');
    /*Vendor category end here*/

   
   // Route::get('/import_vendor_category', 'AdminController@import_vendor_category')->name('admin.import_vendor_category');
    //Route::post('/import_vendor_category', 'AdminController@import_vendor_category_submit')->name('admin.import_vendor_category.submit');
    /*Vendor testimonials end here*/

    /*For city only*/
    Route::get('/cities', 'AdminController@cities')->name('admin.cities');
    Route::get('/add_city', 'AdminController@add_city')->name('admin.add_city');
    Route::post('/add_city', 'AdminController@add_city_submit')->name('admin.add_city.submit');
    Route::get('/edit_city/{id?}', 'AdminController@edit_city')->name('admin.edit_city');
    Route::post('/edit_city', 'AdminController@edit_city_submit')->name('admin.edit_city.submit');
    Route::get('/import_city', 'AdminController@import_city')->name('admin.import_city');
    Route::post('/import_city', 'AdminController@import_city_submit')->name('admin.import_city.submit');

});

