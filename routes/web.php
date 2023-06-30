<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\User\BookingController as UserBooking;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\MenuController as FrontendMenuController;
use App\Http\Controllers\Frontend\ReservationController as FrontendReservationController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\User\RecordController;
use App\Http\Controllers\User\SearchController;
use App\Http\Controllers\User\ProfileController;

use Illuminate\Support\Facades\Route;


Route::get('/', [WelcomeController::class, 'index']);

Route::get('/thankyou', [WelcomeController::class, 'thankyou'])->name('thankyou');

Route::get('/dashboard', [SearchController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');
    
Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile/view', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile', 'ProfileController@update')->name('profile.update');
    });
    

Route::get('/booking', [UserBooking::class,'listing'])->name('bookings.index');
// Route::resource('/bookings', UserBooking::class);
Route::get('/car', [UserBooking::class,'listing'])->name('car');
Route::get('/booking/step-one', [UserBooking::class, 'stepOne'])->name('bookings.step.one');
Route::post('/booking/step-one', [UserBooking::class, 'storeStepOne'])->name('bookings.store.step.one');
Route::get('/booking/step-two', [UserBooking::class, 'stepTwo'])->name('bookings.step.two');
Route::post('/booking/step-two', [UserBooking::class, 'storeStepTwo'])->name('bookings.store.step.two');
Route::get('/booking/payment', [UserBooking::class, 'payment'])->name('bookings.payment');
Route::post('/booking/payment', [UserBooking::class, 'storePayment'])->name('bookings.store.payment');
Route::put('/booking/update-status/{booking_id}', [UserBooking::class, 'updateStatus'])->name('bookings.updateStatus');
Route::get('/record/listing_record/{record}', [RecordController::class, 'index'])
    ->name('records.listing_record');
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/checkout', [UserBooking::class, 'checkout'])->name('bookings.checkout');
Route::post('/session', [UserBooking::class, 'session'])->name('bookings.session');
Route::get('/success', [UserBooking::class, 'success'])->name('bookings.success');


Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    // Route::resource('/reservations', ReservationController::class);
    Route::resource('/bookings', BookingController::class);
    Route::resource('/history', HistoryController::class);
    Route::resource('/invoice', InvoiceController::class);
    // Route::put('/bookings/update-status', 'BookingController@updateStatus')->name('admin.bookings.updateStatus');
    Route::resource('/cars', CarController::class);
    // Route::put('/items/{id}/update-status', 'ItemController@updateStatus')->name('items.updateStatus');
    

});

require __DIR__ . '/auth.php';
