<?php

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





use App\Http\Controllers\Admin\AdminController;
// Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

 Route::prefix('admin')->name('admin.')->group(function () {
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








// End_Mohammed


















//Mustafa
Route::get('/', [PropertyController::class, 'index'])->name('home');
Route::get('/real-state', [PropertyController::class, 'realState'])->name('properties.index'); // صفحة Real State مع الفلترة


Route::get('/contact-us', function () {
    return view('contactus');
});




// Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');


//Mustafa
