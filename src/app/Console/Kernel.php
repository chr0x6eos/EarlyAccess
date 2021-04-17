<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Delete messages after a minute
        $schedule->call(function () {
            DB::table('messages')
                ->where('created_at', '<=', Carbon::now()->subMinutes(1))
                ->where('read', 1) # Only delete read messages
                ->delete();
        })->everyMinute();

        // Delete users after an hour (check each 5 minutes)
        $schedule->call(function () {
            DB::table('users')
                ->where('created_at', '<=', Carbon::now()->subHour(1))
                ->where('role', '!=', 'admin')
                ->delete();
        })->everyFiveMinutes();

        // Reset admin password if changed
        $schedule->call(function () {
            // Update admin user or re-create it, if deleted
            DB::table('users')
                ->updateOrInsert(
                    [
                        'name' => 'admin',
                        'email' => 'admin@earlyaccess.htb',
                        'role' => 'admin'
                    ],
                    ['password' => bcrypt(env('ADMIN_PW'))]
                );
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
