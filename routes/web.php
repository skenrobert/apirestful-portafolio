<?php
/*
|--------------------------------------------------------------------------
|  GPS/APP Routes
|--------------------------------------------------------------------------
*/


Auth::routes();

// Route::get('/event', function() {
//     event(new EventCreated('Hey how are you'));
// });

// Route::get('/welcome', function () {
//     return view('welcome');
// });

    // event
    Route::get('/event', 'PagesController@event');
     // listen
     Route::get('/listen', 'PagesController@listenBroadcast');

     Route::get('/listen2', 'ProviderPlanningController@listenBroadcast');

    
    

// Guest Routes
Route::group(['middleware' => 'guest'], function () {

    Route::post('validate', ['as' =>'login', 'uses' => 'AuthenticationController@login_validate'])->name('validate'); 
    
});

Route::group(['middleware' => 'auth'], function () {



    // Route::get('/accounts', 'PagesController@account_list');
    // Categories Page
    Route::get('/categories', 'PagesController@category_list');
    // // Contacts Page
    // Route::get('/contacts', 'PagesController@contact_list');
    // Bills to Pay Page
    Route::get('/topay', 'PagesController@billtopay_list');
    // Bills to Charge Page
    Route::get('/tocharge', 'PagesController@billtocharge_list');
    // Account Plan Page
    Route::get('/plan', 'PagesController@accountplan_list');
    // Notifications Page
    // Route::get('/notifications', 'PagesController@notifications');
    // // Rooms Page
    // Route::get('/rooms', 'PagesController@room_list');
    // // Lockers Page
    // Route::get('/lockers', 'PagesController@locker_list');
    // // Sites Page
    // Route::get('/sites', 'PagesController@site_list');
    // // Planning Page
    // Route::get('/planning', 'PagesController@planning_list');
    // // Models Page
    // Route::get('/models', 'PagesController@model_list');
    // Events Page
    // Route::get('/events', 'PagesController@event_list');
    // // Event Types Page
    // Route::get('/event_types', 'PagesController@event_type_list');
    // // // Providers Page
    // Route::get('/providers', 'PagesController@provider_list');
    
    
    // Route::get('/shop', 'PagesController@shop');
    Route::get('/items', 'PagesController@item_list');
    Route::get('/boutique', 'PagesController@boutique_list');
    Route::get('/audiovisuals', 'PagesController@audiovisual_list');

    // Route::get('/users', 'PagesController@user_list');


    // Test Page
    Route::get('/test', 'PagesController@test');

    Route::get('/', 'PagesController@notifications');




//***************************************ROUTE PAGE STUDY********************************************* */

Route::group(['middleware' => 'roleshinobi:study'], function () {

    // Route Dashboards
    Route::get('/dashboard-study', 'PagesStudyController@dashboard')->name('dashboard');
    // Route Page Model 
    Route::get('/dashboard-model-study', 'PagesStudyController@dashboard_model')->name('dashboard-model-study');
    // Route Page Monitor 
    Route::get('/dashboard-monitor-study', 'PagesStudyController@dashboard_monitor')->name('dashboard-monitor-study');
    // Route Apps
    Route::get('/app-calender-study', 'CalenderAppController@calenderApp');
    // Providers Page
    Route::get('/providers-study', 'PagesController@provider_list');

    // Route to Employees
    Route::get('/employees-study', 'PagesStudyController@employee_list');

    // Rooms Page
    Route::get('/rooms-study', 'PagesStudyController@room_list');
   // Lockers Page
   Route::get('/lockers-study', 'PagesStudyController@locker_list');
   // Sites Page
    Route::get('/sites-study', 'PagesStudyController@site_list');
   // Planning Page
   Route::get('/planning-study', 'PagesStudyController@planning_list');
   // accounts Page
   Route::get('/accounts-study', 'PagesStudyController@account_list');
   // requests Page
    Route::get('/requests-study', 'PagesStudyController@account_request_list');
    // Event Page
    Route::get('/events-study', 'PagesStudyController@event_list');
    // Event Types Page
    Route::get('/event-types-study', 'PagesStudyController@event_type_list');
    // Users Page
    Route::get('/users-study', 'PagesStudyController@user_list');
    // Contacts Page
    Route::get('/contacts-study', 'PagesStudyController@contact_list');
    // Users Pages
    Route::get('/profile-study', 'PagesStudyController@user_profile');


    // // Notifications Page
    // Route::get('/notifications-model', 'PagesModelController@notifications');
    // // Route to Diferent Event of Notification Type
    // Route::get('/myevents-model', 'PagesModelController@myevents');

    // Route::get('/shop-model', 'PagesModelController@shop');

    // // Route::get('/stats', 'PagesMonitorController@user_stats');

    // // Users Pages
    // Route::get('/profile-model', 'PagesModelController@user_profile');
    // // Route Profile Setting
    // Route::get('/settings', 'PagesModelController@user_settings');

});

//***************************************ROUTE PAGE SUB-STUDY********************************************* */

Route::group(['middleware' => 'roleshinobi:sub-study'], function () {

    // Route Dashboards
    Route::get('/dashboard-substudy', 'PagesSudstudyController@dashboard')->name('dashboard');
    // Route Page Model 
    Route::get('/dashboard-model-substudy', 'PagesSudstudyController@dashboard_model')->name('dashboard-model-substudy');
    // Route Page Monitor 
    Route::get('/dashboard-monitor-substudy', 'PagesSudstudyController@dashboard_monitor')->name('dashboard-monitor-substudy');
    // Route Apps
    Route::get('/app-calender-substudy', 'PagesSudstudyController@calenderApp');
    // Providers Page
    Route::get('/providers-substudy', 'PagesSudstudyController@provider_list');
    // Route to Employees
    Route::get('/employees-substudy', 'PagesSudstudyController@employee_list');
    // Rooms Page
    Route::get('/rooms-substudy', 'PagesSudstudyController@room_list');
   // Lockers Page
   Route::get('/lockers-substudy', 'PagesSudstudyController@locker_list');
    // accounts Page
    Route::get('/accounts-substudy', 'PagesSudstudyController@account_list');
   // Sites Page
    Route::get('/sites-substudy', 'PagesSudstudyController@site_list');
   // Planning Page
   Route::get('/planning-substudy', 'PagesSudstudyController@planning_list');
    // Event Page
   Route::get('/events-substudy', 'PagesSudstudyController@event_list');
   // Event Types Page
   Route::get('/event-types-substudy', 'PagesSudstudyController@event_type_list');
    // Users Page
    Route::get('/users-substudy', 'PagesSudstudyController@user_list');
    // Contacts Page
    Route::get('/contacts-substudy', 'PagesSudstudyController@contact_list');
    // Users Pages
    Route::get('/profile-substudy', 'PagesSudstudyController@user_profile');


});


//***************************************ROUTE PAGE Admin********************************************* */

Route::group(['middleware' => 'roleshinobi:admin'], function () {

    // Route Page Model 
    Route::get('/dashboard-admin', 'PagesAdminController@dashboard');

    // Notifications Page
    Route::get('/notifications-admin', 'PagesAdminController@notifications');
    // Users Pages
    Route::get('/model-list', 'PagesAdminController@user_profile');
    // Route Profile Setting
    Route::get('/settings', 'PagesAdminController@user_settings');

    Route::get('/stats-admin', 'PagesAdminController@user_profile');
   // Providers Page
   Route::get('/providers-admin', 'PagesAdminController@provider_list');

});


//***************************************ROUTE PAGE Manager********************************************* */

Route::group(['middleware' => 'roleshinobi:manager'], function () {

    // Route Page Model 
    Route::get('/dashboard-manager', 'PagesManagerController@dashboard');

    // Notifications Page
    Route::get('/notifications-manager', 'PagesManagerController@notifications');
    // Route Profile Setting
    Route::get('/settings', 'PagesManagerController@user_settings');

    Route::get('/stats-manager', 'PagesManagerController@user_profile');
    // Users Pages
    Route::get('/profile-manager', 'PagesManagerController@user_profile');
    
});




//***************************************ROUTE PAGE MONITOR********************************************* */
Route::group(['middleware' => 'roleshinobi:monitor'], function () {

    // Route Page Monitor 
    Route::get('/dashboard-monitor', 'PagesMonitorController@dashboard_monitor')->name('dashboard-monitor');
    // Notifications Page
    Route::get('/notifications', 'PagesMonitorController@notifications');
    // Models Page
    Route::get('/models', 'PagesMonitorController@model_list');
    // Route to Diferent Event of Notification Type
    Route::get('/myevents', 'PagesMonitorController@myevents');

    Route::get('/shop', 'PagesMonitorController@shop');

    // Route::get('/stats', 'PagesMonitorController@user_stats');

    // Users Pages
    Route::get('/profile', 'PagesMonitorController@user_profile');
    // Route Profile Setting
    Route::get('/settings', 'PagesMonitorController@user_settings');

});

//***************************************ROUTE PAGE MODEL********************************************* */

Route::group(['middleware' => 'roleshinobi:model'], function () {

    // Route Page Model 
    Route::get('/dashboard-model', 'PagesModelController@dashboard_model')->name('dashboard-model');

    // Notifications Page
    Route::get('/notifications-model', 'PagesModelController@notifications');
    // Route to Diferent Event of Notification Type
    Route::get('/myevents-model', 'PagesModelController@myevents');

    Route::get('/shop-model', 'PagesModelController@shop');

    // Route::get('/stats', 'PagesMonitorController@user_stats');

    // Users Pages
    Route::get('/profile-model', 'PagesModelController@user_profile');
    // Route Profile Setting
    Route::get('/settings', 'PagesModelController@user_settings');

});


//***************************************ROUTE PAGE Audiovisuales********************************************* */

Route::group(['middleware' => 'roleshinobi:photos'], function () {

    // Route Page Model 
    Route::get('/dashboard-photos', 'PagesPhotosController@dashboard');

    // Notifications Page
    Route::get('/notifications-photos', 'PagesPhotosController@notifications');
    // Users Pages
    Route::get('/profile-photos', 'PagesPhotosController@user_profile');
    // Route Profile Setting
    Route::get('/settings', 'PagesPhotosController@user_settings');

});

//***************************************ROUTE PAGE Contability********************************************* */

Route::group(['middleware' => 'roleshinobi:contab'], function () {

    // Route Page Model 
    Route::get('/dashboard-contab', 'PagesContabController@dashboard');

    // Notifications Page
    Route::get('/notifications-contab', 'PagesContabController@notifications');
    // Users Pages
    Route::get('/profile-contab', 'PagesContabController@user_profile');
    // Route Profile Setting
    Route::get('/settings', 'PagesContabController@user_settings');

    Route::get('/stats-contab', 'PagesContabController@user_profile');


});

//***************************************ROUTE PAGE Accounts********************************************* */

Route::group(['middleware' => 'roleshinobi:accounts'], function () {

    // Route Page Model 
    Route::get('/dashboard-accounts', 'PagesAccountsController@dashboard');

    // Notifications Page
    Route::get('/notifications-accounts', 'PagesAccountsController@notifications');
    // Users Pages
    Route::get('/profile-accounts', 'PagesAccountsController@user_profile');
    // Route Profile Setting
    Route::get('/settings', 'PagesAccountsController@user_settings');

    Route::get('/stats-accounts', 'PagesAccountsController@user_profile');
   // Providers Page
   Route::get('/providers-accounts', 'PagesAccountsController@provider_list');

});












});

