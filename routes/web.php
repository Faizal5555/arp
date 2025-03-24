<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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


Route::get('/', function () {
        
        return redirect('/login');
    });

    Route::prefix('adminapp')->group(function () {
      Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('password.update');
      // Admin login
      Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
      //Route::post('/admin/login', [AuthenticatedSessionController::class, 'store'])->name('admin.login.store');
  
      // Global Manager login
      Route::get('/global-manager/login', [AuthenticatedSessionController::class, 'createGlobalManager'])->name('globalManager.login');
      Route::post('/global-manager/login', [AuthenticatedSessionController::class, 'storeGlobalManager']);
  
      // Employee login
      Route::get('/employee/login', [AuthenticatedSessionController::class, 'createEmployee'])->name('employee.login');
      Route::post('/employee/login', [AuthenticatedSessionController::class, 'storeEmployee']);
  
      Route::get('/supplier/login', [AuthenticatedSessionController::class, 'createSupplier'])->name('supplier.login');
      Route::post('/supplier/login', [AuthenticatedSessionController::class, 'storeSupplier'])->name('supplier.store');
  
      Route::get('/business-team-member/login', [AuthenticatedSessionController::class, 'createBusinessTeamMember'])->name('teamMember.login');
      Route::post('/business-team-member/login', [AuthenticatedSessionController::class, 'storeteamMember'])->name('teamMember.store');
      
      Route::get('/business-manager/login', [AuthenticatedSessionController::class, 'createBusinessManager'])->name('businessManager.login');
      Route::post('/business-manager/login', [AuthenticatedSessionController::class, 'storebusinessManager'])->name('businessManager.store');
      
      Route::get('/business-search/login', [AuthenticatedSessionController::class, 'createBusinessSearch'])->name('businessSearch.login');
      Route::post('/business-search/login', [AuthenticatedSessionController::class, 'storebusinessSearch'])->name('businessSearch.store');
      
      Route::get('/employee/forgot-password', [PasswordResetLinkController::class, 'employeeCreate'])->name('employee.password.request');
      Route::post('/check-email', 'App\Http\Controllers\dataCenterController@checkEmail')->name('checkEmail');
    });

    Route::match(['get', 'post'],'adminapp/data', 'App\Http\Controllers\dataCenterController@index')->name('adminapp.data');
    Route::get('adminapp/data/export', 'App\Http\Controllers\dataCenterController@exportHCPData')->name('adminapp.data.export');
    

    Route::group(['middleware'=> 'auth' , 'prefix' => 'adminapp' ],function(){
    Route::get('/dashboard','App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::get('/salesdashboard','App\Http\Controllers\DashboardController@sales')->name('salesdashboard');
    Route::post('DashBoard/chart','App\Http\Controllers\DashboardController@ChartjS')->name('DashBoardChart');
    Route::get('/operationDashboard','App\Http\Controllers\DashboardController@operationindex')->name('operationdashboard');
    Route::get('/fieldteamDashboard','App\Http\Controllers\DashboardController@fieldindex')->name('fieldteamDashboard');
    Route::get('/employee-list', 'App\Http\Controllers\DashboardController@employeeList')->name('employee.list');
    Route::get('/dashboard/view/{user_id?}/{type?}', 'App\Http\Controllers\DashboardController@viewDashboard')->name('dashboard.view');
    Route::get('/global-dashboard', 'App\Http\Controllers\DashboardController@globalDashboard')->name('global.dashboard');
    Route::get('/project-feasibility/create', 'App\Http\Controllers\ProjectFeasibilityController@create')->name('ProjectFeasibility');
    Route::post('/project-feasibility/store', 'App\Http\Controllers\ProjectFeasibilityController@store')->name('ProjectFeasibility.store');
    Route::get('/project-feasibility', 'App\Http\Controllers\ProjectFeasibilityController@index')->name('projectFeasibility.list');
    Route::get('/project-feasibility-data', 'App\Http\Controllers\ProjectFeasibilityController@ListData')->name('projectFeasibility.Data');
    Route::get('/project-feasibility/{id}/edit', 'App\Http\Controllers\ProjectFeasibilityController@edit');
    Route::put('/project-feasibility/{id}', 'App\Http\Controllers\ProjectFeasibilityController@update')->name('project-feasibility.update');
    Route::delete('/project-feasibility/{id}', 'App\Http\Controllers\ProjectFeasibilityController@destroy')->name('project-feasibility.destroy');
    Route::get('/project-feasibility/existing', 'App\Http\Controllers\ProjectFeasibilityController@existing')->name('project.existing');
    Route::put('/project-feasibility/{id}/change-status', 'App\Http\Controllers\ProjectFeasibilityController@changeStatus')->name('projectFeasibility.changeStatus');
    Route::get('/project-feasibility/closed', 'App\Http\Controllers\ProjectFeasibilityController@closedList')->name('projectFeasibility.closed');
   
   
    Route::get('/business-research/create', 'App\Http\Controllers\BusinessResearchController@create')->name('businessresearch.create');
    Route::post('/business-research/store', 'App\Http\Controllers\BusinessResearchController@store')->name('businessresearch.store'); 
    Route::get('/business-research/index', 'App\Http\Controllers\BusinessResearchController@index')->name('businessresearch.index');
    Route::get('/business-research/edit/{id}', 'App\Http\Controllers\BusinessResearchController@edit')->name('businessresearch.edit');
    Route::post('/business-research/update/{id}', 'App\Http\Controllers\BusinessResearchController@update')->name('businessresearch.update');
    Route::delete('/business-research/destory/{id}', 'App\Http\Controllers\BusinessResearchController@destroy')->name('businessresearch.destroy');
    Route::get('/business-allocated-projects', 'App\Http\Controllers\BusinessResearchController@getAllocatedProjects')->name('business.allocated.projects');
    Route::get('/business-research/show/{id}', 'App\Http\Controllers\BusinessResearchController@getProjects')->name('businessresearch.project');
    Route::get('/business-research/questions', 'App\Http\Controllers\BusinessResearchController@questions')->name('businessresearch.question');
    Route::post('/business-research/close/{id}', 'App\Http\Controllers\BusinessResearchController@closeProject')->name('businessresearch.close');
    Route::get('/business-research/closed',  'App\Http\Controllers\BusinessResearchController@closed')->name('businessresearch.closed');
    Route::get('/business-research/filter','App\Http\Controllers\BusinessResearchController@filter')->name('businessresearch.filter');


    Route::get('/business-team/view', 'App\Http\Controllers\BusinessResearchController@team')->name('businessresearch.team');
    Route::get('/business-team/show/{id}', 'App\Http\Controllers\BusinessResearchController@show')->name('businessresearch.show');                
    Route::post('/business-research/que/{id}',  'App\Http\Controllers\BusinessResearchController@storeQuestions')->name('business.research.save.que');
    Route::get('/secondary/search', 'App\Http\Controllers\BusinessResearchController@secondarySearch')->name('secondary.search');
    Route::get('/search/export', 'App\Http\Controllers\BusinessResearchController@exportSearchResults')->name('search.export');
    Route::get('/business-team/closed',  'App\Http\Controllers\BusinessResearchController@teamclosed')->name('business.team.closed');
    

    
    Route::post('/consumer-dashboard', 'App\Http\Controllers\DashboardController@consumerCountryfilter')->name('consumer.country');
    Route::post('hcp/country', 'App\Http\Controllers\DashboardController@hcpCountry')->name('hcp.country');
    
    
    Route::get('/sample-email-file', 'App\Http\Controllers\dataCenterController@generateEmailSampleFile')->name('sampleEmailFile');
    Route::get('/hcp-sample-download', 'App\Http\Controllers\dataCenterController@downloadHcpSampleFile')->name('hcp.sample.download');
    Route::get('/download-supplier-sample', 'App\Http\Controllers\SupplierController@generateSupplierSampleFile')->name('downloadSupplierSample');
   
    //users
    Route::get('/adminapp/usersview', 'App\Http\Controllers\OperationNewController@usersview')->name('usersview');
    Route::get('/user/delete/{id}', 'App\Http\Controllers\OperationNewController@usersdelete')->name('usersdelete');
    
    Route::post('delete/user','App\Http\Controllers\OperationNewController@delete_user')->name('delete_user');
    
    Route::get('/user/edit/{id}', 'App\Http\Controllers\OperationNewController@usersedit')->name('usersedit');
    Route::post('/user/update', 'App\Http\Controllers\OperationNewController@usersupdate')->name('usersupdate');
    
    // admin ratrange picker
    Route::post('Admin/Date_RangePicker', 'App\Http\Controllers\DashboardController@adminDate')->name('admin.daterangepicker');

//client 
Route::get('/client/index', 'App\Http\Controllers\ClientController@index')->name('client.index');
Route::get('/client/create', 'App\Http\Controllers\ClientController@create')->name('client.create');
Route::post('/client/store', 'App\Http\Controllers\ClientController@store')->name('client.store');
Route::get('/client/delete/{id}', 'App\Http\Controllers\ClientController@delete')->name('client.delete');
Route::get('/client/edit/{id}', 'App\Http\Controllers\ClientController@edit')->name('client.edit');
Route::post('/client/update', 'App\Http\Controllers\ClientController@update')->name('client.update');
Route::get('/client/export', 'App\Http\Controllers\ClientController@export')->name('client.export');
Route::get('/client/import', 'App\Http\Controllers\ClientController@importview');
Route::post('/client/import', 'App\Http\Controllers\ClientController@import')->name('client.import');
Route::get('/client/import1', 'App\Http\Controllers\ClientController@downloadclientSampleFile')->name('client.sample');

Route::get('/client/data', 'App\Http\Controllers\ClientController@clientdata')->name('client.data');
Route::get('/client/sample-download', 'App\Http\Controllers\ClientController@generateClientdataSampleFile')->name('clientdata.downloadSample');
Route::get('/clientdata/fetch', 'App\Http\Controllers\ClientController@fetchClientData')->name('clientdata.fetch');
Route::post('/clientdata/update', 'App\Http\Controllers\ClientController@updateClientDetails')->name('clientdata.update');
Route::post('/clientdata/import', 'App\Http\Controllers\ClientController@clientdataimport')->name('clientdata.import');
Route::get('/clientdata/details/{id}', 'App\Http\Controllers\ClientController@getClientDetails')->name('clientdata.details');
Route::get('/clientdata/filters', 'App\Http\Controllers\ClientController@clientdataindex')->name('clientdata.index');
Route::post('/clientdata/filter', 'App\Http\Controllers\ClientController@filterClientData')->name('clientdata.filter');

//vendor

Route::get('/vendor/index', 'App\Http\Controllers\VendorController@index')->name('vendor.index');
Route::get('/vendor/create', 'App\Http\Controllers\VendorController@create')->name('vendor.create');
Route::post('/vendor/store', 'App\Http\Controllers\VendorController@store')->name('vendor.store');
Route::get('/vendor/edit/{id}', 'App\Http\Controllers\VendorController@edit')->name('client.edit');
Route::get('/vendor/delete/{id}', 'App\Http\Controllers\VendorController@delete')->name('vendor.delete');
Route::post('/vendor/update', 'App\Http\Controllers\VendorController@update')->name('vendor.update');


Route::get('/vendor/export', 'App\Http\Controllers\VendorController@export')->name('vendor.export');
Route::get('/vendor/import', 'App\Http\Controllers\VendorController@importview');
Route::post('/vendor/import', 'App\Http\Controllers\VendorController@import')->name('vendor.import');

//bidrfq 
Route::get('/bidrfq/index', 'App\Http\Controllers\BidRfqController@index')->name('bidrfq.index');
Route::get('/bidrfq/viewwonproject', 'App\Http\Controllers\BidRfqController@viewwonproject')->name('bidrfq.viewwonproject');
Route::post('/bidrfq/viewwonproject1', 'App\Http\Controllers\BidRfqController@viewwonproject1')->name('bidrfq.viewwonproject1');
Route::post('/bidrfq/index1', 'App\Http\Controllers\BidRfqController@index1')->name('bidrfq.index1');
Route::get('/bidrfq/create', 'App\Http\Controllers\BidRfqController@create')->name('bidrfq.create');
Route::post('/bidrfq/store', 'App\Http\Controllers\BidRfqController@store')->name('bidrfq.store');
Route::get('/bidrfq/delete/{id}', 'App\Http\Controllers\BidRfqController@delete')->name('bidrfq.delete');
Route::get('/bidrfq/edit/{id}', 'App\Http\Controllers\BidRfqController@edit')->name('bidrfq.edit');
Route::get('/bidrfq/bidrfqfilter', 'App\Http\Controllers\BidRfqController@search')->name('bidrfq.search');
Route::post('/bidrfq/update', 'App\Http\Controllers\BidRfqController@update')->name('bidrfq.update');
Route::post('/bidrfq/wonupdate', 'App\Http\Controllers\BidRfqController@wonupdate')->name('bidrfq.wonupdate');
Route::post('/bidrfq/Followupdate', 'App\Http\Controllers\BidRfqController@Followupdate')->name('bidrfq.Followupdate');
Route::get('/bidrfq/followup', 'App\Http\Controllers\BidRfqController@getfollow')->name('bidrfq.followup');
Route::get('/bidrfq/lostprojectlist', 'App\Http\Controllers\BidRfqController@lostProject')->name('bidrfq.lostproject');
Route::get('lostproject/view/{id}', 'App\Http\Controllers\BidRfqController@lostProjectView');
Route::post('/bidrfq/nextFollowupdate', 'App\Http\Controllers\BidRfqController@nextFollowupdate')->name('bidrfq.nextFollowupdate');

// pdf download
Route::get('bidrfq/pdfview/{id}', 'App\Http\Controllers\BidRfqController@pdfview');
Route::get('bidrfq/downloadpdf/{id}', 'App\Http\Controllers\BidRfqController@downloadpdf');


//new Rfq 
Route::get('/newrfq/index', 'App\Http\Controllers\NewRfqController@index')->name('newrfq.index');
Route::post('/newrfq/store','App\Http\Controllers\NewRfqController@store')->name('newrfq.store');
//Route::get('/newrfq/view/{id}','App\Http\Controllers\NewRfqController@view')->name('newrfq.store');

//wonproject
Route::get('/wonproject/index', 'App\Http\Controllers\WonProjectController@index')->name('wonproject.index');
Route::get('/wonproject/create', 'App\Http\Controllers\WonProjectController@change')->name('wonproject.create');
Route::get('/wonproject/view', 'App\Http\Controllers\WonProjectController@view')->name('wonproject.view');
Route::get('/wonproject/bidrfq', 'App\Http\Controllers\WonProjectController@changebidrfq')->name('wonproject.bidrfq');
Route::get('/wonproject/createwon', 'App\Http\Controllers\WonProjectController@createwon')->name('wonproject.createwon');
Route::post('/wonproject/store', 'App\Http\Controllers\WonProjectController@store')->name('wonproject.store');
Route::get('/wonproject/edit/{id}', 'App\Http\Controllers\WonProjectController@edit')->name('wonproject.edit');
Route::get('/wonproject/delete/{id}', 'App\Http\Controllers\WonProjectController@delete')->name('wonproject.delete');
Route::post('/wonproject/update', 'App\Http\Controllers\WonProjectController@update')->name('wonproject.update');
Route::get('/wonproject/viewsalesfigures', 'App\Http\Controllers\WonProjectController@viewsalesfigures')->name('wonproject.viewsalesfigures');
Route::post('/wonproject/viewsalesfigures', 'App\Http\Controllers\WonProjectController@viewsalesfigures_filter')->name('wonproject.viewsalesfigures');
Route::post('/wonproject/viewsalesfigures_invoice', 'App\Http\Controllers\WonProjectController@viewsalesfigures_filter_invoice')->name('wonproject.viewsalesfigures_invoice');
Route::post('/wonproject/downdata','App\Http\Controllers\WonProjectController@downloadData')->name('wonproject.downloadData');
Route::get('/wonproject/projectstatus/{id}', 'App\Http\Controllers\WonProjectController@prostatus')->name('wonproject.prostatus');
Route::post('/wonproject/getstatus', 'App\Http\Controllers\WonProjectController@getstatus')->name('wonproject.getstatus');
Route::post('/wonproject/status', 'App\Http\Controllers\WonProjectController@status')->name('wonproject.status');
Route::get('/wonproject/completed', 'App\Http\Controllers\WonProjectController@completed')->name('wonproject.completed');
// overview
Route::get('/wonproject.Overview', 'App\Http\Controllers\WonProjectController@Overview')->name('wonproject.Overview');
Route::post('Overview_chart','App\Http\Controllers\OverviewController@Overview_chart')->name('Overview_chart');
//testing
Route::get('/test/index', 'App\Http\Controllers\TestController@index')->name('test.index');
Route::post('/test/index1', 'App\Http\Controllers\TestController@index1')->name('test.index1');
//projects Comments
Route::get('/projectComments/index', 'App\Http\Controllers\ProjectsCommentsController@index')->name('projectsComments.index');
Route::get('/projectComments/create', 'App\Http\Controllers\ProjectsCommentsController@create')->name('projectsComments.create');
Route::post('/projectComments/store', 'App\Http\Controllers\ProjectsCommentsController@store')->name('projectComments.store');
// sales perfomance
Route::get('/admin/performance', 'App\Http\Controllers\WonProjectController@getuser')->name('wonproject.perfomance');
Route::get('/admin/salesperformance', 'App\Http\Controllers\WonProjectController@salesperfomance')->name('wonproject.salesperfomance');


//Operation New Project
Route::get('operationNew/editoper','App\Http\Controllers\OperationNewController@editoper')->name('operationNew.editoper');
Route::get('/operationNew/index', 'App\Http\Controllers\OperationNewController@index')->name('operationNew.index');
Route::get('/operationNew/index/pm', 'App\Http\Controllers\OperationNewController@indexpm')->name('operationNew.indexpm');
Route::get('/operationNew/field', 'App\Http\Controllers\OperationNewController@field')->name('operationNew.field');
Route::get('/operationNew/createWon', 'App\Http\Controllers\OperationNewController@createWon')->name('operationNew.createWon');
Route::get('/operationNew/change', 'App\Http\Controllers\OperationNewController@change')->name('operationNew.change');
Route::post('/operationNew/storeWon', 'App\Http\Controllers\OperationNewController@storeWon')->name('operationNew.storeWon');
Route::get('/operationNew/create', 'App\Http\Controllers\OperationNewController@create')->name('operationNew.create');
Route::post('/operationNew/store', 'App\Http\Controllers\OperationNewController@store')->name('operationNew.store');
Route::get('operationNew/edit/{id}','App\Http\Controllers\OperationNewController@edit')->name('operationNew.edit');
Route::get('operationNew/editpm/{id}','App\Http\Controllers\OperationNewController@editpm')->name('operationNew.editpm');
Route::get('operationNew/close/edit/{id}','App\Http\Controllers\OperationNewController@closeedit')->name('operationNew.closeedit');
Route::post('operationNew/update','App\Http\Controllers\OperationNewController@update')->name('operationNew.update');
Route::post('operation/remove/image','App\Http\Controllers\OperationNewController@removeImage')->name('remove_Image');
Route::get('/operationNew/add_field_team', 'App\Http\Controllers\OperationNewController@add_field_team')->name('operationNew.add_field_team');
Route::post('/operationNew/addFieldTeam', 'App\Http\Controllers\OperationNewController@addFieldTeam')->name('operationNew.addFieldTeam');
Route::post('/operationNew/addproject', 'App\Http\Controllers\OperationNewController@addproject')->name('operationNew.addproject');
Route::post('/operationNew/add', 'App\Http\Controllers\OperationNewController@add')->name('operationNew.add');
Route::post('/operationNew/tladd', 'App\Http\Controllers\OperationNewController@tladd')->name('operationNew.tladd');
Route::post('/operationNew/pmadd', 'App\Http\Controllers\OperationNewController@pmadd')->name('operationNew.pmadd');
Route::post('/operationNew/qladd', 'App\Http\Controllers\OperationNewController@qladd')->name('operationNew.qladd');
Route::post('/operationNew/ohadd', 'App\Http\Controllers\OperationNewController@ohadd')->name('operationNew.ohadd');
Route::post('/operationNew/middle', 'App\Http\Controllers\OperationNewController@middle')->name('operationNew.middle');
Route::post('/operationNew/hold', 'App\Http\Controllers\OperationNewController@hold')->name('operationNew.hold');
Route::post('/operationNew/getclose', 'App\Http\Controllers\OperationNewController@getclose')->name('operationNew.getclose');
Route::get('/operationNew/indexclose', 'App\Http\Controllers\OperationNewController@indexclose')->name('operationNew.indexclose');
Route::get('/operationNew/fieldclose', 'App\Http\Controllers\OperationNewController@fieldclose')->name('operationNew.fieldclose');
Route::get('/operationNew/getclientadvance', 'App\Http\Controllers\OperationNewController@getclientadvance')->name('operationNew.getclientadvance');
Route::get('/operationNew/getclientbalance', 'App\Http\Controllers\OperationNewController@getclientbalance')->name('operationNew.getclientbalance');
Route::get('/operationNew/getvendoradvance', 'App\Http\Controllers\OperationNewController@getvendoradvance')->name('operationNew.getvendoradvance');
Route::get('/operationNew/operation', 'App\Http\Controllers\OperationNewController@operation')->name('operationNew.operation');
Route::post('/operationNew/figures', 'App\Http\Controllers\OperationNewController@figures')->name('operationNew.figures');
Route::post('/operationNew/overview/chart', 'App\Http\Controllers\OperationNewController@chart')->name('operation.overviewChart');
Route::post('/operationNew/overview/fieldchart', 'App\Http\Controllers\OperationNewController@fieldchart')->name('operation.fieldoverviewChart');
Route::post('/operationNew/clientrequest', 'App\Http\Controllers\OperationNewController@clientrequest')->name('operationNew.clientrequest');
Route::post('/operationNew/clientrequest1', 'App\Http\Controllers\OperationNewController@clientrequest1')->name('operationNew.clientrequest1');
Route::get('/operationNew/vendorrequestadvance', 'App\Http\Controllers\OperationNewController@vendorrequestadvance')->name('operationNew.vendorrequestadvance');
Route::post('/operationNew/vendorrequestbalance', 'App\Http\Controllers\OperationNewController@vendorrequestbalance')->name('operationNew.vendorrequestbalance');
Route::post('/operationNew/clientfinal', 'App\Http\Controllers\OperationNewController@clientfinal')->name('operationNew.clientfinal');
Route::post('/operationNew/vendorfinal', 'App\Http\Controllers\OperationNewController@vendorfinal')->name('operationNew.vendorfinal');
Route::get('/operationNew/projectview/{id}', 'App\Http\Controllers\OperationNewController@projectview')->name('operationNew.projectview');
Route::get('/operationNew/overview', 'App\Http\Controllers\OperationNewController@operationOverview')->name('operationNew.overview');
Route::post('/operationNew/status', 'App\Http\Controllers\OperationNewController@updateStatus')->name('operationNew.updateStatus');
Route::get('/operationNew/pm/overview', 'App\Http\Controllers\OperationNewController@operationPmOverview')->name('operationNewPM.overview');

// field perfomance
Route::get('/operationNew/fieldteam/performance', 'App\Http\Controllers\OperationNewController@fieldperfomance')->name('operationNew.fieldperfomance');
Route::get('/operationNew/fieldteam/getfieldperformance', 'App\Http\Controllers\OperationNewController@getfieldperfomance')->name('operationNew.getfieldperfomance');
Route::get('/operationNew/fieldperformancefilter', 'App\Http\Controllers\OperationNewController@fieldperformancefilter')->name('operationNew.fieldperformancefilter');
Route::get('/operationNew/closedperformancefilter', 'App\Http\Controllers\OperationNewController@closedperformancefilter')->name('operationNew.closedperformancefilter');
Route::get('operationNew/closeoperationperformance/edit/{id}','App\Http\Controllers\OperationNewController@commonoperationviewperformance')->name('operationNew.commonviewperformance');
// end field perfomance

// operation perfomance
Route::get('/operationNew/operation/operationperformance', 'App\Http\Controllers\OperationNewController@operationperfomance')->name('operationNew.operationperfomance');
Route::get('/operationNew/operation/getoperationperformance', 'App\Http\Controllers\OperationNewController@getoperationperfomance')->name('operationNew.getoperationperfomance');
Route::get('/operationNew/operationperformancefilter', 'App\Http\Controllers\OperationNewController@operationperformancefilter')->name('operationNew.operationperformancefilter');
Route::get('/operationNew/operationnewperformancefilter', 'App\Http\Controllers\OperationNewController@operationnewperformancefilter')->name('operationNew.operationnewperformancefilter');
Route::get('operationNew/closefieldperformance/edit/{id}','App\Http\Controllers\OperationNewController@commonviewperformance')->name('operationNew.commonviewperformance');
//end operation perfomance

Route::post('/operationNew/register', 'App\Http\Controllers\OperationNewController@register')->name('registerform');

// accounts
Route::get('/accounts/overview', 'App\Http\Controllers\AccountsController@overview')->name('accounts.overview');
Route::get('/accounts/clientrequestadvance', 'App\Http\Controllers\AccountsController@clientrequest')->name('accounts.clientrequestadvance');
Route::get('/accounts/clientrequestad1', 'App\Http\Controllers\AccountsController@clientrequest1')->name('accounts.clientrequestad1');
Route::get('/accounts/Vendorrequestadvance', 'App\Http\Controllers\AccountsController@Vendorrequestadvance')->name('accounts.Vendorrequestadvance');
Route::get('/accounts/Vendorrequestadvance1', 'App\Http\Controllers\AccountsController@Vendorrequestadvance1')->name('accounts.Vendorrequestadvance1');
Route::get('/accounts/payment', 'App\Http\Controllers\AccountsController@getpayment')->name('accounts.payment');
Route::get('/accounts/payment1', 'App\Http\Controllers\AccountsController@getpayment1')->name('accounts.payment1');
Route::post('/accounts/balancesent', 'App\Http\Controllers\AccountsController@balancesent')->name('accounts.balancesent');
Route::get('/accounts/view/{id}', 'App\Http\Controllers\AccountsController@vendorview')->name('accounts.view');
Route::get('/accounts/advanceview/{id}', 'App\Http\Controllers\AccountsController@vendoradvanceview')->name('accounts.view1');
Route::get('/accounts/pendingview/{id}', 'App\Http\Controllers\AccountsController@vendorpendingview')->name('accounts.pendingview');
Route::get('accounts/receivedview/{id}', 'App\Http\Controllers\AccountsController@receivedview')->name('accounts.receivedview');


Route::get('accounts/getreceivedview/{id}', 'App\Http\Controllers\AccountsController@getreceivedview')->name('accounts.getreceivedview');
Route::get('/accounts/clientpendingview/{id}', 'App\Http\Controllers\AccountsController@clientpendingview')->name('accounts.clientpendingview');
Route::post('/accounts/sent1', 'App\Http\Controllers\AccountsController@sent1')->name('accounts.sent');
Route::get('/accounts/clientview/{id}', 'App\Http\Controllers\AccountsController@clientview')->name('accounts.clientview');
Route::post('/accounts/clientsent', 'App\Http\Controllers\AccountsController@clientsent')->name('accounts.clientsent');
Route::post('/accounts/uploadinvoicestore', 'App\Http\Controllers\AccountsController@uploadinvoicestore')->name('accounts.uploadinvoicestore');
Route::post('/accounts/vendoruploadinvoicestore', 'App\Http\Controllers\AccountsController@vendoruploadinvoicestore')->name('accounts.vendoruploadinvoicestore');
Route::get('/accounts/clientview1/{id}', 'App\Http\Controllers\AccountsController@clientview1')->name('accounts.clientview1');
Route::post('/accounts/clientsent1', 'App\Http\Controllers\AccountsController@clientsent1')->name('accounts.clientsent1');
Route::get('/accounts/awitview/{id}', 'App\Http\Controllers\AccountsController@awitview')->name('accounts.awitview');
Route::post('/accounts/clientpaid', 'App\Http\Controllers\AccountsController@clientpaid')->name('accounts.clientpaid');
Route::post('/accounts/paidstore', 'App\Http\Controllers\AccountsController@paidstore')->name('accounts.paidstore');
Route::get('/accounts/paymentreceived', 'App\Http\Controllers\AccountsController@paymentreceived')->name('accounts.paymentreceived');
Route::get('/accounts/paymentreceived1', 'App\Http\Controllers\AccountsController@paymentreceived1')->name('accounts.paymentreceived1');
Route::get('/accounts/clientpending', 'App\Http\Controllers\AccountsController@clientpending')->name('accounts.clientpending');
Route::get('/accounts/clientpending1', 'App\Http\Controllers\AccountsController@clientpending1')->name('accounts.clientpending1');

Route::get('/accounts/payments', 'App\Http\Controllers\AccountsController@getvendorpayment')->name('accounts.vendorpayment');
Route::get('/accounts/awaitview/{id}', 'App\Http\Controllers\AccountsController@awaitview')->name('accounts.awaitview');
Route::post('/accounts/vendorpaid', 'App\Http\Controllers\AccountsController@vendorpaid')->name('accounts.vendorpaid');
Route::get('/accounts/vendor_received', 'App\Http\Controllers\AccountsController@vendorreceived')->name('accounts.vendorreceived');
Route::get('/accounts/vendor_received1', 'App\Http\Controllers\AccountsController@vendorreceived1')->name('accounts.vendorreceived1');
Route::get('/accounts/vendorpending', 'App\Http\Controllers\AccountsController@vendorpending')->name('accounts.vendorpending');

Route::post('/accounts/firc', 'App\Http\Controllers\AccountsController@getfircopy')->name('accounts.fircopy');
Route::post('/accounts/swift', 'App\Http\Controllers\AccountsController@getswift')->name('accounts.swift');
  // accounts dashboard
Route::get('/accountDashboard', 'App\Http\Controllers\DashboardController@accountoverview')->name('accounts.accountoverview');
Route::post('/accountsoverview','App\Http\Controllers\DashboardController@accountsoverview1')->name('accounts.overview1');
// accounts Perfomance
Route::get('/accountperformance', 'App\Http\Controllers\AccountsController@perfomance')->name('accounts.perfomance');
Route::get('/accountgetperformance', 'App\Http\Controllers\AccountsController@getperfomance')->name('accounts.getperfomance');
//send invoice email
Route::post('/accountsendinvoice', 'App\Http\Controllers\AccountsController@sendinvoice')->name('accounts.sendinvoice');




//supplier
Route::get('/Supplier/index', 'App\Http\Controllers\SupplierController@index')->name('Supplier.index');
Route::get('/Supplier/create', 'App\Http\Controllers\SupplierController@create')->name('Supplier.create');
Route::post('/Supplier/store', 'App\Http\Controllers\SupplierController@store')->name('Supplier.store');
Route::get('/Supplier/edit/{id}', 'App\Http\Controllers\SupplierController@edit')->name('Supplier.edit');
Route::post('/Supplier/update', 'App\Http\Controllers\SupplierController@update')->name('Supplier.update');
Route::get('/Supplier/delete/{id}', 'App\Http\Controllers\SupplierController@delete')->name('Supplier/delete');


Route::get('/Supplier/cost', 'App\Http\Controllers\SupplierController@cost')->name('SuperLiner.cost');
Route::get('/Supplier/costRequest', 'App\Http\Controllers\SupplierController@costRequest')->name('supplier.CostRequest');
Route::get('supplier/Country','App\Http\Controllers\SupplierController@suppliercountry')->name('supplierCountry');
Route::post('supplier/mail','App\Http\Controllers\SupplierController@supplierMail')->name('supplierMail');
Route::get('/Supplier/costRequestView', 'App\Http\Controllers\SupplierController@costRequestView')->name('supplier.costRequestView');
Route::get('/Supplier/costRequestView1', 'App\Http\Controllers\SupplierController@costRequestView1')->name('supplier.costRequestView1');

Route::get('/supplier/cost_request_view/{id}', 'App\Http\Controllers\SupplierController@cost_request_view')->name('supplier.RequestView');
Route::get('/supplier/view', 'App\Http\Controllers\SupplierController@supplier_view11')->name('supplier.view');
// Route::get('/supplier/view1', 'App\Http\Controllers\SupplierController@supplier_view1')->name('supplier.view1');

// supplier performance
Route::get('/supplier/performance', 'App\Http\Controllers\SupplierController@performance')->name('supplier.performance');
Route::get('/supplier/mail/count', 'App\Http\Controllers\SupplierController@supplierperfomance')->name('supplier.supplierperfomance');
Route::get('Supplier/perfomance/filter','App\Http\Controllers\SupplierController@supplierPerformanceFilter')->name('supplier.performance_filter');
Route::get('Supplier/perfomance/cost_filter','App\Http\Controllers\SupplierController@supplierPerformanceCostFilter')->name('supplier.performance_cost_filter');
Route::get('/supplier/supplier_performance_view/{id}', 'App\Http\Controllers\SupplierController@supplier_performance_view')->name('supplier.supplier_view');
//end supplier performance
Route::get('/Supplieroverview', 'App\Http\Controllers\SupplierController@suppplier_overview')->name('supplier.overview');
Route::post('/Supplieroverview1', 'App\Http\Controllers\SupplierController@suppplier_overview1')->name('supplier.overview1');
Route::post('/supplier/import', 'App\Http\Controllers\SupplierController@import')->name('supplier.import');
Route::get('/supplier-dashboard', 'App\Http\Controllers\SupplierController@supplier_dashboard')->name('supplier.dashboard');

//manager
Route::get('/manager/index', 'App\Http\Controllers\ManagerController@index')->name('manager.index');
Route::get('/manager/create', 'App\Http\Controllers\ManagerController@create')->name('manager.create');
Route::post('/manager/store', 'App\Http\Controllers\ManagerController@store')->name('manager.store');
Route::delete('/manager/delete', 'App\Http\Controllers\ManagerController@delete')->name('manager.delete');
Route::post('/manager/update', 'App\Http\Controllers\ManagerController@update')->name('manager.update');
Route::get('/Supplier/delete/{id}','App\Http\Controllers\SupplierController@delete')->name('Supplier/delete');
Route::get('/supplier/supplier_view/{id}', 'App\Http\Controllers\SupplierController@supplier_view')->name('supplier.supplier_view');



  // Data center

    Route::get('Data/center/{id}', 'App\Http\Controllers\dataCenterController@DataNew')->name('dataCenternew');
    Route::post('Data/Newform', 'App\Http\Controllers\dataCenterController@NewForm')->name('NewForm');
    
    // import
    Route::post('/datacenter/newregister/import', 'App\Http\Controllers\dataCenterController@import')->name('datacenter.import');

    Route::get('Data/invite', 'App\Http\Controllers\dataCenterController@invite')->name('invite');
    Route::post('Data/invite1', 'App\Http\Controllers\dataCenterController@invite1')->name('invite1');
    Route::post('/global-email', 'App\Http\Controllers\dataCenterController@globalEmail')->name('global.email');
    Route::get('/get-recruitment-data', 'App\Http\Controllers\dataCenterController@getRecruitmentData')->name('get.recruitment.data');
    Route::get('/get-recruitment', 'App\Http\Controllers\dataCenterController@getRecruitment')->name('get.recruitment');
    Route::get('/get-recruitment-list', 'App\Http\Controllers\dataCenterController@getRecruitmentList')->name('get.recruitment.list');
    Route::get('/export-recruitment', 'App\Http\Controllers\dataCenterController@exportRecruitmentData')->name('export.recruitment');
    
    Route::get('/get-global-managers', 'App\Http\Controllers\dataCenterController@getGlobalManagers')->name('get.global.managers');
    Route::get('Data/popinvite', 'App\Http\Controllers\dataCenterController@popinvite')->name('popinvite');
    Route::post('Data/popinvite1', 'App\Http\Controllers\dataCenterController@popinvite1')->name('popinvite1');
    Route::get('Data/panelist', 'App\Http\Controllers\dataCenterController@panelist')->name('panelist');
    Route::get('/filter-doctors', 'App\Http\Controllers\dataCenterController@filterDoctors')->name('filterDoctors');
    Route::post('/send-email-panelists', 'App\Http\Controllers\dataCenterController@sendEmailToPanelists')->name('sendEmailToPanelists');
    // Route::get('mail', 'App\Http\Controllers\dataCenterController@mailexample')->name('mailexample');

    Route::get('website/user/actived/link','App\Http\Controllers\dataCenterController@userReturnview');
    
    Route::get('click/to/website','App\Http\Controllers\dataCenterController@userview');
    Route::get('docter/edit','App\Http\Controllers\dataCenterController@docterEdit');
    Route::get('docter/fech','App\Http\Controllers\dataCenterController@docterfech')->name('docter.fech');
    // Route::get('/user/dashboard','App\Http\Controllers\dataCenterController@userDashboard');
    Route::post('edit/data','App\Http\Controllers\dataCenterController@editdata')->name('editdata');

   //  datacenter admin view
    Route::get('adminactived/view','App\Http\Controllers\dataCenterController@adminDatatable')->name('adminactivedview');
    Route::get('adminactived/filter','App\Http\Controllers\dataCenterController@adminDatatable1')->name('adminactivedview1');
    Route::get('perfomancefilter','App\Http\Controllers\dataCenterController@perfomancefilter')->name('performancefilter');
    Route::get('admin/Money/Send','App\Http\Controllers\dataCenterController@MoneySend')->name('Money.send');
    Route::get('admin/Money/filter','App\Http\Controllers\dataCenterController@MoneySend1')->name('Money.send1');
    
    Route::get('admin/Money/bulk/Send','App\Http\Controllers\dataCenterController@MoneyPulk')->name('Money.bulksend');
    
    Route::post('admin/Money/Pulk/Sending','App\Http\Controllers\dataCenterController@bulkMoneySend')->name('bulk.moneySend');
    
    Route::get('send/amount/{id}','App\Http\Controllers\dataCenterController@sendmoney')->name('sendmoney');
   
   Route::post('Admin/Money/Send','App\Http\Controllers\dataCenterController@AdminMoneySend')->name('Admin.MoneySend');
   Route::post('Admin/Voucher/Send','App\Http\Controllers\dataCenterController@AdminVoucherSend')->name('Admin.VoucherSend');
   Route::get('account/Register/List','App\Http\Controllers\dataCenterController@accountRegisterListshow')->name('accountRegisterList');
   //sendmoney  meethod
   Route::post('sendmoney/admin','App\Http\Controllers\dataCenterController@sendmoneyadmin')->name('sendmoneyadmin');
   Route::get('receive/money','App\Http\Controllers\dataCenterController@receiveMoney')->name('receive.money');
   Route::get('receive/money1','App\Http\Controllers\dataCenterController@receiveMoney1')->name('receive.money1');
   Route::get('reedem/Accept','App\Http\Controllers\dataCenterController@reddemAcept')->name('reddemAcept');
   Route::get('reedem/reddemAccept','App\Http\Controllers\dataCenterController@reddemAccept1')->name('reddemAccept1');
   Route::post('paid/upsection','App\Http\Controllers\dataCenterController@paid')->name('paid_upsection');
   
   
  
    //  doctor Export
   Route::get('doctor/export', 'App\Http\Controllers\dataCenterController@DoctorExport')->name('doctor.export');
   
    //doctor
   Route::get('documents', 'App\Http\Controllers\docterController@documents_view')->name('doctor.documents');
   Route::post('document_store', 'App\Http\Controllers\docterController@document_store')->name('doctor.document_store');
   Route::get('/doctor/index', 'App\Http\Controllers\docterController@document_index')->name('doctor.document_index');
   Route::get('/doctorlist', 'App\Http\Controllers\dataCenterController@doctorlist')->name('doctorlist');
   Route::get('doctor/list_filder', 'App\Http\Controllers\dataCenterController@doctorfilder')->name('doctor.list_filder');
   Route::get('/doctor_list/{id}', 'App\Http\Controllers\docterController@doctor_list_doc')->name('doctor_list_doc');
   Route::post('doctor/document/list', 'App\Http\Controllers\docterController@doctor_document_list')->name('doctor_document_list');
   Route::get('/doctor','App\Http\Controllers\docterController@getdoctor')->name('doctor.profile');
   Route::post('redeem/Value','App\Http\Controllers\dataCenterController@redeemValue')->name('redeemValue');
   Route::post('noredeem/Value','App\Http\Controllers\dataCenterController@noredeemValue')->name('noredeemValue');
   Route::get('receive/voucher','App\Http\Controllers\dataCenterController@receivevoucher')->name('receive.voucher');
   Route::get('receive/voucher1','App\Http\Controllers\dataCenterController@receivevoucher1')->name('receive.voucher1');
   
   
   //  DATCENTER PERFORMANCE
   Route::get('datacenter.performance','App\Http\Controllers\dataCenterController@datcenter_performace')->name('datacenter.performance');
   Route::get('datacenter/view/doctor/{id}','App\Http\Controllers\dataCenterController@performance_view_doctor')->name('performance_view_doctor');
    
   Route::get('/supplier/by/doctor', 'App\Http\Controllers\dataCenterController@datacenterTotalDoctor')->name('datacenter.bydoctor');
   Route::get('account/registration','App\Http\Controllers\dataCenterController@accountRegistration')->name('account.registration');
   Route::post('account/registerForm','App\Http\Controllers\dataCenterController@accountRegisterForm')->name('account.registerForm');
   Route::get('account/datafillter','App\Http\Controllers\dataCenterController@fillter')->name('account.datafillter');
   Route::get('account/sending','App\Http\Controllers\dataCenterController@sending')->name('account.sending');
   Route::get('account/content','App\Http\Controllers\dataCenterController@getcontent')->name('account.content');
   Route::get('Data/center/fillter', 'App\Http\Controllers\dataCenterController@docterfillter')->name('fillter');
   Route::post('account/doctorMail','App\Http\Controllers\dataCenterController@doctorMail')->name('doctorMail');
   Route::post('Data/center/notifymoney', 'App\Http\Controllers\dataCenterController@notifymoney')->name('notifymoney');
   Route::post('Data/center/notifyvocher', 'App\Http\Controllers\dataCenterController@notifyvocher')->name('notifyvocher');
   Route::post('Data/center/adminconcept', 'App\Http\Controllers\dataCenterController@adminconcept')->name('adminconcept');
   Route::post('Data/center/adminreg1', 'App\Http\Controllers\dataCenterController@adminreg1')->name('adminreg1');
   Route::get('admin/datacenter/overview','App\Http\Controllers\dataCenterController@adminoverview')->name('admincenterverview');
   Route::get('admin/datacenter/adminfillter','App\Http\Controllers\dataCenterController@adminfillter')->name('adminfillter');
   Route::get('admin/datacenter/userCountryFilter','App\Http\Controllers\dataCenterController@userCountryFilter')->name('userCountryFilter');
   Route::get('/hcp-panel/invite', 'App\Http\Controllers\dataCenterController@hcpPanelInvite')->name('hcpPanelInvite');
   Route::get('/hcp-panel/invite-data', 'App\Http\Controllers\dataCenterController@hcpPanelInviteData')->name('hcpPanelInviteData');
   Route::get('/consumer-registration', 'App\Http\Controllers\dataCenterController@consumerRegistration')->name('consumerRegistration');
   Route::get('/consumer-registration-data', 'App\Http\Controllers\dataCenterController@consumerRegistrationData')->name('consumerRegistrationData');
   Route::get('/hcp/edit/{id}', 'App\Http\Controllers\dataCenterController@editHcp')->name('hcp.edit');
   Route::post('/hcp/update/{id}', 'App\Http\Controllers\dataCenterController@updateHcp')->name('hcp.update');
   Route::delete('/hcp/delete/{id}', 'App\Http\Controllers\dataCenterController@deleteHcp')->name('hcp.delete');
   Route::get('/consumer/edit/{id}', 'App\Http\Controllers\dataCenterController@editConsumer')->name('consumer.edit');
   Route::post('/consumer/update/{id}', 'App\Http\Controllers\dataCenterController@updateConsumer')->name('consumer.update');
   Route::delete('/consumer/delete/{id}', 'App\Http\Controllers\dataCenterController@deleteConsumer')->name('consumer.delete');
   Route::get('/email-panel', 'App\Http\Controllers\dataCenterController@consumerEmail')->name('emailPanel');
   Route::get('/filter-users', 'App\Http\Controllers\dataCenterController@filterUsers')->name('filterUsers');
   Route::post('/send-email', 'App\Http\Controllers\dataCenterController@sendEmailToUsers')->name('sendEmailToUsers');
   Route::get('/user-hcp-list', 'App\Http\Controllers\dataCenterController@userHcpList')->name('userHcpList');
   Route::get('/user-hcp-list-data', 'App\Http\Controllers\dataCenterController@userHcpListData')->name('userHcpListData');
   Route::get('/user-consumer-list', 'App\Http\Controllers\dataCenterController@userconsumerlist')->name('user.consumer.list');
   Route::get('/user-consumer-list-data', 'App\Http\Controllers\dataCenterController@userconsumerlistData')->name('user.consumer.list.data');
   Route::get('hcp-pie-chart', 'App\Http\Controllers\dataCenterController@hcpPieChart')->name('hcp.pieChart');
   Route::get('hcp-country-data', 'App\Http\Controllers\dataCenterController@hcpCountryFilter')->name('hcp.countryData');
   Route::get('/global-registration', 'App\Http\Controllers\dataCenterController@globalManagerList')->name('globalManagerList');
   Route::get('/global-manager/data', 'App\Http\Controllers\dataCenterController@globalManagerListData')->name('globalManagerListData');
   Route::get('/panel-member', 'App\Http\Controllers\dataCenterController@panelmemberList')->name('panelMemberList');
   Route::get('/panel-member/data', 'App\Http\Controllers\dataCenterController@panelmemberListData')->name('panelMemberListData');
   Route::post('/save-incentive', 'App\Http\Controllers\dataCenterController@saveIncentive')->name('saveIncentive');
   Route::get('/fetchIncentive/{datacenterId}', 'App\Http\Controllers\dataCenterController@fetchIncentive')->name('fetchIncentive');
   Route::get('/fetchIncentiveConsumer/{queId}', 'App\Http\Controllers\dataCenterController@fetchIncentiveConsumer')->name('fetchIncentiveConsumer');
   Route::get('/payment-view', 'App\Http\Controllers\dataCenterController@PaymentsView')->name('PaymentsView');
   Route::get('/fetchPayments', 'App\Http\Controllers\dataCenterController@fetchPayments')->name('fetchPayments');
   
  
   //user module route 
   Route::get('view/profile','App\Http\Controllers\dataCenterController@viewProfile')->name('user.profile');
  // view Question And Answer
   Route::get('ques_ans/overview', 'App\Http\Controllers\dataCenterController@viewQus')->name('viewQus');
   Route::get('ques_ans/overview/search', 'App\Http\Controllers\dataCenterController@viewQue_search')->name('viewQue_search');
   Route::get('ques_ans/pdf/download/{id}', 'App\Http\Controllers\dataCenterController@answer_key_download')->name('answer_key_download');
   Route::get('/ques_ans/pdf/download/pdf/{id}', 'App\Http\Controllers\dataCenterController@answer_key_download_pdf');

});
 Route::group(['prefix' => 'adminapp'], function () {
     
         
 Route::get('/user/activation/{id}','App\Http\Controllers\dataCenterController@useractived');
 Route::get('/user/activation_user/{id}','App\Http\Controllers\dataCenterController@user_actived1');

 Route::get('/newdoctorregister/{id?}','App\Http\Controllers\dataCenterController@OutsideDataNew');
 Route::post('Data/outsideNewform', 'App\Http\Controllers\dataCenterController@NewForm')->name('outsideNewForm');
 Route::get('/b2cregistration/{id?}', 'App\Http\Controllers\dataCenterController@language')->name('consumerform');
 //Route::get('/b2cregisration', 'App\Http\Controllers\dataCenterController@languages')->name('consumerform');
 Route::get('lang/change', 'App\Http\Controllers\dataCenterController@change')->name('changeLang');
 Route::post('new/register', 'App\Http\Controllers\dataCenterController@new_register')->name('new_register');
 Route::post('/datacenter/import-doctors', 'App\Http\Controllers\dataCenterController@importDoctors')->name('datacenter.importDoctors');
 // Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


});
require __DIR__.'/auth.php';