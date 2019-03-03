<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/
Route::get('/','masterApps\mobileController\MobileController@index');

// Route::get('/login-form','generalController\userAccessController@index')->name('user.masuk');
Route::post('/user/login','masterApps\generalController\userAccessController@loginUser');
Route::post('/user/signup','masterApps\generalController\userAccessController@signupUser');

//Route::resource('AdministratorAksi','Administrator\AdministratorController');

Route::get('/administrator','masterApps\generalController\Administrator\AdministratorController@index');
Route::get('/administrator/home','masterApps\generalController\Administrator\AdministratorController@index');
Route::get('/administrator/lpm','masterApps\generalController\Administrator\AdministratorController@lpmindex');
Route::get('/administrator/pmb','masterApps\generalController\Administrator\AdministratorController@pmb');

// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

// Route Mobile
Route::get('/login-form', 'masterApps\MobileController\MobileController@index');
Route::post('/login-form', 'masterApps\MobileController\MobileController@login');
Route::get('/register-form', 'masterApps\MobileController\MobileController@register');
Route::get('/admin/dashboard', 'masterApps\MobileController\MobileController@dashboard');

Route::middleware('ceklogin')->group(function (){
    Route::get('/home', 'masterApps\MobileController\superAdminController@index');
    Route::get('/master-apps/form-menu', 'masterApps\MobileController\superAdminController@menu'); 
    Route::get('/master-apps/form-user', 'masterApps\MobileController\superAdminController@user');
    Route::get('/master-apps/form-brand', 'masterApps\MobileController\superAdminController@brand');
    Route::get('/master-apps/form-roles', 'masterApps\MobileController\superAdminController@roles');
    Route::get('/master-apps/form-hak-akses', 'masterApps\MobileController\superAdminController@hakAkses');
    Route::get('/master-apps/form-pmb', 'masterApps\MobileController\superAdminController@pmb');
    Route::get('/master-apps/form-hak-akses/update/{id}/{isinya}/{apa}/{idUser}', 'masterApps\MobileController\superAdminController@updateHakAkses');
    Route::get('/master-apps/form-hak-akses/{id}', 'masterApps\MobileController\superAdminController@dataHakAkses');
    Route::get('/master-apps/form-menu/edit/{id}', 'masterApps\MobileController\superAdminController@editMenu');
    Route::get('/master-apps/form-menu/urutan/{id}', 'masterApps\MobileController\superAdminController@urutan');
    Route::get('/master-apps/form-user/verify/{id}', 'masterApps\MobileController\superAdminController@verify'); 
    Route::get('/master-apps/form-user/edit/{id}', 'masterApps\MobileController\superAdminController@edit') ;
    Route::get('/master-apps/form-roles/edit/{id}', 'masterApps\MobileController\superAdminController@editRoles');
    Route::post('/master-apps/form-user/update', 'masterApps\MobileController\superAdminController@update');
    Route::post('/master-apps/form-roles/save', 'masterApps\MobileController\superAdminController@save');
    Route::post('/master-apps/form-roles/update', 'masterApps\MobileController\superAdminController@updateRoles');
    Route::post('/master-apps/form-menu/data', 'masterApps\MobileController\superAdminController@dataMenu');
});


// Utility Online
Route::get('/utility-online', 'utilityOnline\mainController@index');
Route::get('/utility-online/water', 'utilityOnline\mainController@water');
Route::get('/utility-online/database', 'utilityOnline\mainController@database');