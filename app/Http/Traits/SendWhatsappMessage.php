<?php

namespace App\Http\Traits;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

trait sendWhatsAppMessage
{
    public function sendMessage($phone_number,$messageBody)
    {


        $url = 'https://server.rhmany.com/api/send/message';
        $params = [
            'device_id' => 'a434a3a7-9280-4810-b538-005b38a02c14',
            'to' => $phone_number,
            'message' =>  $messageBody, // Modify the message as needed
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