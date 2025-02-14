<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\SMSRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SMSController extends Controller
{
    protected $smsRepository;

    public function __construct(SMSRepositoryInterface $smsRepository)
    {
        $this->smsRepository = $smsRepository;
    }

    /**
     * Send OTP to a phone number
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendOtp(Request $request)
    {
        // Validate request
        $request->validate([
            'phone_number' => 'required', // Ensure valid phone number format
        ]);

        // Generate 6-digit OTP
        $otp = rand(100000, 999999);

        // Send OTP via Twilio
        $message = $this->smsRepository->sendOtp($request->phone_number, $otp);

        //dd($message);

        // Response based on message status
        if ($message) {
            return response()->json([
                'status' => 'success',
                'message' => 'OTP sent successfully.',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send OTP. Please try again.',
            ], 500);
        }
    }

    /**
     * Verify OTP for a phone number
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
            'otp' => 'required|digits:6',
        ]);

        // Retrieve stored OTP from cache
        $storedOtp = Cache::get('otp_' . $request->phone_number);

        if ($storedOtp && $storedOtp == $request->otp) {
            // OTP is valid, clear it from cache
            Cache::forget('otp_' . $request->phone_number);

            return response()->json([
                'status' => 'success',
                'message' => 'OTP verified successfully.',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid OTP. Please try again.',
            ], 400);
        }
    }

}
