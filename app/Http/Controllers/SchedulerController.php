<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;

class SchedulerController extends Controller
{
    public function startScheduler()
    {
        Artisan::call('schedule:run');
        return 'Scheduler started';
    }

    public function stopScheduler()
    {
        // You can stop the scheduler by manually disabling the cron job
        // Or by other means specific to your server environment
        return 'Scheduler stopped';
    }
}
