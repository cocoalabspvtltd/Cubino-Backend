<?php

namespace App\Interfaces;

interface SMSRepositoryInterface
{
    public function sendOtp(string $phoneNumber);

    public function verifyOtp(string $phoneNumber, string $otp);
}
