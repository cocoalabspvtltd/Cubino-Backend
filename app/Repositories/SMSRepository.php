<?php

namespace App\Repositories;

use App\Interfaces\SMSRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class SMSRepository implements SMSRepositoryInterface
{
    protected $twilio;

    public function __construct()
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $this->twilio = new Client($sid, $token);
    }


    /**
     * Send OTP via Twilio
     *
     * @param string $phoneNumber
     * @param string $otp
     * @return mixed
     */
    public function sendOtp(string $phoneNumber)
    {
        try {
            $otp = rand(1000, 9999); // Generate 4-digit OTP

            // Send SMS via Twilio
            $this->twilio->messages->create(
                $phoneNumber,
                [
                    'from' => env('TWILIO_PHONE_NUMBER'),
                    'body' => "Your OTP code is: $otp"
                ]
            );

            // Store OTP in cache with 5-minute expiration
            Cache::put('otp_' . $phoneNumber, $otp, now()->addMinutes(5));

            return response()->json(['status_code' => 200,'success' => true, 'message' => 'OTP sent successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function verifyOtp(string $phoneNumber, string $otp)
    {
        $cachedOtp = Cache::get('otp_' . $phoneNumber);

        if (!$cachedOtp || $cachedOtp != $otp) {
            return response()->json(['error' => 'Invalid or expired OTP.'], 400);
        }

        // Clear OTP after successful validation
        Cache::forget('otp_' . $phoneNumber);

        // Find or create user by phone number
        $user = User::firstOrCreate(['phone_number' => $phoneNumber]);

        // Generate token
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'status_code' => 200,
            'success' => true,
            'message' => 'Verified successfully.',
            'user_details' => $user,
            'token' => $token
        ]);
    }
}
