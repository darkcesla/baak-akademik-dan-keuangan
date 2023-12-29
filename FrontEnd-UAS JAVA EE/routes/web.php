<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// routes/web.php

use App\Http\Controllers\UserController;
// routes/web.php
use App\Http\Controllers\AdminController\RuanganController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController\KaosController;
use App\Http\Controllers\AdminController\MahasiswaController;
use App\Http\Controllers\AdminController\BookingController;
use App\Http\Controllers\AdminController\PesananKaosController;
use App\Http\Controllers\AdminController\IzinBermalamController;
use App\Http\Controllers\AdminController\IzinKeluarController;
use App\Http\Controllers\AdminController\SuratAdminController;


use App\Http\Controllers\UserController\RuanganUserController;
use App\Http\Controllers\UserController\IzinKeluarUserController;
use App\Http\Controllers\UserController\IzinBermalamUserController;
use App\Http\Controllers\UserController\SuratController;
use App\Http\Controllers\UserController\PesananKaosUsersController;




// Rute untuk menampilkan halaman login
Route::get('/login', [PageController::class, 'showLogin'])->name('vlogin');

// Rute untuk menampilkan halaman register
Route::get('/register', [PageController::class, 'showRegister'])->name('vregister');

// Rute untuk menampilkan halaman data pengguna
Route::get('/user-data', [PageController::class, 'showUserData']);


// Rute untuk halaman login
Route::post('/login', [UserController::class, 'login'])->name('login');

// Rute untuk halaman register
Route::post('/register', [UserController::class, 'register'])->name('register');

// Rute Untuk Halaman Dashboard
Route::get('/BAAK/dashboard' , [PageController::class, 'showDashboardBAAK'])->name('dashboard_BAAK');
Route::get('/Mahasiswa/dashboard' , [PageController::class, 'showDashboardMahasiswa'])->name('dashboard_Mahasiswa');


// Rute untuk validasi token dan menampilkan data pengguna
Route::get('/user-data', [UserController::class, 'validateToken']);

route::get('/logout',[UserController::class, 'logout'])->name('logout');

//Rute Mahasiswa

//Rute Izin Keluar Mahasiswa
Route::get('/Mahasiswa/IzinKeluar',[IzinKeluarUserController::class,'ShowIzinKeluar'])->name('IK_Mahasiswa');
route::get('/Mahasiswa/IzinKeluar/cancel/{id}',[IzinKeluarUserController::class,'Cancaled'])->name('Canceled_IK');
Route::get('/Mahasiswa/IzinKeluar/AddForm',[PageController::class,'AddIzinKeluarForm'])->name('Add_IK');
Route::post('/Mahasiswa/IzinKeluar/Add',[IzinKeluarUserController::class,'AddIzinKeluar'])->name('AddIK');

//Rute Izin Bermalam Mahasiswa
Route::get('/Mahasiswa/IzinBermalam',[IzinBermalamUserController::class,'ShowIzinBermalam'])->name('IB_Mahasiswa');
route::get('/Mahasiswa/IzinBermalam/cancel/{id}',[IzinBermalamUserController::class,'Canceled'])->name('Canceled_IB');
Route::get('/Mahasiswa/IzinBermalam/AddForm',[PageController::class,'AddIzinBermalamForm'])->name('Add_IB');
Route::post('/Mahasiswa/IzinBermalam/Add',[IzinBermalamUserController::class,'AddIzinBermalam'])->name('AddIB');

//Rute Booking Ruangan Mahasiswa
Route::get('/Mahasiswa/BookingRuangan',[RuanganUserController::class,'ShowBooking'])->name('Booking_Mahasiswa');
Route::get('/Mahasiswa/BookingRuangan/AddForm',[PageController::class,'AddBookingForm'])->name('Add_Booking');
Route::post('/Mahasiswa/BookingRuangan/Add',[RuanganUserController::class,'AddBooking'])->name('AddBooking');
route::get('/Mahasiswa/BookingRuangan/cancel/{id}',[RuanganUserController::class,'Canceled'])->name('Canceled_Booking');

//Rute  Surat Mahasiswa
Route::get('/Mahasiswa/Surat',[SuratController::class,'ShowSurat'])->name('Surat_Mahasiswa');
Route::get('/Mahasiswa/Surat/AddForm',[PageController::class,'AddSuratForm'])->name('Add_Surat');
Route::post('/Mahasiswa/Surat/Add',[SuratController::class,'AddSurat'])->name('AddSurat');
route::get('/Mahasiswa/Surat/cancel/{id}',[SuratController::class,'Canceled'])->name('Canceled_Surat');

