<?php

// use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LessorController;
use App\Http\Controllers\RenterController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


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





Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

//  Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminController::class, 'indexUsers'])->name('users.index');

    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');

    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');

    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');

    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');

    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.delete');
  // ======= Properties =======
  Route::get('/properties', [AdminController::class, 'indexProperties'])->name('properties.index');
  Route::get('/properties/create', [AdminController::class, 'createProperty'])->name('properties.create');
  Route::post('/properties', [AdminController::class, 'storeProperty'])->name('properties.store');
  Route::delete('admin/properties/{property}', [AdminController::class, 'destroy'])->name('properties.delete');
  Route::get('/admin/properties/{property}/reviews', [AdminController::class, 'indexRevie'])->name('properties.reviews');
Route::delete('/admin/reviews/{review}', [AdminController::class, 'destroyRevie'])->name('reviews.delete');

//   Route::delete('/properties/{property}', [AdminController::class, 'destroyProperty'])->name('properties.delete');

  // ======= Bookings =======
  Route::get('/bookings', [AdminController::class, 'indexBookings'])->name('bookings.index');
  Route::get('/bookings/{booking}', [AdminController::class, 'showBooking'])->name('bookings.show');
  Route::delete('/bookings/{id}', [AdminController::class, 'destroyBooking'])->name('bookings.destroy');

  Route::get('/admin/bookings/{booking:name}/edit', [AdminController::class, 'editBooking'])->name('bookings.edit');
  Route::put('/admin/bookings/{booking:name}', [AdminController::class, 'updateBooking'])->name('bookings.update');
  // ======= Stats =======
  Route::get('/stats', [AdminController::class, 'showStats'])->name('stats');
});








//end_Ebrahim





// Ghassan












// End_Ghassan




// Mohammed

use App\Http\Controllers\PropertyImageController;

Route::get('/lessor/dashboard', [PropertyController::class, 'dashboard'])->name('lessor.dashboard');
// Routes for properties
Route::get('/lessor/properties', [PropertyController::class, 'index'])->name('lessor.properties.index');
Route::get('/lessor/properties/create', [PropertyController::class, 'create'])->name('lessor.properties.create');
Route::post('/lessor/properties', [PropertyController::class, 'store'])->name('lessor.properties.store');
Route::get('/lessor/properties/{property}/edit', [PropertyController::class, 'edit'])->name('lessor.properties.edit');
Route::put('/lessor/properties/{property}', [PropertyController::class, 'update'])->name('lessor.properties.update');
Route::get('/lessor/properties/{property}', [PropertyController::class, 'show'])->name('lessor.properties.show');
Route::delete('/lessor/properties/{property}', [PropertyController::class, 'destroy'])->name('lessor.properties.destroy');

// Routes for property images
Route::delete('/lessor/properties/{property}/images/{image}', [PropertyImageController::class, 'destroy'])->name('lessor.property_images.destroy');


// End_Mohammed




//Mustafa
// Mustafa

Route::get('/', [PropertyController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('real-state', [PropertyController::class, 'realState'])->name('properties.index'); // صفحة Real State مع الفلترة
    Route::get('contact-us', function () {
        return view('renter.contactus');
    })->name('contact-us');
});


Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');


//Mustafa
