<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\ApiResponse;

class ApiDataController extends Controller
{
    public function fetchData(){

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer your-token-here',
        ])->get('https://api.example.com/endpoint');

        if ($response->successful()) {
            $data = $response->json(); 

            foreach ($data as $item) {
                ApiResponse::create([
                    'response_data' => $item, 
                ]);
            }

            return response()->json(['message' => 'Data saved successfully'], 200);
        } else {
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }


        foreach ($data as $item) {
            ApiResponse::create([
                'response_data' => json_encode([
                    'key1' => $item['key1'],
                    'key2' => $item['key2'],
                ]),
            ]);
        }
    }
}
