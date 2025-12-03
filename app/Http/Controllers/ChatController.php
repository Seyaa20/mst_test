<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');

        $client = new \GuzzleHttp\Client();

        $response = $client->post('https://openrouter.ai/api/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'user', 'content' => $message]
                ]
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        $reply = $data['choices'][0]['message']['content'] ?? 'No reply';

        return response()->json([
            'reply' => $reply
        ]);
    }

}
