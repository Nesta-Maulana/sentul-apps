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
Route::get('/verifikasiUser/{nik}', 'userAccess\userAccessController@verifikasiUser')->name('user-verifikasi');

Route::get('/admin/dashboard', 'userAccess\userAccessController@dashboard');

Route::get('/logout', 'userAccess\userAccessController@logout')->name('logout');
Route::get('/user-guide', 'userAccess\userAccessController@userguide')->name('user-guide');
Route::get('/enkripsi/{enkripsiannya}','resourceController@enkripsi')->name('enkripsi');

Route::get('/dekripsi/{dekripsi}','resourceController@dekripsi')->name('dekripsi');

Route::get('/home-nothing', 'userAccess\userAccessController@homeNothing')->name('home-no-hak-akses');
Route::get('/halaman-help', 'hakAkses\hakAksesController@index')->name('halaman-help');
Route::get('/request-hak-akses', 'hakAkses\hakAksesController@hakAkses')->name('request-hak-akses-menu');
Route::post('/request-hak-akses/request', 'hakAkses\hakAksesController@requestHakAkses')->name('request-hak-akses');
Route::get('/request-hak-akses/aplication/{id}/{idUser}', 'hakAkses\hakAksesController@allMenu');

Route::middleware('ceklogin')->group(function ()
{   
    Route::get('/home', 'masterApps\superAdminController@index')->name('home-aplikasi');    
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

    Route::get('/master-apps/verify-request', 'masterApps\superAdminController@verifyRequest');
    Route::get('/master-apps/verify-request/aplikasi/{id}', 'masterApps\superAdminController@verifyRequestAplikasi');
    Route::get('/master-apps/verify-request/menu/{id}', 'masterApps\superAdminController@verifyRequestMenu');
    Route::get('/master-apps/verify-request/user/{id}', 'masterApps\superAdminController@verifyRequestUser');
    Route::get('/master-apps/verify-request/aksi/{id}', 'masterApps\superAdminController@verifyRequestAksi');
    
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
    Route::get('/delete/{connection}/{table}/{id}', 'resourceController@deleteData'); 

    //edit bagian
    Route::get('/edit-bagian', 'utilityOnline\mainUtilityController@bagian');
    Route::get('/edit-bagian/edit/{id}', 'utilityOnline\mainUtilityController@editBagian');
    Route::post('/edit-bagian/data', 'utilityOnline\mainUtilityController@dataBagian');

    //satuan
    Route::get('/satuan', 'utilityOnline\mainUtilityController@satuan');
    Route::get('/satuan/edit/{id}', 'utilityOnline\mainUtilityController@editSatuan');
    Route::post('/satuan/data', 'utilityOnline\mainUtilityController@dataSatuan');
 
    //kategori
    Route::get('/kategori', 'utilityOnline\mainUtilityController@kategori');
    Route::get('/kategori/edit/{id}', 'utilityOnline\mainUtilityController@editKategori');
    Route::post('/kategori/data', 'utilityOnline\mainUtilityController@dataKategori');

    //workcenter
    Route::get('/workcenter','utilityOnline\mainUtilityController@workcenter');
    Route::get('/workcenter/edit/{id}','utilityOnline\mainUtilityController@editWorkcenter');
    Route::post('/workcenter/data','utilityOnline\mainUtilityController@dataWorkcenter');

     //UTILITY LITE VERSION     
    Route::get('/utility-lite/pages/icons', 'utilityOnline\mainUtilityController@coba');
    Route::get('/utility-lite', 'utilityOnline\mainUtilityController@index2');
    Route::get('/utility-lite/water', 'utilityOnline\mainUtilityController@water');
    Route::post('/utility-lite/water/simpan', 'utilityOnline\mainUtilityController@bagianSimpan');
    Route::get('/utility-lite/water/workcenter/{id}', 'utilityOnline\mainUtilityController@showInput');
    Route::get('/utility-lite/water/{id}', 'utilityOnline\mainUtilityController@waterId');
    
    Route::get('/utility-lite/database', 'utilityOnline\mainUtilityController@database'); 
    Route::get('/utility-lite/database', 'utilityOnline\mainUtilityController@database');
    Route::get('/utility-lite/database/workcenter/{id}', 'utilityOnline\mainUtilityController@databaseWorkcenter');
    Route::get('/utility-lite/database/bagian/{id}/{tanggal}', 'utilityOnline\mainUtilityController@databaseBagian');
    Route::get('/utility-lite/database/edit/{id}/{tgl}', 'utilityOnline\mainUtilityController@editDatabase');
    Route::post('/utility-lite/database/update', 'utilityOnline\mainUtilityController@updateDatabase');
    Route::post('/utility-lite/database/simpan', 'utilityOnline\mainUtilityController@simpanDatabase');
    
    Route::get('/utility-lite/listrik', 'utilityOnline\mainUtilityController@listrik');
    Route::get('/utility-lite/listrik/{id}', 'utilityOnline\mainUtilityController@listrikId');
    Route::get('/utility-lite/listrik/workcenter/{id}', 'utilityOnline\mainUtilityController@showInput');
    Route::post('/utility-lite/listrik/simpan', 'utilityOnline\mainUtilityController@bagianSimpan');
    
    Route::get('/utility-lite/gas', 'utilityOnline\mainUtilityController@gas');
    Route::get('/utility-lite/gas/{id}', 'utilityOnline\mainUtilityController@gasId');
    Route::get('/utility-lite/gas/workcenter/{id}', 'utilityOnline\mainUtilityController@showInput');
    Route::post('/utility-lite/gas/simpan', 'utilityOnline\mainUtilityController@bagianSimpan');
    //END UTILITY LITE

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

    Route::get('/utility-online/admin/report/bagian/{id}', 'utilityOnline\adminUtilityController@reportBagian');
    Route::get('/utility-online/admin/report/bagian/{idBagian}/{from}/{to}', 'utilityOnline\adminUtilityController@reportBagianTgl');

    Route::get('/utility-online/admin/report-2', 'utilityOnline\adminUtilityController@report2');
    Route::get('/utility-online/admin/report-2/{from}/{to}', 'utilityOnline\adminUtilityController@report2Tgl');
    

    Route::get('/utility-online/admin/report-3', 'utilityOnline\adminUtilityController@report3');
    Route::get('/utility-online/admin/report-3/{from}/{to}', 'utilityOnline\adminUtilityController@report3Tgl');
    Route::get('/utility-online/admin/report-3/{kategori}/{from}/{to}', 'utilityOnline\adminUtilityController@report3Kategori');
    Route::get('/utility-online/admin/report-3/{kategori}', 'utilityOnline\adminUtilityController@report3Kategori');

    Route::get('/utility-online/admin/report-4', 'utilityOnline\adminUtilityController@report4');
    Route::get('/utility-online/admin/report-4/{from}/{to}', 'utilityOnline\adminUtilityController@report4Tgl');
    Route::get('/utility-online/admin/report-4/{kategori}/{from}/{to}', 'utilityOnline\adminUtilityController@report4TglKategori');
    Route::get('/utility-online/admin/report-4/{kategori}', 'utilityOnline\adminUtilityController@report4Kategori');
    
    Route::get('/utility-online/admin/report-4/export/{nama_report}/{from}/{tgl1}/{tgl2}', 'utilityOnline\exportImportUtilityController@exportReport4Tgl');
    Route::get('/utility-online/admin/report-4/export/{nama_report}/{from}/{tgl1}/{tgl2}/{kategori}', 'utilityOnline\exportImportUtilityController@exportReport4TglKategori');
    Route::get('/utility-online/admin/report-4/export/{nama_report}/{from}/{kategori}', 'utilityOnline\exportImportUtilityController@exportReport4Kategori');

    Route::get('/utility-online/admin/report-5', 'utilityOnline\adminUtilityController@report5');
    Route::get('/utility-online/admin/report-5/{from}/{to}', 'utilityOnline\adminUtilityController@report5Tgl');
    Route::get('/utility-online/admin/report-5/{kategori}', 'utilityOnline\adminUtilityController@report5Kategori');
    Route::get('/utility-online/admin/report-5/{kategori}/{from}/{to}', 'utilityOnline\adminUtilityController@report5TglKategori');

    Route::get('/utility-online/admin/report-5/export/{nama_report}/{from}/{tgl1}/{tgl2}', 'utilityOnline\exportImportUtilityController@exportReport5Tgl');
    Route::get('/utility-online/admin/report-5/export/{nama_report}/{from}/{tgl1}/{tgl2}/{kategori}', 'utilityOnline\exportImportUtilityController@exportReport5TglKategori');
    Route::get('/utility-online/admin/report-5/export/{nama_report}/{from}/{kategori}', 'utilityOnline\exportImportUtilityController@exportReport5Kategori');

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

    // Utility Online Report Grafik Highchart
    Route::get('/utility-online/admin/report-penggunaan/report-grafik-perbulan', 'utilityOnline\utilityOnlineGrafikController@reportGrafik');
    Route::get('/utility-online/admin/report-penggunaan/report-grafik-perhari', 'utilityOnline\utilityOnlineGrafikController@reportGrafikPerhari');
    Route::get('/utility-online/admin/report-grafik-perhari/report-3', 'utilityOnline\utilityOnlineGrafikController@report3GrafikPerhari');
    Route::get('/utility-online/admin/report-grafik-pertahun-bar/report-3', 'utilityOnline\utilityOnlineGrafikController@report3GrafikPertahunBar');

    // Ajax
    Route::get('/utility-online/admin/option/report-3/bagian/{id}', 'utilityOnline\utilityOnlineGrafikController@optionReport3Bagian');
    Route::get('/utility-online/admin/report-penggunaan/report-grafik/penggunaan/pertahun/{tahun}/{id}', 'utilityOnline\utilityOnlineGrafikController@pengunaanPertahun');
    Route::get('/utility-online/admin/report-penggunaan/report-grafik/penggunaan/perbulan/{tahun}/{bulan}/{id}', 'utilityOnline\utilityOnlineGrafikController@penggunaanPerhari');
    Route::get('/utility-online/admin/report-3/perhari/{tahun}/{bulan}/{id}', 'utilityOnline\utilityOnlineGrafikController@report3Perhari');
    Route::get('/utility-online/admin/report-penggunaan/nama-bagian/{bagian}/{bulan}/{tahun}', 'utilityOnline\utilityOnlineGrafikController@penggunaanPerbulanBagian');
    Route::get('/utility-online/admin/report-grafik-pertahun-bar/report-3/{tahun}/{id}', 'utilityOnline\utilityOnlineGrafikController@report3GrafikPertahunBarAjax');

    // Rollie penyelia
    Route::get('/rollie-penyelia', 'rollie\penyeliaController@index')->name('penyelia-index');
    Route::get('/rollie-penyelia/jadwal-produksi', 'rollie\penyeliaController@index')->name('penyelia-jadwal-dashboard');
    Route::post('/rollie-penyelia/jadwal-produksi/delete/{id}', 'rollie\penyeliaController@cancel');
    Route::post('/rollie-penyelia/jadwal-produksi', 'rollie\penyeliaController@importJadwalProduksi')->name('import-jadwal-produksi');
    Route::post('/rollie-penyelia/proses-wo', 'rollie\penyeliaController@prosesWo')->name('penyelia-proses-wo');

    // Rollie operator
    Route::get('/rollie-operator-produksi', 'rollie\rollieOperatorController@fillpackindex')->name('dashboard-operator-fillpack');
    Route::post('/rollie-operator-produksi/cpp/proses-cpp', 'rollie\rollieOperatorController@prosesCpp')->name('proses-cpp');
    Route::post('/rollie-operator-produksi/cpp/tambah-cpp', 'rollie\rollieOperatorController@tambahCpp')->name('tambah-cpp');

    Route::post('/rollie-operator-produksi/cpp/ubah-jam-awal-cpp', 'rollie\rollieOperatorController@ubahJamAwal')->name('ubah-jam-awal-cpp');
    Route::post('/rollie-operator-produksi/cpp/ubah-jam-akhir-cpp', 'rollie\rollieOperatorController@ubahJamAkhir')->name('ubah-jam-end-cpp');
    Route::post('/rollie-operator-produksi/cpp/ubah-box-cpp', 'rollie\rollieOperatorController@ubahBox')->name('ubah-box-cpp');
    
    Route::get('/rollie-operator-produksi/cpp/refresh-table-cpp/{cpp_head_id}/{wo_aktif}', 'rollie\rollieOperatorController@refreshTableCpp')->name('refresh-table-cpp');
    
    Route::get('/rollie-operator-produksi/cpp/{id}', 'rollie\rollieOperatorController@cpp')->name('operator-cpp');
    Route::get('/rollie-operator-produksi/tambah-wo-batch/{jenis_tambah}/{cpp_head_id}', 'rollie\rollieOperatorController@tambahWo')->name('tambah-wo-batch-cpp');
    Route::post('/rollie-operator-produksi/rpd-filling/tambah-wo-batch-cpp', 'rollie\rollieOperatorController@tambahWoBatch')->name('tambah-wo-cpp');
    Route::post('/rollie-operator-produksi/pindah-produk-cpp', 'rollie\rollieOperatorController@pindahCPP')->name('pindah-produk-cpp');
    Route::post('/rollie-inspektor-qc/close-cpp', 'rollie\rollieOperatorController@closeCpp')->name('close-cpp-operator');

    // Rollie Inspektor
    Route::get('/rollie-inspektor-qc', 'rollie\inspektorController@index')->name('dashboard-inspektor-qc');
    Route::get('/rollie-inspektor-qc/rpd-filling/{rpd_filling_head_id}', 'rollie\inspektorController@rpdfilling')->name('rpdfilling-inspektor-qc');
    Route::get('/rollie-inspektor-qc/refresh-rpd-filling/{rpd_filling_head_id}', 'rollie\inspektorController@refreshTablePi')->name('refresh-rpd-filling');
    Route::get('/rollie-inspektor-qc/tambah-wo-batch/{jenis_tambah}/{rpd_filling_head_id}', 'rollie\inspektorController@tambahWo')->name('tambah-wo-batch');
    Route::post('/rollie-inspektor-qc/rpd-filling/proses-rpd', 'rollie\inspektorController@prosesrpdfilling')->name('proses-rpd-filling');
    Route::post('/rollie-inspektor-qc/rpd-filling/tambah-sampel', 'rollie\inspektorController@tambahSampel')->name('tambahsampel-inspektor-qc');
    Route::post('/rollie-inspektor-qc/rpd-filling/analisa-sampel-pi', 'rollie\inspektorController@analisaSampelPi')->name('analisapi-inspektor-qc');
    Route::post('/rollie-inspektor-qc/rpd-filling/analisa-sampel-event', 'rollie\inspektorController@analisaSampelEvent')->name('analisaevent-inspektor-qc');
    Route::post('/rollie-inspektor-qc/rpd-filling/tambah-wo-batch', 'rollie\inspektorController@tambahWoBatch')->name('tambah-wo-rpd');
    Route::get('/rollie-inspektor-qc/rpd-filling/input-ppq-fg/{rpd_filling_head_id}/{wo_id}/{mesin_filling_id}/{rpd_filling_detail_id}', 'rollie\inspektorController@viewPPQ')->name('ppq-fg-form-rpd');
    Route::post('/rollie-inspektor-qc/ppq-fg/input-ppq-fg', 'rollie\inspektorController@tambahPpq')->name('ppq-fg-input');
    Route::post('/rollie-inspektor-qc/close-rpd', 'rollie\inspektorController@closeRpd')->name('closerpd-inspektor-qc');

    

    // Route::post('/rollie-inspektor-qc/rpd-filling/proses-rpd', 'rollie\inspektorController@rpdfilling')->name('proses-rpd-filling');
    
    Route::get('/rollie', 'rollie\rollieController@analisaKimia');
    Route::post('/rollie/cpp/import', 'rollie\CppController@importCpp')->name('import-cpp');
    Route::get('/rollie/analisa-kimia-fg', 'rollie\rollieController@analisaKimia')->name('analisa-kimia-fg');
    Route::get('/rollie/analisa-kimia-fg/analisa-produk/{id}', 'rollie\rollieController@analisaKimiaAnalisa')->name('analisa-produk');
    Route::post('/rollie/analisa-kimia-fg/hasil-analisa-kimia', 'rollie\rollieController@inputAnalisaKimia')->name('input-analisa-kimia');
    Route::get('/rollie/analisa-kimia-fg/lihat-hasil-analisa/{id}', 'rollie\rollieController@lihatAnalisaKimia')->name('lihat-analisa-produk');

    Route::get('/rollie/rkj', 'rollie\rollieController@rkj');
    Route::get('/rollie/rkj/input', 'rollie\rollieController@rkjInput');
    Route::get('/rollie/package-integrity', 'rollie\rollieController@packageIntegrity');
    Route::get('/rollie/ppq-fg', 'rollie\rollieController@ppq');
    Route::post('/rollie/ppq-fg/input-ppq-fg', 'rollie\rollieController@inputPPQ')->name('ppq-kimia-input');

    Route::get('/rollie/analisa-mikro', 'rollie\rollieController@analisaMikro')->name('analisa-mikro');
    Route::get('/rollie/analisa-mikro/{cpp_head_id}', 'rollie\rollieController@prosesAnalisaMikro')->name('proses-analisa-mikro');
    Route::get('/rollie/resampling-analisa-mikro/{cpp_head_id}', 'rollie\rollieController@resamplingAnalisaMikro')->name('resampling-analisa-mikro');
    Route::post('/rollie/analisa-mikro/hasil-analisa-mikro', 'rollie\rollieController@inputAnalisaMikro')->name('input-analisa-mikro');
    Route::get('/rollie/analisa-mikro/lihat-hasil-analisa/{id}', 'rollie\rollieController@lihatAnalisaMikro')->name('lihat-analisa-produk');
   

    Route::get('/rollie/sortasi', 'rollie\rollieController@sortasi');
    Route::get('/rollie/rpr', 'rollie\rollieController@rpr');
    Route::get('/rollie/reports', 'rollie\rollieController@report');
    // GoOffice
    Route::get('/go-office', 'goOffice\goOfficeController@index');
    //Rollie Febri
    Route::get('/rollie-penyelia-penyelia_ckr','rollie\penyeliaController@penyelia_ckr')->name('rollie-penyelia-penyelia_ckr');
    Route::get('/rollie-penyelia-penyelia_ckr-edit','rollie\penyeliaController@penyelia_ckr_edit')->name('rollie-penyelia-penyelia_ckr-edit');
    Route::get('/rollie-penyelia-icon','rollie\penyeliaController@icon')->name('rollie-penyelia-icon');

});