//Rute Pesanan Kaos Mahasiswa
Route::get('/Mahasiswa/PaymentKaos',[PesananKaosUsersController::class,'showPesananKaos'])->name('PaymentKaos');
Route::get('/Mahasiswa/Kaos',[PesananKaosUsersController::class,'Showkaos'])->name('Kaos_Mahasiswa');
Route::get('/Mahasiswa/PaymentKaos/AddForm',[PageController::class,'AddPaymentKaosForm'])->name('Add_PaymentKaos');
Route::post('/Mahasiswa/PaymentKaos',[PesananKaosUsersController::class,'AddPaymentKaos'])->name('AddPaymentKaos');


//Rute Coba Coba

Route::get('/Mahasiswa/IzinBermalam/generate/{id}',[IzinBermalamUserController::class,'generatePDF'])->name('generate');

//Rute BAAK

//Rute Lihat Pesanan
route::get('/BAAK/PesananKaos', [PesananKaosController::class ,'showPesananKaos'])->name('PesananKaos_BAAK');


//Rute Ruangan BAAK
route::get('/BAAK/Ruangan', [RuanganController::class ,'showRuangan'])->name('Ruangan_BAAK');
route::post('/BAAK/AddRuangan', [RuanganController::class ,'CreateRuangan'])->name('addruangan');
route::get('/BAAK/AddRuangan',[PageController::class,'AddRuanganForm'])->name('Create_Ruangan');
route::get('/BAAK/EditRuangan/{id}',[PageController::class,'EditRuanganForm'])->name('Edit_Ruangan');
route::post('/BAAK/EditRuangan/{id}', [RuanganController::class ,'EditRuangan'])->name('Editruangan');
Route::get('/BAAK/delete-ruangan/{id}', [RuanganController::class, 'DeleteRuangan'])->name('Delete_Ruangan');

//Rute Kaos BAAK
route::get('/BAAK/kaos', [KaosController::class ,'showkaos'])->name('kaos_BAAK');
route::post('/BAAK/Addkaos', [KaosController::class ,'Createkaos'])->name('addkaos');
route::get('/BAAK/Addkaos',[PageController::class,'AddkaosForm'])->name('Create_kaos');
route::get('/BAAK/Editkaos/{id}',[PageController::class,'EditkaosForm'])->name('Edit_kaos');
route::post('/BAAK/Editkaos/{id}', [KaosController::class ,'Editkaos'])->name('Editkaos');
Route::get('/BAAK/delete-kaos/{id}', [KaosController::class, 'Deletekaos'])->name('Delete_kaos');

//Rute Data Mahasiswa
route::get('/BAAK/User', [MahasiswaController::class ,'showUser'])->name('User_BAAK');
route::get('/BAAK/AddUser',[PageController::class,'AddUserForm'])->name('Create_User');
route::get('/BAAK/EditUser/{id}',[PageController::class,'EditUserForm'])->name('Edit_User');
route::post('/BAAK/EditUser/{id}', [MahasiswaController::class ,'EditUser'])->name('EditUser');
Route::get('/BAAK/delete-User/{id}', [MahasiswaController::class, 'DeleteUser'])->name('Delete_User');

//Rute Booking Mahasiswa Oleh BAAK
route::get('/BAAK/Booking',[BookingController::class,'showBooking'])->name('Booking_BAAK');
route::get('/BAAK/Booking/rejected/{id}',[BookingController::class,'Rejected'])->name('Rejected_Booking');
route::get('/BAAK/Booking/approve/{id}',[BookingController::class,'Approve'])->name('Approve_Booking');

//Rute IB Mahasiswa Oleh BAAK
route::get('/BAAK/IB',[IzinBermalamController::class,'showIB'])->name('IB_BAAK');
route::get('/BAAK/IB/rejected/{id}',[IzinBermalamController::class,'Rejected'])->name('Rejected_IB');
route::get('/BAAK/IB/approve/{id}',[IzinBermalamController::class,'Approve'])->name('Approve_IB');

//Rute IK Mahasiswa Oleh BAAK
route::get('/BAAK/IK',[IzinKeluarController::class,'showIK'])->name('IK_BAAK');
route::get('/BAAK/IK/rejected/{id}',[IzinKeluarController::class,'Rejected'])->name('Rejected_IK');
route::get('/BAAK/IK/approve/{id}',[IzinKeluarController::class,'Approve'])->name('Approve_IK');

//Rute Surat Mahasiswa Oleh BAAK
route::get('/BAAK/Surat',[SuratAdminController::class,'showSurat'])->name('Surat_BAAK');
route::get('/BAAK/Surat/rejected/{id}',[SuratAdminController::class,'Rejected'])->name('Rejected_Surat');
route::post('/BAAK/Surat/approve/{id}',[SuratAdminController::class,'Approve'])->name('Approve_Surat');
route::get('/BAAK/Surat/addapprove/{id}',[SuratAdminController::class,'Add_File_Approve'])->name('Add_Approve_Surat');



Route::get('/', function () {
    return view('pages.login');
});
