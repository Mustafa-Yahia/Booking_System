<?php

// use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LessorController;
use App\Http\Controllers\RenterController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

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

// Payment routes
Route::get('/payments', [PaymentController::class, 'index'])->name('payment.index');
Route::delete('/payments/{id}', [PaymentController::class, 'remove'])->name('payment.remove');
Route::post('/payments', [PaymentController::class, 'store'])->name('payment.store');

// Checkout routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'processPayment'])->name('checkout.process');
Route::delete('/booking/{id}', [CheckoutController::class, 'destroy'])->name('booking.delete');

// Credit Card Payment routes
Route::get('/checkout/credit-card', [CheckoutController::class, 'showCreditCardForm'])->name('credit.card');
Route::post('/checkout/payment', [CheckoutController::class, 'processPayment'])->name('checkout.payment.process');




Route::post('/credit-card', [CheckoutController::class, 'processPayment'])->name('credit-card');

Route::post('/process-payment', [CheckoutController::class, 'processPayment'])->name('checkout.process');

// End_Majd





// end_Majd



//Ebrahim











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
        return view('contactus');
    })->name('contact-us');
});



// Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');


//Mustafa
