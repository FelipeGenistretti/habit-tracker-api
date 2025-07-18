<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\WeeklyReport; 
use Illuminate\Console\Command;

class WeeklyReportCommand extends Command
{
    protected $signature = 'report:weekly';
    protected $description = 'manda uma report weekly p usuario';

    public function handle()
    {
        echo "weekly report send to the user" . PHP_EOL;

        $user = User::first();

        $user->notify(new WeeklyReport()); 
    }
}
