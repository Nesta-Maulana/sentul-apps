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
Route::get('/ganti-password/{id}', 'userAccess\userAccessController@gantiPassword')->name('ganti-password');
Route::post('/ganti-user-password', 'userAccess\userAccessController@gantiUserPassword');
Route::post('/login-form', 'userAccess\userAccessController@login')->name('user-login');
Route::post('/register', 'userAccess\userAccessController@register')->name('user-register');

Route::get('/admin/dashboard', 'userAccess\userAccessController@dashboard');
Route::get('/logout', 'userAccess\userAccessController@logout');

Route::get('/halaman-help', 'hakAkses\hakAksesController@hakAkses');
Route::post('/request-hak-akses/request', 'hakAkses\hakAksesController@requestHakAkses')->name('request-hak-akses');
Route::get('/request-hak-akses/aplication/{id}/{idUser}', 'hakAkses\hakAksesController@allMenu');
Route::get('/home-nothing', 'userAccess\userAccessController@homeNothing')->name('home-no-hak-akses');
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

    Route::get('/master-apps/sub-brand', 'masterApps\superAdminController@subBrand');
    Route::post('/master-apps/sub-brand/data', 'masterApps\superAdminController@dataSubBrand')->name('sub-brand-data');
    Route::get('/master-apps/sub-brand/edit/{id}', 'masterApps\superAdminController@editSubBrand');

    Route::get('/master-apps/brand', 'masterApps\superAdminController@brand');
    Route::post('/master-apps/brand/data', 'masterApps\superAdminController@dataBrand')->name('brand-data');
    Route::get('/master-apps/brand/edit/{id}', 'masterApps\superAdminController@editBrand');
    
    Route::get('/master-apps/aplikasi', 'masterApps\superAdminController@aplikasi')->name('aplikasi');
    Route::post('/master-apps/aplikasi/save', 'masterApps\superAdminController@saveAplikasi')->name('aplikasi-save');
    Route::get('/master-apps/aplikasi/{id}', 'masterApps\superAdminController@editAplikasi');

    Route::get('/master-apps/hak-akses-aplikasi', 'masterApps\superAdminController@hakAksesAplikasi')->name('hak-akses-aplikasi');
    Route::get('/master-apps/hak-akses-aplikasi/user/{id}', 'masterApps\superAdminController@showHakAksesAplikasi');
    Route::get('/master-apps/hak-akses-aplikasi/ubah-hak-akses/{id}/{aksi}', 'masterApps\superAdminController@ubahHakAksesAplikasi');

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
    Route::post('/master-apps/mesin-filling-head-detail/save', 'masterApps\superAdminController@mesinFillingHeadDetailSave')->name('mesin-filling-head-detail-save');
    Route::get('/master-apps/mesin-filling-head-detail/edit/{id}', 'masterApps\superAdminController@editMesinFillingHeadDetail');

    // Delete 
    Route::get('/master-apps/delete/{connection}/{table}/{id}', 'resourceController@deleteData');

    // Utility Online
    Route::get('/utility-online/admin/form-hari-kerja', 'utilityOnline\adminUtilityController@hariKerja');
    Route::get('/utility-online/admin/form-hari-kerja-ambil/', 'utilityOnline\adminUtilityController@ambilSemuaHariKerja');
    Route::get('/utility-online/admin/form-hari-kerja/{tgl}', 'utilityOnline\adminUtilityController@ambilHariKerja');
    Route::post('/utility-online/admin/form-hari-kerja/save', 'utilityOnline\adminUtilityController@hariKerjaSave')->name('form-hari-kerja-save');

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
    Route::get('/utility-online/admin/report-grafik', 'utilityOnline\adminUtilityController@reportGrafik');
    Route::get('/utility-online/admin/report/bagian/{idBagian}/{from}/{to}', 'utilityOnline\adminUtilityController@reportBagianTgl');
    Route::get('/utility-online/admin/report-2/{from}/{to}', 'utilityOnline\adminUtilityController@report2Tgl');
    

    Route::get('/utility-online/admin/report-3/{from}/{to}', 'utilityOnline\adminUtilityController@report3Tgl');
    Route::get('/utility-online/admin/report-3/{kategori}/{from}/{to}', 'utilityOnline\adminUtilityController@report3Kategori');
    Route::get('/utility-online/admin/report-3/{kategori}', 'utilityOnline\adminUtilityController@report3Kategori');

    Route::get('/utility-online/admin/report-4/{from}/{to}', 'utilityOnline\adminUtilityController@report4Tgl');
    Route::get('/utility-online/admin/report-4/{kategori}/{from}/{to}', 'utilityOnline\adminUtilityController@report4TglKategori');
    Route::get('/utility-online/admin/report-4/{kategori}', 'utilityOnline\adminUtilityController@report4Kategori');
    
    Route::get('/utility-online/admin/report-4/export/{nama_report}/{from}/{tgl1}/{tgl2}', 'utilityOnline\exportImportUtilityController@exportReport4Tgl');
    Route::get('/utility-online/admin/report-4/export/{nama_report}/{from}/{tgl1}/{tgl2}/{kategori}', 'utilityOnline\exportImportUtilityController@exportReport4TglKategori');
    Route::get('/utility-online/admin/report-4/export/{nama_report}/{from}/{kategori}', 'utilityOnline\exportImportUtilityController@exportReport4Kategori');

    Route::get('/utility-online/admin/report/detail/{id}/{tgl}', 'utilityOnline\adminUtilityController@detailReport');
    Route::get('/utility-online/admin/report/{from}/{to}', 'utilityOnline\adminUtilityController@reportDate');
    Route::get('/utility-online/admin/report/{id}', 'utilityOnline\adminUtilityController@reportKategori');
    Route::get('/utility-online/admin/report/{id}/{from}/{to}', 'utilityOnline\adminUtilityController@reportKategoriDate');
    
    // Export Report 1
    Route::get('/utility-online/admin/report/export/{nama_report}/{from}/{tgl1}/{tgl2}', 'utilityOnline\exportImportUtilityController@exportPengamatan');
    Route::get('/utility-online/admin/report/export/{nama_report}/{from}/{kategori}', 'utilityOnline\exportImportUtilityController@penggunaanKategori');
    Route::get('/utility-online/admin/report/export/{nama_report}/{from}/{kategori}/{tgl1}/{tgl2}', 'utilityOnline\exportImportUtilityController@penggunaanKategoriTgl');
    
    // Export Report 3
    Route::get('/utility-online/admin/report/export-3/{nama_report}/{from}/{kategori}', 'utilityOnline\exportImportUtilityController@report3Kategori');
    Route::get('/utility-online/admin/report/export-3/{nama_report}/{from}/{tgl1}/{tgl2}', 'utilityOnline\exportImportUtilityController@report3Tgl');
    Route::get('/utility-online/admin/report/export-3/{nama_report}/{from}/{kategori}/{tgl1}/{tgl2}', 'utilityOnline\exportImportUtilityController@report3KategoriTgl');

    // UtilityOnline UserGuide
    Route::get('/utility-online/user-guide', 'utilityOnline\utilityOnlineController@userGuide');


    // Rollie penyelia
    Route::get('/rollie-penyelia', 'rollie\penyeliaController@index')->name('penyelia-index');
    Route::get('/rollie-penyelia/jadwal-produksi', 'rollie\penyeliaController@index');
    Route::post('/rollie-penyelia/jadwal-produksi/delete/{id}', 'rollie\penyeliaController@cancel');
    Route::post('/rollie-penyelia/jadwal-produksi', 'rollie\penyeliaController@importJadwalProduksi')->name('import-jadwal-produksi');

    // Rollie operator
    Route::get('/rollie-operator-produksi', 'rollie\rollieOperatorController@fillpackindex')->name('dashboard-operator-fillpack');
    Route::get('/rollie-operator-produksi/cpp', 'rollie\rollieOperatorController@cpp')->name('dashboard-operator-fillpack');

    // Rollie Inspektor
    Route::get('/rollie-inspektor-qc', 'rollie\inspektorController@index')->name('dashboard-inspektor-qc');
    Route::get('/rollie-inspektor-qc/rpd-filling/{rpd_filling_head_id}', 'rollie\inspektorController@rpdfilling')->name('rpdfilling-inspektor-qc');
    Route::get('/rollie-inspektor-qc/refresh-rpd-filling/{rpd_filling_head_id}', 'rollie\inspektorController@refreshTablePi')->name('refresh-rpd-filling');
    Route::post('/rollie-inspektor-qc/rpd-filling/proses-rpd', 'rollie\inspektorController@prosesrpdfilling')->name('proses-rpd-filling');
    Route::post('/rollie-inspektor-qc/rpd-filling/tambah-sampel', 'rollie\inspektorController@tambahSampel')->name('tambahsampel-inspektor-qc');
    Route::post('/rollie-inspektor-qc/rpd-filling/analisa-sampel-pi', 'rollie\inspektorController@analisaSampelPi')->name('analisapi-inspektor-qc');
    Route::post('/rollie-inspektor-qc/rpd-filling/analisa-sampel-event', 'rollie\inspektorController@analisaSampelEvent')->name('analisaevent-inspektor-qc');

    // Route::post('/rollie-inspektor-qc/rpd-filling/proses-rpd', 'rollie\inspektorController@rpdfilling')->name('proses-rpd-filling');
    
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

    // GoOffice
    Route::get('/go-office', 'goOffice\goOfficeController@index');
});
