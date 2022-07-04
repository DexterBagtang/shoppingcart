<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers;
use App\trouble;


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

Route::resource('salesrequests','SalesrequestController');
Route::resource('projects','ProjectController');
Route::resource('components','ComponentController');
Route::resource('trouble','TroubleController');

Route::get('/', function () {
    return view('index');
});

//Auth::routes();


//start data center
Route::get('data_centerhq', 'DatacenterController@index');
Route::get('data_centerdr', 'DatacenterController@view_dr');
Route::get('data_centerhq_back', 'DatacenterController@view_hq_back');
Route::get('data_centerdr_back', 'DatacenterController@view_dr_back');
Route::get('create_equipment', 'DatacenterController@create_equipment');
Route::post('insert_equipment', 'DatacenterController@insert_equipment');
Route::get('data_center_details{id}', 'DatacenterController@data_center_details');
Route::get('view_equipment', 'DatacenterController@view_equipment');
Route::get('edit_equipment{id}', 'DatacenterController@edit_equipment');
Route::post('update_equipment{id}', 'DatacenterController@update_equipment');
Route::get('view_expiration', 'DatacenterController@view_expiration');



Route::get('create_rack', 'DatacenterController@create_rack');
Route::get('insert_rack', 'DatacenterController@insert_rack');
Route::get('viewrack{id}', 'DatacenterController@viewrack');
Route::get('editrack{id}', 'DatacenterController@editrack');
Route::get('tracker', 'DatacenterController@tracker');


Route::get('create_software', 'DatacenterController@create_software');
Route::post('insert_software', 'DatacenterController@insert_software');
Route::get('view_software', 'DatacenterController@view_software');
Route::get('edit_software{id}', 'DatacenterController@edit_software');
Route::post('update_softwaret{id}', 'DatacenterController@update_software');
Route::get('software_expiration', 'DatacenterController@software_expiration');
//end data center

//start borrowing_form_others
Route::get('borrowing_form_others', 'ComponentController@borrowing_form_others');
Route::post('insert_borrow_others', 'ComponentController@insert_borrow_others');
//end borrowing_form_others

//start component registration
Route::get('component', 'ComponentController@index');
Route::get('create_component', 'ComponentController@create');
Route::post('insert_component', 'ComponentController@insert_component');
Route::get('edit_component_details{id}', 'ComponentController@edit_component_details');
Route::get('update_component{id}', 'ComponentController@update_component');
//end component registration

//item_history
Route::get('item_history', 'ComponentController@item_history');
Route::get('item_history_user', 'ComponentController@item_history_user');

//upload Accountability start
Route::get('upload_accountability', 'ComponentController@upload_accountability');
Route::get('upload_accountability_details{id}', 'ComponentController@upload_accountability_details');
Route::post('upload_accountability_file', 'ComponentController@upload_accountability_file');
//upload Accountability end

//start os
Route::get('operatingsystem', 'OperatingsystemController@index');
Route::get('create_operatingsystem', 'OperatingsystemController@create');
Route::post('insert_operatingsystem', 'OperatingsystemController@insert_operatingsystem');
Route::get('edit_operatingsystem_details{id}', 'OperatingsystemController@edit_operatingsystem_details');
Route::get('update_operatingsystem{id}', 'OperatingsystemController@update_operatingsystem');
//end os

//start office
Route::get('office', 'OfficeinstalledController@index');
Route::get('create_office', 'OfficeinstalledController@create');
Route::post('insert_office', 'OfficeinstalledController@insert_office');
Route::get('edit_office_details{id}', 'OfficeinstalledController@edit_office_details');
Route::get('update_office{id}', 'OfficeinstalledController@update_office');
//end office

//start visio
Route::get('visio', 'VisioinstalledController@index');
Route::get('create_visio', 'VisioinstalledController@create');
Route::post('insert_visio', 'VisioinstalledController@insert_visio');
Route::get('edit_visio_details{id}', 'VisioinstalledController@edit_visio_details');
Route::get('update_visio{id}', 'VisioinstalledController@update_visio');
//end visio

