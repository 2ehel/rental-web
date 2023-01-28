<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\User\BookingController as UserBooking;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\MenuController as FrontendMenuController;
use App\Http\Controllers\Frontend\ReservationController as FrontendReservationController;
use App\Http\Controllers\Frontend\WelcomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [WelcomeController::class, 'index']);
Route::get('/categories', [FrontendCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [FrontendCategoryController::class, 'show'])->name('categories.show');
Route::get('/menus', [FrontendMenuController::class, 'index'])->name('menus.index');
// Route::get('/booking/step-one', [FrontendReservationController::class, 'stepOne'])->name('reservations.step.one');
// Route::post('/booking/step-one', [FrontendReservationController::class, 'storeStepOne'])->name('reservations.store.step.one');
// Route::get('/booking/step-two', [FrontendReservationController::class, 'stepTwo'])->name('reservations.step.two');
// Route::post('/booking/step-two', [FrontendReservationController::class, 'storeStepTwo'])->name('reservations.store.step.two');
Route::get('/thankyou', [WelcomeController::class, 'thankyou'])->name('thankyou');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/booking', [UserBooking::class,'listing'])->name('bookings.index');
Route::get('/car', [UserBooking::class,'listing'])->name('car');
Route::get('/booking/step-one', [UserBooking::class, 'stepOne'])->name('bookings.step.one');
Route::post('/booking/step-one', [UserBooking::class, 'storeStepOne'])->name('bookings.store.step.one');
Route::get('/booking/step-two', [UserBooking::class, 'stepTwo'])->name('bookings.step.two');
Route::post('/booking/step-two', [UserBooking::class, 'storeStepTwo'])->name('bookings.store.step.two');

// })->group(function () {
//     Route::get('/car', Car::class)->name('car');
//     Route::get('/car_listing', CarListing::class)->name('car_listing');
//     Route::get('/updatecar', ModalUpdateCar::class)->name('updatecar');


Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/menus', MenuController::class);
    Route::resource('/tables', TableController::class);
    Route::resource('/reservations', ReservationController::class);
    Route::resource('/bookings', BookingController::class);
    Route::resource('/cars', CarController::class);
});

require __DIR__ . '/auth.php';