// Route::get('/requests', 'PagesController@account_request_list');


// // Route Dashboards
// Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
// Route::get('/dashboard-monitor', 'DashboardController@dashboard_monitor')->name('dashboard-monitor');




// Route::group(['middleware' => 'auth','roleshinobi:model'], function () {

    // // Route Page Monitor 
    // Route::get('/dashboard-monitor', 'PagesMonitorController@dashboard_monitor')->name('dashboard-monitor');
    // // Notifications Page
    // Route::get('/notifications', 'PagesMonitorController@notifications');
    // // Models Page
    // Route::get('/models', 'PagesMonitorController@model_list');
    // // Route to Diferent Event of Notification Type
    // Route::get('/myevents', 'PagesMonitorController@myevents');

    // Route::get('/shop', 'PagesMonitorController@shop');

    // // Route::get('/stats', 'PagesMonitorController@user_stats');

    // // Users Pages
    // Route::get('/profile', 'PagesMonitorController@user_profile');
    // // Route Profile Setting
    // Route::get('/settings', 'PagesMonitorController@user_settings');

// });












// // Route Apps
// Route::get('/app-calender', 'CalenderAppController@calenderApp');
// // Route to Employees
// Route::get('/employees', 'EmployeeController@employee_list');
// // Users Pages
// Route::get('/profile', 'UserController@user_profile');
// // Route Profile Setting
// Route::get('/settings', 'UserController@user_settings');
// Route::get('/app-user-edit', 'UserPagesController@user_edit');
// Route::get('/app-user-new', 'UserPagesController@user_new');
// Providers Page
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
Route::get('/chart-apexEarnModels', 'ChartsController@apexEarnModels'); //la que uso para la funcion
Route::get('/chart-apexEarnStudies', 'ChartsController@apexEarnStudies'); //la que uso para la funcion
Route::get('/chart-apexProductionModels', 'ChartsController@apexProductionModels'); //la que uso para la funcion
Route::get('/chart-apexSubstudies', 'ChartsController@apexSubstudies'); //la que uso para la funcion
Route::get('/chart-apexStudies', 'ChartsController@apexStudies'); //la que uso para la funcion
Route::get('/chart-apexComissionStudies', 'ChartsController@apexComissionStudies'); //la que uso para la funcion
Route::get('/chart-apexComissionModel', 'ChartsController@apexComissionModel'); //la que uso para la funcion
Route::get('/chart-apexComissionMonitor', 'ChartsController@apexComissionMonitor'); //la que uso para la funcion
Route::get('/chart-apexEvent', 'ChartsController@apexEvent'); //la que uso para la funcion
Route::get('/chart-apexMonitor', 'ChartsController@apexMonitor'); //la que uso para la funcion
Route::get('/chart-apexTRM', 'ChartsController@apexTRM'); //la que uso para la funcion
Route::get('/chart-apex', 'ChartsController@apex'); //la que uso para la funcion
Route::get('/chart-apex2', 'ChartsController@apex2'); //la que uso para la funcion
Route::get('/chart-chartjs', 'ChartsController@chartjs');
Route::get('/chart-echarts', 'ChartsController@echarts');
Route::get('/maps-google', 'ChartsController@maps_google');