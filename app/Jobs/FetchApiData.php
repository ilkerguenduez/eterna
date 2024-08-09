<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\ApiResponse;

class FetchApiData implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer token-here',
        ])->get('https://api.example.com/endpoint');

        if ($response->successful()) {
            ApiResponse::create([
                'response_data' => $response->json(),
            ]);
        } else {
        }



        $response2 = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer token-here',
        ])->get('https://api.example.com/endpoint');
        
        if ($response2->successful()) {
            $data = $response2->json();
        } else {
            $error = $response2->body();
        }



        $response3 = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer your-token-here',
        ])->post('https://api.example.com/endpoint', [
            'key1' => 'value1',
            'key2' => 'value2',
        ]);
        
        if ($response3->successful()) {
            $data = $response3->json();
        } else {
            $error = $response3->body();
        }


        foreach ($data as $item) {
            ApiResponse::create([
                'response_data' => $item
            ]);
        }

        $schedule->job(new FetchApiData)->everyFifteenMinutes();

        if ($response->header('Rate-Limit-Remaining') < 10) {
            sleep(100);
        }
    }
}
