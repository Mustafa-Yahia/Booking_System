<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\RenterController;
// use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;

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











// end_Majd










//Ebrahim














//end_Ebrahim











// Ghassan





Route::Resource('renter', RenterController::class);

Route::resource('properties', PropertyController::class);

Route::Resource('booking', BookingController::class);





// End_Ghassan












// Mohammed








// End_Mohammed


















//Mustafa
Route::get('/', [PropertyController::class, 'index'])->name('home');
Route::get('/real-state', [PropertyController::class, 'realState'])->name('properties.index'); // صفحة Real State مع الفلترة


Route::get('/contact-us', function () {
    return view('contactus');
});




// Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');


//Mustafa
