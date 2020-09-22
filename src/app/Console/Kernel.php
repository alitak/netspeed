<?php

namespace App\Console;

use App\Console\Commands\StoreSpeedtestCommand;
use App\Console\Commands\StorePingDataCommand;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        StorePingDataCommand::class,
        StoreSpeedtestCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->exec('cd /var/www && sh app/Libraries/ping.sh 8.8.8.8')->everyMinute();
        $schedule->exec('cd /var/www && sh app/Libraries/speedtest.sh')->everyMinute();
    }
}
