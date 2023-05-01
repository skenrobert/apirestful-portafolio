<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group([
//   'prefix' => 'auth'
// ], function () {
//   Route::post('login', 'AuthController@login');
//   Route::post('register', 'AuthController@register');

//   Route::group([
//     'middleware' => 'auth:api'
//   ], function() {
//       Route::get('logout', 'AuthController@logout');
//       Route::get('user', 'AuthController@user');
//   });

// });


Route::get('binnacle', 'EventController@binnacle')->name('bitacora_sistema');




Route::get('totalevents/{id}', 'UserController@totalEvents')->name('totalevents');

Route::ApiResource('users','UserController');//Elimina los metodos inecesarios para las opi
Route::post('usersStoreRole/{id}', 'UserController@storeRole')->name('usersStoreRole');
// Route::post('revokeRole/{id}', 'UserController@storeRole')->name('revokeRole');


Route::ApiResource('people','PersonController');
            // Route::get('peopleOnly', 'PersonController@onlyperson')->name('OnlyPerson');
// Route::get('people', 'PersonController@getAll')->name('getAllPeople');
// Route::post('people', 'PersonController@add')->name('addPerson');
              // Route::get('people/{id}', 'PersonController@get')->name('getPerson');
// Route::post('people/{id}', 'PersonController@edit')->name('editPerson');
Route::get('people/delete/{id}', 'PersonController@delete')->name('deletePerson');



 //controlador de m a m
//  Route::get('provider.locker', 'ProviderLockerController@index')->name('provider.Locker');//TODO: falta terminar el metodo

/**********************
 * 
Provides

*/
 Route::get('providerType', 'ProviderController@providerGetAllType')->name('providerType');
 Route::get('providerAccounts', 'ProviderController@providerGetAllAccounts')->name('allaccount');
 Route::get('providerAccount/{id}', 'ProviderController@providerShowAccount')->name('providerAccount');

 Route::ApiResource('providers','ProviderController');

 Route::ApiResource('accountreceiptproviders','AccountReceiptProviderController');


//  Route::get('providerEvents', 'ProviderController@providerGetAllEvent')->name('providerEvents');

 Route::Resource('providers.lockers','ProviderLockerController', ['only'=> ['index','update','destroy']]);

//  Route::get('providerLocker', 'ProviderController@providerGetAllLocker')->name('providerLocker');//TODO: falta terminar el metodo


Route::ApiResource('providerplanning','ProviderPlanningController');

Route::Resource('providerwithoutlocker/{id}', 'ProviderwithoutlockerController', ['only'=> ['index']]);
Route::Resource('providerwithoutroom/{id}', 'ProviderwithoutRoomController', ['only'=> ['index']]);

// Route::Resource('provideraccount','CompanyProviderAccountController', ['only'=> ['index','update']]);


// Route::get('getAllProviderEvent',[
//     'uses' => 'ProviderController@getAllProviderEvent',
//     'as'   => 'providers.getAllEvent'
//   ]);


/**********************
 * 
Employee

*/

Route::ApiResource('employees','EmployeeController');

// Route::get('employeeType', 'EmployeeController@employeeGetAllType')->name('Type');
Route::get('employeeAccount', 'EmployeeController@employeeGetAllAccounts')->name('employeeAccount');
Route::get('employeeAccount/{id}', 'EmployeeController@employeeShowAccount')->name('employeeAccount');


Route::ApiResource('monitorshifts','MonitorShiftController');

Route::get('monitorshiftsEmployee', 'MonitorShiftController@monitores')->name('roleMonitor');


/**********************
 * 
SHINOBI

*/
Route::ApiResource('roles','RoleController');
Route::ApiResource('permissions','PermissionController');

Route::ApiResource('accounts','AccountController');
Route::ApiResource('accountings','AccountingController');
Route::ApiResource('activies','ActivitieController');
Route::ApiResource('assistancecontrols','AssistanceControlController');
Route::ApiResource('audiovisuals','AudiovisualController');
Route::ApiResource('audits','AuditController');
Route::ApiResource('auditshifts','AuditShiftController');
Route::ApiResource('banks','BankController');
Route::ApiResource('billtocharges','BillToChargeController');
Route::ApiResource('billtopays','BillToPayController');

Route::ApiResource('boutiques','BoutiqueController');
Route::post('boutiqueupdateimage/{boutique}', 'BoutiqueController@updateImage');
Route::post('companyupdateimage/{company}', 'CompanyController@updateImage');
Route::post('itemupdateimage/{item}', 'ItemController@updateImage');
Route::post('providerupdateimage/{provider}', 'ProviderController@updateImage');
Route::post('userupdateimage/{user}', 'UserController@updateImage');
Route::post('auditshiftupdateimage/{auditshift}', 'AuditShiftController@updateImage');
Route::post('audiovisualupdateimage/{audiovisual}', 'AudiovisualController@updateImage');

Route::ApiResource('categories','CategoryController');
// Route::ApiResource('clients','ClientController');

Route::ApiResource('accountplans','AccountPlanController');//Elimina los metodos i

/**
 * company
 */

Route::Resource('companies.accountreceiptproviders','CompanyAccountReceiptProviderController', ['only'=> ['index']]);


Route::ApiResource('companies','CompanyController');
Route::ApiResource('companytypes','CompanyTypeController');

Route::Resource('companies.employees','CompanyEmployeeController', ['only'=> ['index','update','destroy']]);
Route::Resource('companies.providers','CompanyProviderController', ['only'=> ['index','update','destroy']]);

Route::Resource('companies.shops','CompanyShopController', ['only'=> ['index']]);
Route::Resource('companies.saleinvoices','CompanySaleInvoiceController', ['only'=> ['index']]);


Route::Resource('companiesroles','CompanyRoleController', ['only'=> ['index','update']]);


Route::Resource('companies.accounts','CompanyAccountController', ['only'=> ['index']]);
Route::Resource('companies.lockers','CompanyLockerController', ['only'=> ['index','update','destroy']]);
Route::Resource('companies.productionmaster','CompanyProductionMasterController', ['only'=> ['index','update','destroy']]);
Route::Resource('companies.tasks','CompanyTaskController', ['only'=> ['index','update','destroy']]);
Route::Resource('companies.boutiques','CompanyBoutiqueController', ['only'=> ['index','update','destroy']]);

Route::Resource('companies.accountproductiondetails','CompanyAccountProductionDetailsController', ['only'=> ['index','show']]);
Route::Resource('companies.productiondetailsdays','CompanyProductionDetailsDaysController', ['only'=> ['index']]);
Route::Resource('companies.productiondetailsshift','CompanyProductionDetailsShiftController', ['only'=> ['index']]);
Route::Resource('companies.productiondetailsconnec','CompanyProductionDetailsConnecController', ['only'=> ['index']]);
Route::Resource('companies.productiondetailsweek','CompanyProductionDetailsWeekController', ['only'=> ['index']]);

Route::Resource('companies.compareproviderweek','CompanyCompareProviderWeekController', ['only'=> ['index']]);
Route::Resource('companies.tasks','CompanyTaskController', ['only'=> ['index']]);

Route::Resource('companies.auditshifts','CompanyAuditShiftController', ['only'=> ['index']]);
Route::Resource('companies.rooms','CompanyRoomController', ['only'=> ['index','update','destroy']]);

Route::ApiResource('commissions','CommissionController');

Route::ApiResource('companies.users','CompanyUserController', ['only'=> ['index']]);
Route::ApiResource('companies.eventtypes','CompanyEventTypeController', ['only'=> ['index']]);
Route::ApiResource('companies.events','CompanyEventController', ['only'=> ['index','show']]);

Route::ApiResource('companies.accountrequests','CompanyAccountRequestController', ['only'=> ['index']]);

Route::Resource('companyunassignedrooms','CompanyunassignedRoomsController', ['only'=> ['index','update']]);

Route::ApiResource('companies.accountings','CompanyAccountingController', ['only'=> ['index']]);

Route::ApiResource('companies.items','CompanyItemController', ['only'=> ['index','destroy']]);

Route::ApiResource('companies.stores','CompanyStoreController', ['only'=> ['index','destroy']]);

Route::ApiResource('companies.inventories','CompanyInventoryController', ['only'=> ['index','destroy']]);


Route::ApiResource('companies.payrolls','CompanyPayrollController', ['only'=> ['index','destroy']]);


Route::ApiResource('companies.clienthaspayments','CompanyClientHasPaymentController', ['only'=> ['index']]);
Route::ApiResource('clienthaspayments','ClientHasPaymentController');


Route::ApiResource('companies.receiptpayments','CompanyReceiptPaymentController', ['only'=> ['index','update','destroy']]);

Route::ApiResource('companies.billtopays','CompanyBilltoPayController', ['only'=> ['index','update','destroy']]);

Route::ApiResource('companies.billtopays.study','CompanyBilltoPayStudyController', ['only'=> ['index','update','destroy']]);

Route::ApiResource('companies.billtocharges','CompanyBillToChargeController', ['only'=> ['index','store','update','destroy']]);

Route::ApiResource('companies.payorders','CompanyPayOrderController', ['only'=> ['index','update','destroy']]);


Route::ApiResource('companies.purchaseorders','CompanyPurchaseOrderController', ['only'=> ['index','update','destroy']]);

Route::ApiResource('companies.records','CompanyRecordController', ['only'=> ['index','update','destroy']]);

Route::ApiResource('companies.audiovisuals','CompanyAudiovisualController', ['only'=> ['index','update','destroy']]);

Route::ApiResource('companies.articles','CompanyArticleController', ['only'=> ['index','update','destroy']]);

Route::ApiResource('companies.audits','CompanyAuditController', ['only'=> ['index','update','destroy']]);

Route::ApiResource('companies.assistancecontrols','CompanyAssistanceController', ['only'=> ['index','update','destroy']]);


Route::ApiResource('companies.typemovementinventory','CompanyTypeMovementInventoryController', ['only'=> ['index']]);


/**
 * Production
 */
Route::ApiResource('productiondetailsconnec','ProductionDetailsConnecController');
Route::ApiResource('accountproductiondetails','AccountProductionDetailsController');

// Route::ApiResource('productiondetailsweek','ProductionDetailsWeekController');
Route::ApiResource('productiondetailsshift','ProductionDetailsShiftController');
Route::ApiResource('productiondetailsdays','ProductionDetailsDayController');
Route::ApiResource('productionmasters','ProductionMasterController');

Route::ApiResource('compareproviderweeks','CompareProviderWeekController');

/**
 * 
 * 
 */
Route::ApiResource('contacts','ContactController');

Route::ApiResource('courses','CourseController');
Route::ApiResource('jobfunctions','JobFunctionController');
Route::ApiResource('jobtypes','JobTypeController');

Route::ApiResource('epss','EpsController');
Route::ApiResource('events','EventController');
Route::get('showalert/{event}', 'EventController@showAlert');
Route::get('companyalert/{company}', 'CompanyEventController@companyAlert');


Route::ApiResource('inventories','InventoryController');
// Route::ApiResource('invoiceproviders','InvoiceProviderController');
Route::ApiResource('items','ItemController');
Route::ApiResource('lockers','LockerController');
Route::ApiResource('movementtypes','MovementTypeController');
Route::ApiResource('payrolls','PayrollController');
Route::ApiResource('projects','ProjectController');
Route::ApiResource('projecttasks','ProjectTaskController');
Route::ApiResource('receiptpayments','ReceiptPaymentController');
Route::ApiResource('records','RecordController');
Route::ApiResource('resources','ResourceController');
Route::ApiResource('rooms','RoomController');
Route::ApiResource('saleinvoices','SaleInvoiceController');
Route::ApiResource('shedules','SheduleController');
Route::ApiResource('shifts','ShiftController');
Route::ApiResource('shops','ShopController');
Route::ApiResource('sites','SiteController');
Route::ApiResource('stores','StoreController');
Route::ApiResource('subjects','SubjectController');
Route::ApiResource('tags','TagController');
Route::ApiResource('tasks','TaskController');
Route::ApiResource('trainings','TrainingController');

Route::ApiResource('typemovementinventories','TypeMovementInventoryController');
Route::ApiResource('companies.sales','CompanySalesController', ['only'=> ['index']]);


Route::ApiResource('eventTypes','EventTypeController');

Route::ApiResource('shifthasplanning','ShiftHasPlanningController');
Route::ApiResource('shifthasplanning.shifts','ShiftHasPlanningShiftController', ['only'=> ['index','show']]);
Route::ApiResource('companies.shifthasplanning','CompanyShiftHasPlanningController');

Route::get('cloneshifthasplanning/{shifthasplanning}','ShiftHasPlanningController@cloneShifthasplanning');


Route::ApiResource('shifthasplanning.monitorshifts','ShiftHasPlanningMonitorController', ['only'=> ['index']]);

Route::ApiResource('shifthasplanning.productionmaster','ShiftHasPlanningMasterController', ['only'=> ['index','show']]);


Route::ApiResource('accountrequests','AccountRequestController');


Route::ApiResource('taxes','TaxController');

Route::ApiResource('payorders','PayOrderController');


Route::ApiResource('purchaseorders','PurchaseOrderController');

Route::ApiResource('articles','ArticleController');

Route::ApiResource('bulkload','BulkLoadController');
Route::post('import-list-excel','BulkLoadController@importExcel')->name('models.import.excel');
Route::get('export-list-csv','BulkLoadController@exportExcel')->name('models.export.excel');
Route::get('export-list-pdf','BulkLoadController@exportPDF')->name('models.export.pdf');

Route::ApiResource('accountreceiptmodels','AccountReceiptModelController');

Route::ApiResource('comissionemployee','ComissionEmployeeController');
Route::ApiResource('companies.comissionemployee','CompanyComissionEmployeeController', ['only'=> ['index','show']]);

//image*********************************************************************************
Route::get('images',  [ // TODO: agregar paginacion a las imagenes de provider
    'uses' => 'ImageController@index',
    'as'   => 'images.index'
  ]);

  Route::ApiResource('images','ImageController');



 // Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');



/**
 * report
 */

Route::ApiResource('company.totalprovider','Report\CompanyTotalProviderController');

//1 
Route::ApiResource('companies.orderprovider','Report\CompanyOrderProviderController');

Route::get('companybestmodel/{company}', 'Report\CompanyOrderProviderController@bestModel');//
Route::get('companyproductionmodel/{company}', 'Report\CompanyOrderProviderController@productionModel');//

//5 falta las ganacias
Route::get('companyproductionstudio/{company}', 'Report\CompanyOrderProviderController@productionStudio');//g
Route::get('companyproductionsubstudio/{company}', 'Report\CompanyOrderProviderController@productionSubstudio');//g
Route::get('companyproductionsatelite/{company}', 'Report\CompanyOrderProviderController@productionSatelite');//g
Route::get('companyproductionsatelitepc/{company}', 'Report\CompanyOrderProviderController@productionSatelitePc');//g

//5 las ganacias

Route::get('gananciaestudio/{company}', 'Report\CompanyOrderProviderController@gananciaEstudio');//g
Route::get('gananciamodelos/{company}', 'Report\CompanyOrderProviderController@gananciaModelos');//g

// 6

Route::get('pagocomisionesmonitores/{company}', 'Report\CompanyOrderProviderController@pagoComisionesMonitores');//g
Route::get('pagocomisionesEstudio/{company}', 'Report\CompanyOrderProviderController@pagoComisionesEstudio');//g
Route::get('pagocomisionesmodelos/{company}', 'Report\CompanyOrderProviderController@pagoComisionesModelos');//g

// 7

Route::get('contratos1/{id}', 'Report\CompanyOrderProviderController@contratos1');
Route::get('contratos2/{id}', 'Report\CompanyOrderProviderController@contratos2');
Route::get('contratos3/{id}', 'Report\CompanyOrderProviderController@contratos3');
Route::get('contratos4/{id}', 'Report\CompanyOrderProviderController@contratos4');
Route::get('contratos5/{id}', 'Report\CompanyOrderProviderController@contratos5');
Route::get('contratos6/{id}', 'Report\CompanyOrderProviderController@contratos6');

Route::get('removablepayment/{company}', 'Report\CompanyOrderProviderController@removablepayment');//f

//8
Route::get('modelosmulta/{company}', 'Report\CompanyOrderProviderController@modelosMulta');//g

//9
Route::get('modelosmultasin/{company}', 'Report\CompanyOrderProviderController@modelosMultaSin');//

// Route::get('productionestudio/{productionmaster}', 'Report\CompanyOrderProviderController@productionEstudio');

// productionsatelite
// Route::post('usersStoreRole/{id}', 'UserController@storeRole')->name('usersStoreRole');


//11
Route::get('productividadmonitores/{company}', 'Report\CompanyOrderProviderController@productividadMonitores');//g

//12
Route::get('productionnuevas/{company}', 'Report\CompanyOrderProviderController@productionNuevas');//

//13
Route::get('turnodiario/{company}', 'Report\CompanyOrderProviderController@turnoDiario');//

//14
Route::get('mejormonitoresproduc/{company}', 'Report\CompanyOrderProviderController@mejorMonitoresProduc');//

//15
Route::get('modelosplantasatelites/{company}', 'Report\CompanyOrderProviderController@modelosPlantaSatelites');//

//16
Route::get('reportestockminimo/{company}', 'Report\CompanyOrderProviderController@reporteStockminimo');//

//18
Route::get('numeroempleados/{company}', 'Report\CompanyOrderProviderController@numeroEmpleados');//

//19
Route::get('monitorroom/{company}', 'Report\CompanyOrderProviderController@monitorRoom');//

//21
Route::get('modelosnuevas/{company}', 'Report\CompanyOrderProviderController@modelosNuevas');//

//22
Route::get('activaroninactivaron/{company}', 'Report\CompanyOrderProviderController@activaronInactivaron');//

//23
Route::get('agendaronaudiovisuales/{company}', 'Report\CompanyOrderProviderController@agendaronAudiovisuales');//

//24
Route::get('modelostarde/{company}', 'Report\CompanyOrderProviderController@modelosTarde');//

//25
Route::get('roomsemana/{company}', 'Report\CompanyOrderProviderController@roomSemana');//////

//26
Route::get('cuantoslockers/{company}', 'Report\CompanyOrderProviderController@cuantosLockers');//

//27
Route::get('reportedano/{company}', 'Report\CompanyOrderProviderController@reporteDano');//

//28
Route::get('reporteinventario/{company}', 'Report\CompanyOrderProviderController@reporteInventario');//

//29 premiosUser
Route::get('premiosuser/{company}', 'Report\CompanyOrderProviderController@premiosUser');//

//30
Route::get('modelospermisos/{company}', 'Report\CompanyOrderProviderController@modelosPermisos');//

//32
Route::get('reportetrm/{company}', 'Report\CompanyOrderProviderController@reporteTRM');//g

//33
Route::get('reporteaudiovisuales/{company}', 'Report\CompanyOrderProviderController@reporteAudiovisuales');//

//34
Route::get('reporteantiguedad/{company}', 'Report\CompanyOrderProviderController@reporteAntiguedad');



/**
 * comisiones y nomina
 */

// Route::get('paycommission/{id}', 'EventController@payCommission');//->name('usersStoreRole');
Route::post('closeplanning/{id}', 'EventController@closePlanning');
Route::post('commissioncalculation90/{id}', 'EventController@commissionCalculation90');
Route::post('commissioncalculation10/{id}', 'EventController@commissionCalculation10');
Route::post('commission15/{id}', 'EventController@commission15');
Route::get('payroll/{id}', 'PayrollController@payroll');



/**
 * cuenta por pagar y premio
 */

Route::post('awards/{id}', 'EventController@awards');
Route::post('earningsstudies/{id}', 'EventController@earningsStudies');
Route::post('earningsmodels/{id}', 'EventController@earningsModels');

// earningsStudies



//Notificaciones
// Route::get('notify/index', 'NotificationController@index');
Route::post('notify/message', 'NotificationController@message');
Route::post('notify/broadcastmessage', 'NotificationController@broadcastMessage');
Route::post('notify/accessingnotifications', 'NotificationController@accessingNotifications');
Route::post('notify/accessingnotificationsunread', 'NotificationController@accessingNotificationsUnread');
Route::post('notify/marknotificationsread', 'NotificationController@markNotificationsRead');
// Route::get('notify/broadcastnotifications', 'NotificationController@broadcastNotifications');
Route::post('notify/destroy', 'NotificationController@destroy');
Route::post('notify/show', 'NotificationController@show');


//Graph Dashboard Modelo
Route::get('sitemodels/{company}', 'GraphCompanyController@siteModels');
Route::get('sitemodelsmonth/{company}', 'GraphCompanyController@siteModelsMonth');
Route::get('countsitemodels/{company}', 'GraphCompanyController@countSiteModels');

//Graph Dashboard Monitor
Route::get('weekmonitor/{company}', 'GraphCompanyController@weekMonitor');
Route::get('commissionmonth/{company}', 'GraphCompanyController@commissionMonth');
Route::get('statusproduction/{company}', 'GraphCompanyController@statusProduction');

//Graph Dashboard 

Route::get('newmodelbiannual/{company}', 'GraphCompanyController@newModelBiannual');
Route::get('salesbiannual/{company}', 'GraphCompanyController@salesBiannual');
Route::get('productionbiannual/{company}', 'GraphCompanyController@productionBiannual');
Route::get('eventdetails/{company}', 'GraphCompanyController@eventDetails');
Route::get('productionmonth/{company}', 'GraphCompanyController@productionMonth');

Route::get('statusproductiondashboard/{company}', 'GraphCompanyController@statusProductionDashboard');


// contratos
Route::ApiResource('contracts','ContractController');
Route::post('contractupdateimage/{contract}', 'ContractController@updateImage');
Route::Resource('companies.contracts','CompanyContractController', ['only'=> ['index']]);


/**
 * Encuestas
 */
Route::ApiResource('polls','PollController');
Route::ApiResource('companies.polls','CompanyPollController', ['only'=> ['index']]);
