<?php

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

Route::get('/', function () {
    return view('index');
});

// Majd











// end_Majd










//Ebrahim














//end_Ebrahim











// Ghassan












// End_Ghassan












// Mohammed








// End_Mohammed


















//Mustafa

Route::get('/', [PropertyController::class, 'index'])->name('home');




//Mustafa
