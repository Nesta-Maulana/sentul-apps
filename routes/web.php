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
Route::get('/','MobileController\MobileController@index');

// Route::get('/login-form','generalController\userAccessController@index')->name('user.masuk');
Route::post('/user/login','generalController\userAccessController@loginUser');
Route::post('/user/signup','generalController\userAccessController@signupUser');

//Route::resource('AdministratorAksi','Administrator\AdministratorController');

Route::get('/administrator','generalController\Administrator\AdministratorController@index');
Route::get('/administrator/home','generalController\Administrator\AdministratorController@index');
Route::get('/administrator/lpm','generalController\Administrator\AdministratorController@lpmindex');
Route::get('/administrator/pmb','generalController\Administrator\AdministratorController@pmb');

// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

// Route Mobile
Route::get('/login-form', 'MobileController\MobileController@index');
Route::post('/login-form', 'MobileController\MobileController@login');
Route::get('/register-form', 'MobileController\MobileController@register');
Route::get('/admin/dashboard', 'MobileController\MobileController@dashboard');

Route::middleware('ceklogin')->group(function (){
    Route::get('/super', 'MobileController\superAdminController@index');
    Route::get('/super/form-menu', 'MobileController\superAdminController@menu'); 
    Route::get('/super/form-user', 'MobileController\superAdminController@user'); 
    Route::get('/super/form-brand', 'MobileController\superAdminController@brand');
    Route::get('/super/form-roles', 'MobileController\superAdminController@roles');
    Route::get('/super/form-hak-akses', 'MobileController\superAdminController@hakAkses');
    Route::get('/super/form-pmb', 'MobileController\superAdminController@pmb');
});

Route::get('/super/form-hak-akses/update/{id}/{isinya}/{apa}/{idUser}', 'MobileController\superAdminController@updateHakAkses');
Route::get('/super/form-hak-akses/{id}', 'MobileController\superAdminController@dataHakAkses');
Route::get('/super/form-menu/edit/{id}', 'MobileController\superAdminController@editMenu');
Route::get('/super/form-menu/urutan/{id}', 'MobileController\superAdminController@urutan');
Route::get('/super/form-user/verify/{id}', 'MobileController\superAdminController@verify'); 
Route::get('/super/form-user/edit/{id}', 'MobileController\superAdminController@edit') ;
Route::get('/super/form-roles/edit/{id}', 'MobileController\superAdminController@editRoles');
Route::post('/super/form-user/update', 'MobileController\superAdminController@update');
Route::post('/super/form-roles/save', 'MobileController\superAdminController@save');
Route::post('/super/form-roles/update', 'MobileController\superAdminController@updateRoles');
Route::post('/super/form-menu/data', 'MobileController\superAdminController@dataMenu');