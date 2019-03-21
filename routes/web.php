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
Route::get('/master-apps', function(){
    return redirect('/master-apps/home');
});
Route::middleware('ceklogin')->group(function (){
    Route::get('/logout', 'masterApps\MobileController\MobileController@logout');
    Route::get('/home', 'masterApps\MobileController\superAdminController@index');
    Route::get('/master-apps/home', 'masterApps\MobileController\superAdminController@home');
    Route::get('/master-apps/form-menu', 'masterApps\MobileController\superAdminController@menu');
    Route::get('/master-apps/form-user', 'masterApps\MobileController\superAdminController@user');
    Route::get('/master-apps/form-brand', 'masterApps\MobileController\superAdminController@brand');
    Route::get('/master-apps/form-roles', 'masterApps\MobileController\superAdminController@roles');
    Route::get('/master-apps/form-hak-akses', 'masterApps\MobileController\superAdminController@hakAkses');
    Route::get('/master-apps/form-pmb', 'masterApps\MobileController\superAdminController@pmb');
    Route::get('/master-apps/form-hak-akses/update/{id}/{isinya}/{apa}/{idUser}', 'masterApps\MobileController\superAdminController@updateHakAkses');
    Route::get('/master-apps/form-hak-akses/{id}', 'masterApps\MobileController\superAdminController@dataHakAkses');
    Route::get('/master-apps/form-menu/edit/{id}/{aplikasi}', 'masterApps\MobileController\superAdminController@editMenu');
    Route::get('/master-apps/form-menu/urutan/{id}', 'masterApps\MobileController\superAdminController@urutan');
    Route::get('/master-apps/form-user/verify/{id}', 'masterApps\MobileController\superAdminController@verify'); 
    Route::get('/master-apps/form-user/edit/{id}', 'masterApps\MobileController\superAdminController@edit') ;
    Route::get('/master-apps/form-roles/edit/{id}', 'masterApps\MobileController\superAdminController@editRoles');
    Route::post('/master-apps/form-user/update', 'masterApps\MobileController\superAdminController@update');
    Route::post('/master-apps/form-roles/save', 'masterApps\MobileController\superAdminController@save');
    Route::post('/master-apps/form-roles/update', 'masterApps\MobileController\superAdminController@updateRoles');
    Route::post('/master-apps/form-menu/data', 'masterApps\MobileController\superAdminController@dataMenu');
    Route::get('/master-apps/form-menu/parent/{parent}', 'masterApps\MobileController\superAdminController@parent');
    Route::get('/master-apps/company', 'masterApps\mobileController\superAdminController@company');
    Route::get('/master-apps/company/edit/{id}', 'masterApps\mobileController\superAdminController@editCompany');
    Route::post('/master-apps/company/data', 'masterApps\mobileController\superAdminController@dataCompany');
    Route::get('/master-apps/kategori', 'masterApps\mobileController\superAdminController@kategori');
    Route::get('/master-apps/workcenter', 'masterApps\mobileController\superAdminController@workcenter');
    Route::post('/master-apps/workcenter/data', 'masterApps\mobileController\superAdminController@dataWorkcenter');
    Route::get('/master-apps/workcenter/edit/{id}', 'masterApps\mobileController\superAdminController@editWorkcenter');
    Route::get('/master-apps/bagian', 'masterApps\mobileController\superAdminController@bagian');
    Route::post('/master-apps/kategori/data', 'masterApps\mobileController\superAdminController@dataKategori');
    Route::get('/master-apps/kategori/edit/{id}', 'masterApps\mobileController\superAdminController@editKategori');
    Route::post('/master-apps/bagian/data', 'masterApps\mobileController\superAdminController@dataBagian');
    Route::get('/master-apps/bagian/edit/{id}', 'masterApps\mobileController\superAdminController@editBagian');
    Route::get('/master-apps/rasio', 'masterApps\mobileController\superAdminController@rasio');
    Route::get('/master-apps/rasio/workcenter/{id}', 'masterApps\mobileController\superAdminController@rasioWorkcenter');
    Route::get('/master-apps/rasio/bagian/{id}', 'masterApps\mobileController\superAdminController@rasioBagian');
    Route::post('/master-apps/rasio/rasio-head/save', 'masterApps\mobileController\superAdminController@rasioHeadSave');
    Route::post('/master-apps/rasio/save', 'masterApps\mobileController\superAdminController@rasioSave');
    Route::get('/master-apps/satuan', 'masterApps\mobileController\superAdminController@satuan');
    Route::get('/master-apps/satuan/edit/{id}', 'masterApps\mobileController\superAdminController@editSatuan');
    Route::post('/master-apps/satuan/data', 'masterApps\mobileController\superAdminController@dataSatuan');

    // Utility Online
    Route::get('/utility-online', 'utilityOnline\mainController@index');
    Route::get('/utility-online/water', 'utilityOnline\mainController@water');
    Route::post('/utility-online/water/simpan', 'utilityOnline\mainController@waterSimpan');
    Route::get('/utility-online/water/workcenter/{id}', 'utilityOnline\mainController@waterWorkcenter');

    Route::get('/utility-online/database', 'utilityOnline\mainController@database'); 
    Route::get('/utility-online/listrik', 'utilityOnline\mainController@listrik');
    Route::get('/utility-online/listrik/workcenter/{id}', 'utilityOnline\mainController@listrikWorkcenter');
    Route::post('/utility-online/listrik/simpan', 'utilityOnline\mainController@listrikSimpan');
    Route::get('/utility-online/database', 'utilityOnline\mainController@database');
    Route::get('/utility-online/database/workcenter/{id}', 'utilityOnline\mainController@databaseWorkcenter');
    Route::get('/utility-online/database/bagian/{id}/{tanggal}', 'utilityOnline\mainController@databaseBagian');
    Route::get('/utility-online/database/edit/{id}', 'utilityOnline\mainController@editDatabase');
    Route::post('/utility-online/database/update', 'utilityOnline\mainController@updateDatabase');
    Route::post('/utility-online/database/simpan', 'utilityOnline\mainController@simpanDatabase');
    Route::get('/utility-online/gas', 'utilityOnline\mainController@gas');
    Route::get('/utility-online/gas/workcenter/{id}', 'utilityOnline\mainController@gasWorkcenter');
    Route::post('/utility-online/gas/simpan', 'utilityOnline\mainController@gasSimpan');

    // Rollie
    Route::get('/rollie/cpp', 'rollie\rollieController@cpp');
    Route::get('/rollie/analisa-kimia-fg', 'rollie\rollieController@analisaKimia');
    Route::get('/rollie/analisa-kimia-fg/analisa', 'rollie\rollieController@analisaKimiaAnalisa');
    Route::get('/rollie/rkj', 'rollie\rollieController@rkj');
    Route::get('/rollie/rkj/input', 'rollie\rollieController@rkjInput');
});
