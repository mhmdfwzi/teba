<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

trait SendVerifications
{
    public function sendOTP($phone_number)
    {
        // Step 1: Generate the OTP (you can use any method to generate the OTP)
        $otp = mt_rand(100000, 999999);

        // Step 2: Store the OTP in the session (for temporary storage)
        Session::put('phone_otp', $otp);

        // dd($phone_number ,$otp);

        $url = 'https://server.rhmany.com/api/send/message';
        $params = [
            'device_id' => 'a434a3a7-9280-4810-b538-005b38a02c14',
            'to' => $phone_number,
            'message' => 'كود تفعيل الحساب: ' . $otp . ' TebaOptics نسعد بخدمتك', // Modify the message as needed
        ];

        $response = Http::post($url, $params);

        // Check if the request was successful
        if ($response->successful()) {
            // OTP sent successfully

            return true;
        } else {
            // Failed to send OTP

            return false;
        }
    }
}