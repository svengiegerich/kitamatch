<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SSEController extends Controller
{
    public function listen(Request $request) {

        Log::info('SSE connection established.');

        print_r("is it working!!!");
        var_dump("test test");

        // Set headers for SSE
        $response = new Response();
//        $response->headers->set('Content-Type', 'text/event-stream');
//        $response->headers->set('Cache-Control', 'no-cache');
//        $response->headers->set('Connection', 'keep-alive');
//        $response->headers->set('X-Accel-Buffering', 'no');

        // Send an SSE event to the client
        while (true) {
            $flag = DB::table('matching_configs')->select('isMatchingRunning')->first();

            if ($flag->isMatchingRunning) {
                $sseData = [
                    'event' => 'reload', // Event type
                    'data' => json_encode(['message' => 'Reload requested']),
                ];

                $response->write('event: ' . $sseData['event'] . "\n");
                $response->write('data: ' . $sseData['data'] . "\n\n");
                $response->send();

                // Clear the flag in the database
               // DB::table('your_table')->update(['isButtonClick' => false]);
            }

            // Adjust the sleep duration to control how often you check the database
            sleep(5);
        }

        return $response;
    }
}