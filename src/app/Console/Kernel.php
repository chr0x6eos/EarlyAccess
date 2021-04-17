<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
        // Reset admin password if changed
        $schedule->call(function () {
            $user = User::where('name','admin')->first();

            // Check if admin exists
            if($user)
            {
                // Check if password changed
                if(!Hash::check(env('ADMIN_PW'), $user->password))
                {
                    $user->password = bcrypt(env('ADMIN_PW'));
                    $user->save();
                }
            }
            else
            {
                User::create([
                    'name' => 'admin',
                    'email' => 'admin@earlyaccess.htb',
                    'password' => bcrypt(env('ADMIN_PW')),
                    'role' => 'admin',
                ]);
            }
        })->everyMinute();

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
