<?php
/*
|--------------------------------------------------------------------------
|  GPS/APP Routes
|--------------------------------------------------------------------------
*/

Auth::routes();

// Guest Routes
Route::group(['middleware' => 'guest'], function () {

    Route::post('validate', ['as' =>'login', 'uses' => 'AuthenticationController@login_validate'])->name('validate'); 
    
});

Route::group(['middleware' => 'auth'], function () {

    // Notifications Page
    Route::get('/notifications', 'PagesController@notifications');
    // Account Page
    // Rooms Page
    Route::get('/rooms', 'PagesController@room_list');
    // Lockers Page
    Route::get('/lockers', 'PagesController@locker_list');
    // Sites Page
    Route::get('/sites', 'PagesController@site_list');
    // Planning Page
    Route::get('/planning', 'PagesController@planning_list');
    // Models Page
    Route::get('/models', 'PagesController@model_list');
    // Events Page
    Route::get('/events', 'PagesController@event_list');
    // Event Types Page
    Route::get('/event_types', 'PagesController@event_type_list');
    



    Route::get('/', 'PagesController@notifications');

});

Route::get('/accounts', 'PagesController@account_list');
Route::get('/requests', 'PagesController@account_request_list');

// Route to Diferent Event of Notification Type
Route::get('/myevents', 'PagesController@myevents');
// Route Dashboards
Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
Route::get('/dashboard-model', 'DashboardController@dashboard_model')->name('dashboard-model');
Route::get('/dashboard-monitor', 'DashboardController@dashboard_monitor')->name('dashboard-monitor');
// Route Apps
Route::get('/app-calender', 'CalenderAppController@calenderApp');
// Route to Contacts
Route::get('/contacts', 'ContactController@contact_list');
// Route to Employees
Route::get('/employees', 'EmployeeController@employee_list');
// Users Pages
Route::get('/users', 'UserController@user_list');
Route::get('/profile', 'UserController@user_profile');
// Route Profile Setting
Route::get('/settings', 'UserController@user_settings');
// Route::get('/app-user-edit', 'UserPagesController@user_edit');
// Route::get('/app-user-new', 'UserPagesController@user_new');
// Providers Page
Route::get('/providers', 'ProviderController@provider_list');
// Route Color
Route::get('/colors', 'ContentController@colors');

Route::get('/auth-forgot-password', 'AuthenticationController@forgot_password');
Route::get('/auth-reset-password', 'AuthenticationController@reset_password');
Route::post('/auth_validate', 'AuthenticationController@auth_validate');
Route::get('/auth-lock-screen', 'AuthenticationController@lock_screen');
Route::get('/account-settings', 'PagesController@account_settings');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home/my-tokens', 'HomeController@getTokens')->name('personal-tokens');
Route::get('/home/my-clients', 'HomeController@getClients')->name('personal-clients');
Route::get('/home/authorized-clients', 'HomeController@getAuthorizedClients')->name('authorized-clients');  

// Route::get('/', function () {
//     return view('welcome');
// })->middleware('guest');
// //******************************************************************** */

// Authentication Routes...
// Route::get('login', [
//     'as' => 'login',
//     'uses' => 'AuthenticationController@login'
//   ]);
//   Route::post('validate', [
//     'as' => '',
//     'uses' => 'AuthenticationController@login_validate'
//   ]);
//   Route::post('logout', [
//     'as' => 'logout',
//     'uses' => 'Auth\LoginController@logout'
//   ]);
  
//   // Password Reset Routes...
//   Route::post('password/email', [
//     'as' => 'password.email',
//     'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
//   ]);
//   Route::get('password/reset', [
//     'as' => 'password.request',
//     'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
//   ]);
//   Route::post('password/reset', [
//     'as' => 'password.update',
//     'uses' => 'Auth\ResetPasswordController@reset'
//   ]);
//   Route::get('password/reset/{token}', [
//     'as' => 'password.reset',
//     'uses' => 'Auth\ResetPasswordController@showResetForm'
//   ]);


// Route Charts & Google Maps
Route::get('/chart-apexMonitor', 'ChartsController@apexMonitor'); //la que uso para la funcion
Route::get('/chart-apexTRM', 'ChartsController@apexTRM'); //la que uso para la funcion
Route::get('/chart-apex', 'ChartsController@apex'); //la que uso para la funcion
Route::get('/chart-chartjs', 'ChartsController@chartjs');
Route::get('/chart-echarts', 'ChartsController@echarts');
Route::get('/maps-google', 'ChartsController@maps_google');