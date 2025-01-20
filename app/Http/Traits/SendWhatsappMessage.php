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
            'device_id' => '6f799d04-9f4b-4b7d-b6fd-9fa20cef2f61',
            'to' => $phone_number,
            'message' => $messageBody, // Modify the message as needed
        ];
 

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url, $params);
        return $response->json();

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