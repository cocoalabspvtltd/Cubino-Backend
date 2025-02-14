<?php

use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\SMSController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register',[ApiController::class,'register']);

Route::post('/register-with-referral', [ApiController::class, 'registerWithReferral']);

Route::post('/login',[ApiController::class,'sendOtp']);

Route::post('/verify-otp', [ApiController::class, 'verifyOtp']);

Route::get('states',[ApiController::class,'getStates']);

Route::get('popular-cities',[ApiController::class,'getPopularCities']);

Route::get('/places/{cityId}', [ApiController::class, 'getPlacesByCity']);

Route::get('hotel-rooms', [ApiController::class, 'fetchRooms']);

Route::post('register/bussiness-contact',[ApiController::class,'bussiness_contact']);

Route::post('register/agent',[ApiController::class,'travelAgentRegistration']);

Route::post('/agent/login',[ApiController::class,'agentSignIn']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout',[ApiController::class,'logout']);

    Route::get('/recommended-hotels', [ApiController::class, 'recommendedHotels']);

    Route::post('/room-booking',[ApiController::class,'book_room']);

    Route::get('/booked-rooms',[ApiController::class,'bookedRooms']);

    Route::delete('/booking/cancel/{bookingId}', [ApiController::class, 'cancelBooking']);

    Route::get('/cancelled-rooms',[ApiController::class,'cancelledRooms']);

    Route::post('/register/property',[ApiController::class,'listProperty']);

    Route::get('/referral-details/{user_id}', [ApiController::class, 'referralDetails']);


});
