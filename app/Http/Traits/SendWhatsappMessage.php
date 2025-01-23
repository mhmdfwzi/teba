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
            'device_id' => 'a7db995b-ec9b-4fab-90f4-e64b42696d3d',
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