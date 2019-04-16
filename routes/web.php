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

// Route::get('/login-form','generalController\userAccessController@index')->name('user.masuk');
Route::post('/user/login','masterApps\generalController\userAccessController@loginUser');
Route::post('/user/signup','masterApps\generalController\userAccessController@signupUser');

//Route::resource('AdministratorAksi','Administrator\AdministratorController');

Route::get('/administrator','masterApps\generalController\Administrator\AdministratorController@index');
Route::get('/administrator/home','masterApps\generalController\Administrator\AdministratorController@index');
Route::get('/administrator/lpm','masterApps\generalController\Administrator\AdministratorController@lpmindex');
Route::get('/administrator/pmb','masterApps\generalController\Administrator\AdministratorController@pmb');

// Auth::routes();
/* Login */
Route::get('/','userAccess\userAccessController@index')->name('halaman-login');
Route::get('/login-form', 'userAccess\userAccessController@index')->name('halaman-login');
Route::get('/register-form', 'userAccess\userAccessController@register')->name('halaman-daftar');
Route::post('/login-form', 'userAccess\userAccessController@login')->name('user-login');
Route::get('/admin/dashboard', 'userAccess\userAccessController@dashboard');
Route::get('/logout', 'userAccess\userAccessController@logout');


Route::middleware('ceklogin')->group(function ()
{

    Route::get('/home', 'masterApps\superAdminController@index');    
    Route::get('/master-apps', 'masterApps\superAdminController@home');
    Route::get('/master-apps/home', 'masterApps\superAdminController@home');
    
    Route::get('/master-apps/form-menu', 'masterApps\superAdminController@menu');
    Route::get('/master-apps/form-menu/edit/{id}/{aplikasi}', 'masterApps\superAdminController@editMenu');
    Route::get('/master-apps/form-menu/urutan/{id}', 'masterApps\superAdminController@urutan');
    Route::post('/master-apps/form-menu/data', 'masterApps\superAdminController@dataMenu');
    Route::get('/master-apps/form-menu/parent/{parent}', 'masterApps\superAdminController@parent');
    
    Route::get('/master-apps/form-user', 'masterApps\superAdminController@user');
    Route::get('/master-apps/form-user/verify/{id}', 'masterApps\superAdminController@verify'); 
    Route::get('/master-apps/form-user/edit/{id}', 'masterApps\superAdminController@edit') ;
    Route::post('/master-apps/form-user/update', 'masterApps\superAdminController@update');
    
    Route::get('/master-apps/form-brand', 'masterApps\superAdminController@brand');
    
    Route::get('/master-apps/form-roles', 'masterApps\superAdminController@roles');
    Route::get('/master-apps/form-roles/edit/{id}', 'masterApps\superAdminController@editRoles');
    Route::post('/master-apps/form-roles/save', 'masterApps\superAdminController@save');
    Route::post('/master-apps/form-roles/update', 'masterApps\superAdminController@updateRoles');
    
    Route::get('/master-apps/form-hak-akses', 'masterApps\superAdminController@hakAkses');
    Route::get('/master-apps/form-hak-akses/update/{id}/{isinya}/{apa}/{idUser}', 'masterApps\superAdminController@updateHakAkses');
    Route::get('/master-apps/form-hak-akses/{id}', 'masterApps\superAdminController@dataHakAkses');
    
    Route::get('/master-apps/form-pmb', 'masterApps\superAdminController@pmb');
    
    Route::get('/master-apps/rasio', 'masterApps\superAdminController@rasio');
    Route::get('/master-apps/rasio/workcenter/{id}', 'masterApps\superAdminController@rasioWorkcenter');
    Route::get('/master-apps/rasio/bagian/{id}', 'masterApps\superAdminController@rasioBagian');
    Route::post('/master-apps/rasio/rasio-head/save', 'masterApps\superAdminController@rasioHeadSave');
    Route::post('/master-apps/rasio/save', 'masterApps\superAdminController@rasioSave');
    
    Route::get('/master-apps/satuan', 'masterApps\superAdminController@satuan');
    Route::get('/master-apps/satuan/edit/{id}', 'masterApps\superAdminController@editSatuan');
    Route::post('/master-apps/satuan/data', 'masterApps\superAdminController@dataSatuan');
 
    Route::get('/master-apps/kategori', 'masterApps\superAdminController@kategori');
    Route::post('/master-apps/kategori/data', 'masterApps\superAdminController@dataKategori');
    Route::get('/master-apps/kategori/edit/{id}', 'masterApps\superAdminController@editKategori');
    
    Route::get('/master-apps/company', 'masterApps\superAdminController@company');
    Route::get('/master-apps/company/edit/{id}', 'masterApps\superAdminController@editCompany');
    Route::post('/master-apps/company/data', 'masterApps\superAdminController@dataCompany');
    
    Route::get('/master-apps/workcenter', 'masterApps\superAdminController@workcenter');
    Route::post('/master-apps/workcenter/data', 'masterApps\superAdminController@dataWorkcenter');
    Route::get('/master-apps/workcenter/edit/{id}', 'masterApps\superAdminController@editWorkcenter');
    
    Route::get('/master-apps/bagian', 'masterApps\superAdminController@bagian');
    Route::post('/master-apps/bagian/data', 'masterApps\superAdminController@dataBagian');
    Route::get('/master-apps/bagian/edit/{id}', 'masterApps\superAdminController@editBagian');

    Route::get('/master-apps/brand', 'masterApps\superAdminController@brand');
    Route::post('/master-apps/bagian/data', 'masterApps\superAdminController@dataBrand')->name('brand-data');
    Route::get('/master-apps/bagian/edit/{id}', 'masterApps\superAdminController@editBagian');

    Route::get('/master-apps/brand', 'masterApps\superAdminController@brand');
    Route::post('/master-apps/brand/data', 'masterApps\superAdminController@dataBrand');
    Route::get('/master-apps/brand/edit/{id}', 'masterApps\superAdminController@editBrand');
    
    Route::get('/master-apps/plan', 'masterApps\superAdminController@plan');
    Route::post('/master-apps/plan/data', 'masterApps\superAdminController@dataPlan')->name('plan-data');
    Route::get('/master-apps/plan/edit/{id}', 'masterApps\superAdminController@editPlan');

    Route::get('/master-apps/produk', 'masterApps\superAdminController@produk');
    Route::post('/master-apps/produk/data', 'masterApps\superAdminController@dataProduk')->name('produk-data');
    Route::get('/master-apps/produk/edit/{id}', 'masterApps\superAdminController@editProduk');

    Route::get('/master-apps/jenis-produk', 'masterApps\superAdminController@jenisProduk');
    Route::post('/master-apps/jenis-produk/data', 'masterApps\superAdminController@dataJenisProduk')->name('jenis-produk-data');
    Route::get('/master-apps/jenis-produk/edit/{id}', 'masterApps\superAdminController@editJenisProduk');

    Route::get('/master-apps/mesin-filling', 'masterApps\superAdminController@mesinFilling');
    Route::post('/master-apps/mesin-filling/data', 'masterApps\superAdminController@dataMesinFilling')->name('mesin-filling-data');
    Route::get('/master-apps/mesin-filling/edit/{id}', 'masterApps\superAdminController@editMesinFilling');

    Route::get('/master-apps/mesin-filling-head-detail', 'masterApps\superAdminController@mesinFillingHeadDetail');
    Route::post('/master-apps/mesin-filling-head/save', 'masterApps\superAdminController@mesinFillingHeadSave');
    Route::get('/master-apps/mesin-filling-head-detail/edit/{id}', 'masterApps\superAdminController@editMesinFillingHeadDetail');

    // Utility Online
    Route::get('/utility-online', 'utilityOnline\mainUtilityController@index');
    Route::get('/utility-online/water', 'utilityOnline\mainUtilityController@water');
    Route::post('/utility-online/water/simpan', 'utilityOnline\mainUtilityController@bagianSimpan');
    Route::get('/utility-online/water/workcenter/{id}', 'utilityOnline\mainUtilityController@showInput');
    Route::get('/utility-online/water/{id}', 'utilityOnline\mainUtilityController@waterId');
    
    Route::get('/utility-online/database', 'utilityOnline\mainUtilityController@database'); 
    Route::get('/utility-online/database', 'utilityOnline\mainUtilityController@database');
    Route::get('/utility-online/database/workcenter/{id}', 'utilityOnline\mainUtilityController@databaseWorkcenter');
    Route::get('/utility-online/database/bagian/{id}/{tanggal}', 'utilityOnline\mainUtilityController@databaseBagian');
    Route::get('/utility-online/database/edit/{id}/{tgl}', 'utilityOnline\mainUtilityController@editDatabase');
    Route::post('/utility-online/database/update', 'utilityOnline\mainUtilityController@updateDatabase');
    Route::post('/utility-online/database/simpan', 'utilityOnline\mainUtilityController@simpanDatabase');
    
    Route::get('/utility-online/listrik', 'utilityOnline\mainUtilityController@listrik');
    Route::get('/utility-online/listrik/{id}', 'utilityOnline\mainUtilityController@listrikId');
    Route::get('/utility-online/listrik/workcenter/{id}', 'utilityOnline\mainUtilityController@showInput');
    Route::post('/utility-online/listrik/simpan', 'utilityOnline\mainUtilityController@bagianSimpan');
    
    Route::get('/utility-online/gas', 'utilityOnline\mainUtilityController@gas');
    Route::get('/utility-online/gas/{id}', 'utilityOnline\mainUtilityController@gasId');
    Route::get('/utility-online/gas/workcenter/{id}', 'utilityOnline\mainUtilityController@showInput');
    Route::post('/utility-online/gas/simpan', 'utilityOnline\mainUtilityController@bagianSimpan');

    Route::get('/utility-online/admin', 'utilityOnline\adminUtilityController@index');
    Route::get('/utility-online/admin/report', 'utilityOnline\adminUtilityController@report');
    Route::get('/utility-online/admin/report/detail/{id}/{tgl}', 'utilityOnline\adminUtilityController@detailReport');
    Route::get('/utility-online/admin/report/{from}/{to}', 'utilityOnline\adminUtilityController@reportDate');

    // Rollie
    Route::get('/rollie', 'rollie\rollieController@cpp');
    Route::post('/rollie/cpp/import', 'rollie\CppController@importCpp')->name('import-cpp');
    
    Route::get('/rollie/analisa-kimia-fg', 'rollie\rollieController@analisaKimia');
    Route::get('/rollie/analisa-kimia-fg/analisa-produk/{id}', 'rollie\rollieController@analisaKimiaAnalisa')->name('analisa-produk');
    Route::get('/rollie/rkj', 'rollie\rollieController@rkj');
    Route::get('/rollie/rkj/input', 'rollie\rollieController@rkjInput');
    Route::get('/rollie/package-integrity', 'rollie\rollieController@packageIntegrity');
    Route::get('/rollie/ppq-fg', 'rollie\rollieController@ppq');
    Route::get('/rollie/analisa-mikro', 'rollie\rollieController@analisaMikro');
    Route::get('/rollie/sortasi', 'rollie\rollieController@sortasi');
    Route::get('/rollie/rpr', 'rollie\rollieController@rpr');
    Route::get('/rollie/reports', 'rollie\rollieController@report');
});
