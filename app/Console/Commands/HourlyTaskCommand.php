<?php

namespace App\Console\Commands;

use App\Http\Controllers\MatchingController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class HourlyTaskCommand extends Command
{
    protected $signature = 'schedule:run';
    protected $description = 'Running scheduled task';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $currentTime = now()->format('Y-m-d H:i:s');

        Log::info("Scheduling task started: " .$currentTime);
        
        app(MatchingController::class)->findMatchings();
        
        Log::info("Scheduled task executed successfully");
        $this->info('Scheduled task executed successfully.');
    }
}
