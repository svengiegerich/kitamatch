<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class MatchingConfigChangeListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // Query the matching_configs table to get the isMatchingRunning value
        $isMatchingRunning = DB::table('matching_configs')
            ->where('config_name', '=', 'isMatchingRunning')
            ->where('value', 'True')
            ->exists();

        if ($isMatchingRunning) {

            Log::info('Dispatching reloadPage event...');
          //  Event::dispatch('databaseConfigChange');
             echo '<script>window.location.reload(true);</script>';
            Log::info('reloadPage event dispatched');

        } else {
            // If isMatchingRunning is false, do nothing
            Log::info('Matching is not running. No action taken.');
        }
    }
}
