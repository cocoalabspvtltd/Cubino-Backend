<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum','role:admin',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('create-hotels',[App\Http\Controllers\Admin\HotelController::class,'create'])->name('hotel.create');
    Route::get('hotels',[App\Http\Controllers\Admin\HotelController::class,'index'])->name('hotel.index');
    Route::post('store-hotel-details',[App\Http\Controllers\Admin\HotelController::class,'store'])->name('hotel.store');
    Route::get('hotel/{hotel}/edit',[App\Http\Controllers\Admin\HotelController::class,'edit'])->name('hotel.edit');
    Route::put('hotel/{hotel}/update',[App\Http\Controllers\Admin\HotelController::class,'update'])->name('hotel.update');
    Route::get('hotel/{hotel}/delete',[App\Http\Controllers\Admin\HotelController::class,'destroy'])->name('hotel.destroy');

    Route::get('add-rooms',[App\Http\Controllers\Admin\RoomController::class,'create'])->name('rooms.create');
    Route::get('rooms',[App\Http\Controllers\Admin\RoomController::class,'index'])->name('rooms.index');
    Route::post('store-rooms-details',[App\Http\Controllers\Admin\RoomController::class,'store'])->name('rooms.store');
    Route::get('room-details/{room}/edit',[App\Http\Controllers\Admin\RoomController::class,'edit'])->name('rooms.edit');
    Route::put('room-details/{room}/update',[App\Http\Controllers\Admin\RoomController::class,'update'])->name('rooms.update');

    Route::get('bookings',[App\Http\Controllers\Admin\BookingController::class,'index'])->name('booking.index');
    Route::post('/booking/{booking}/check-in', [App\Http\Controllers\Admin\BookingController::class, 'checkIn'])->name('booking.check-in');
    Route::post('/booking/{booking}/check-out', [App\Http\Controllers\Admin\BookingController::class, 'checkOut'])->name('booking.check-out');

    Route::get('create-cities',[App\Http\Controllers\Admin\CityController::class,'create'])->name('cities.create');
    Route::get('cities',[App\Http\Controllers\Admin\CityController::class,'index'])->name('cities.index');
    Route::post('store-city-details',[App\Http\Controllers\Admin\CityController::class,'store'])->name('cities.store');
    Route::get('city/{city}/edit',[App\Http\Controllers\Admin\CityController::class,'edit'])->name('cities.edit');
    Route::put('city/{city}/update',[App\Http\Controllers\Admin\CityController::class,'update'])->name('cities.update');
    Route::get('city/{city}/delete',[App\Http\Controllers\Admin\CityController::class,'destroy'])->name('cities.destroy');
});
