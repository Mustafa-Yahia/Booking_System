<?php

use App\Http\Controllers\RenterController;
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




// Route::get('/update/{id}', [RenterController::class, 'edit']);
// Route::put('/update/{id}', [RenterController::class, 'update'])->name('renter.update');
Route::Resource('renter', RenterController::class);







// End_Ghassan












// Mohammed








// End_Mohammed


















//Mustafa




//Mustafa
