<?php

use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     //return view('welcome');
//     return view('dashboard');
//     //return view('login');
//     //return view('registration');
// });

Route::get('/',[UserController::class,'login'])->name('/')->middleware('alreadyLoggedIn');
Route::get('/registration',[UserController::class,'registration'])->name('registration')->middleware('alreadyLoggedIn');
Route::post('/register-user',[UserController::class,'registerUser'])->name('register-user');
Route::post('/login-user',[UserController::class,'loginUser'])->name('login-user');
Route::get('/dashboard',[UserController::class,'dashboard'])->name('dashboard')->middleware('isLoggedIn');
Route::get('/logout',[UserController::class,'logout']);

Route::get('/adminDashboard',[UserController::class,'adminDashboard'])->name('adminDashboard')->middleware('isLoggedIn');


Route::get('/prescription',[PrescriptionController::class,'prescription'])->name('prescription')->middleware('alreadyLoggedIn');
Route::get('/prescription_list',[PrescriptionController::class,'prescription_list'])->name('prescription_list')->middleware('alreadyLoggedIn');
Route::post('/add-prescription',[PrescriptionController::class,'addPrescription'])->name('add-prescription');
Route::get('/user-prescription-list',[PrescriptionController::class,'userPrescriptionList'])->name('user-prescription-list');
Route::get('/prescription-view/{id}', [PrescriptionController::class,'prescriptionView'])->name('prescription_view')->middleware('alreadyLoggedIn');

Route::get('/quotation/{id}',[QuotationController::class,'quotation'])->name('quotation')->middleware('alreadyLoggedIn');
Route::post('/add-quotation',[QuotationController::class,'addQuotation'])->name('add-quotation');
Route::get('/quotation-email/{id}',[QuotationController::class,'quotationEmail'])->name('quotation-email')->middleware('alreadyLoggedIn');
Route::get('/quotation_list',[QuotationController::class,'quotation_list'])->name('quotation_list')->middleware('alreadyLoggedIn');
Route::get('/admin-quotation_list',[QuotationController::class,'adminQuotationList'])->name('admin-quotation_list')->middleware('alreadyLoggedIn');
Route::get('/quotation-view/{id}', [QuotationController::class,'quotationView'])->name('quotation_view')->middleware('alreadyLoggedIn');
Route::get('/quotation-accept/{id}',[QuotationController::class,'quotationAccept'])->name('quotation-accept')->middleware('alreadyLoggedIn');
Route::get('/quotation-reject/{id}',[QuotationController::class,'quotationReject'])->name('quotation-reject')->middleware('alreadyLoggedIn');