//start borrowing_form_laptop
Route::get('borrowing_form_laptop', 'ComponentController@borrowing_form_laptop');
Route::get('insert_borrow_laptop', 'ComponentController@insert_borrow_laptop');
//end borrowing_form_laptop

//start assign workstation / Laptop
Route::get('borrowing_form_workstation', 'ComponentController@borrowing_form_workstation');
Route::post('insert_workstation', 'ComponentController@insert_workstation');

Route::get('borrowing_form_workstation_multi', 'ComponentController@borrowing_form_workstation_multi');
Route::post('insert_workstation_multi', 'ComponentController@insert_workstation_multi');
//end assign workstation / Laptop

//return start
Route::get('transaction_return', 'ComponentController@transaction_return');
Route::get('transaction_return_details{id}', 'ComponentController@transaction_return_details');
Route::get('return_item', 'ComponentController@return_item');
//return end

//view Item
Route::get('viewItems{id}', 'ComponentController@viewItems');
Route::get('viewlaptopDeparment{id}', 'ComponentController@viewlaptopDeparment');
Route::get('viewworkstationDeparment{id}', 'ComponentController@viewworkstationDeparment');
Route::get('viewemployeeDeparment{id}', 'ComponentController@viewemployeeDeparment');
//end item

//view username
Route::get('viewLogs{id}', 'ComponentController@viewLogs');
Route::get('addToCart{id}', 'ComponentController@addToCart');
Route::get('remove{id}', 'ComponentController@remove');
// view username

Route::get('viewDocs{id}', 'ComponentController@viewDocs');

Route::get('approved_header', 'SalesrequestController@approved_header');
Route::get('approve_detail{id}', 'SalesrequestController@approved_detail');
Route::get('approved_sr{id}', 'SalesrequestController@approved_sr');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('user_changePassword', 'HomeController@user_changePassword');

Route::get('/expirechangePassword','HomeController@showExpireChangePasswordForm');
Route::post('user_expirechangePassword', 'HomeController@user_expirechangePassword');

Route::get('/flowchart','HomeController@showFlowChart');

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
{
// Registration Routes...
    $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    $this->post('register', 'Auth\RegisterController@register');
    Route::get('users_edit_view{id}', 'Auth\RegisterController@users_edit_view');
    Route::post('users_update{id}', 'Auth\RegisterController@users_update');
    Route::get('/resetPassword','HomeController@showResetPasswordForm');
    Route::post('user_resetPassword', 'HomeController@user_resetPassword');
    Route::get('viewusers', 'Auth\RegisterController@viewusers');
    Route::get('viewinactiveusers', 'Auth\RegisterController@viewinactiveusers');
});











Route::get('tbs/create',[
    'uses' => 'App\Http\Controllers\TroubleController@create',
    'as' => 'create.trouble'
]);


Route::post('tbs/store',[
    'uses' => 'App\Http\Controllers\TroubleController@store',
    'as' => 'store.trouble'
]);

Route::get('/destroy{$id}','App\Http\Controllers\TroubleController@destroy');

//Route::get('tbs/destroy{$id}',[
//     'uses' => 'App\Http\Controllers\TroubleController@destroy',
//   'as' => 'destroy.trouble'
//]);

Route::get('tbs/edit',[
    'uses' => 'App\Http\Controllers\TroubleController@edit',
    'as' => 'edit.trouble'
]);

Route::get('tbs/details',[
    'uses' => 'App\Http\Controllers\TroubleController@details',
    'as' => 'details.trouble'
]);

Route::post('/update',[
    'uses' => 'App\Http\Controllers\TroubleController@update',
    'as' => 'update.trouble'
]);

//Route::get('/search/',[
//'uses' => 'App\Http\Controllers\TroubleController@search',
//'as'  => 'search.trouble'
//]);

Route::get('/search/', 'TroubleController@search')->name('search');
