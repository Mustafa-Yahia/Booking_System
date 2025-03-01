<?php

// use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LessorController;
use App\Http\Controllers\RenterController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ContactController;

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



// Majd




Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');






Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::middleware(['auth', 'role:lessor'])->get('/lessor/dashboard', function () {
    return view('lessor.dashboard');
})->name('lessor.dashboard');

Route::middleware(['auth', 'role:renter'])->get('/renter', [PropertyController::class, 'index'])->name('index');




// end_Majd



//Ebrahim











//end_Ebrahim





// Ghassan












// End_Ghassan




// Mohammed








// End_Mohammed




//Mustafa
// Mustafa

Route::get('/', [PropertyController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('real-state', [PropertyController::class, 'realState'])->name('properties.index'); // صفحة Real State مع الفلترة
    Route::get('contact-us', function () {
        return view('contactus');
    })->name('contact-us');
});



// Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');


//Mustafa
