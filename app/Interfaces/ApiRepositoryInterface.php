<?php

namespace App\Interfaces;

use App\Models\User;

interface ApiRepositoryInterface
{
    public function register(array $data);

    public function states();

    public function popular_cities();

    public function getrecommendedHotels();

    public function getPlacesByCity($cityId);

    public function room_booking(array $data);

    public function getbooked_rooms();

    public function cancelBooking($bookingId);

    public function getcancelledRooms();

    public function registerBussinessContact(array $data);

    public function storeBusinessProperty(array $data);

    public function businessPropertyEnquiry(array $data);

    public function registerAgent(array $data);

    public function loginAgent(array $credentials);

    public function registerWithReferral(array $data);

    public function getReferralDetails($user_id);
}
