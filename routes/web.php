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

Route::get('/', function () {
    return view('welcome');
});

// Majd











// end_Majd










//Ebrahim














//end_Ebrahim











// Ghassan












// End_Ghassan












// Mohammed

use App\Http\Controllers\PropertyController;
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




//Mustafa
