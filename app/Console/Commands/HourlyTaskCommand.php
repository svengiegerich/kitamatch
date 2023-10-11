<?php

namespace App\Console\Commands;

use App\Http\Controllers\MatchingController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class HourlyTaskCommand extends Command
{
    protected $signature = 'hourly:task';
    protected $description = 'Run the hourly task';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $currentTime = now()->format('Y-m-d H:i:s');

        Log::info("Scheduling task started: " .$currentTime);
        
        app(MatchingController::class)->findMatchings();
        
        Log::info("Scheduling task executed successfully");
        $this->info('Hourly task executed successfully.');
    }
}
