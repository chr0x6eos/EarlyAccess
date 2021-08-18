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
                // Check if username has changed
                if($user->name != "admin")
                {
                    $user->name = "admin";
                    $user->save();
                }
                // Check if email has changed
                if($user->email != "admin@earlyaccess.htb")
                {
                    $user->email = "admin@earlyaccess.htb";
                    $user->save();
                }
                // Check if password has changed
                if(sha1(env('ADMIN_PW')) !== $user->password) //if(!Hash::check(env('ADMIN_PW'), $user->password))
                {
                    $user->password = sha1(env('ADMIN_PW')); //bcrypt(env('ADMIN_PW'));
                    $user->save();
                }
            }
            else
            {
                // Create admin user, if deleted
                User::create([
                    'name' => 'admin',
                    'email' => 'admin@earlyaccess.htb',
                    'password' => sha1(env('ADMIN_PW')), //bcrypt(env('ADMIN_PW')),
                    'role' => 'admin',
                ]);
            }
        })->everyMinute();

        // Delete messages after a minute, if read
        $schedule->call(function () {
            DB::table('messages')
                ->where('created_at', '<=', Carbon::now()->subMinutes(1))
                ->where('read', 1) # Only delete read messages
                ->delete();
        })->everyMinute();

        // Delete unread messages after an hour (check every 10 minutes)
        $schedule->call(function () {
            DB::table('messages')
                ->where('created_at', '<=', Carbon::now()->subHour(1))
                ->delete();
        })->everyTenMinutes();

        // Delete users after 6 hours (check every hour)
        $schedule->call(function () {
            DB::table('users')
                ->where('created_at', '<=', Carbon::now()->subHour(6))
                ->where('role', '!=', 'admin')
                ->where('name', '!=', 'chronos')
                ->delete();
        })->hourly();

        // Deletes failed_logins that are older than 2 minutes (check every minute)
        $schedule->call(function () {
            DB::table('failed_logins')
                ->where('time', '<=', Carbon::now()->subMinutes(2))
                ->delete();
        })->everyMinute();

        // Delete scoreboard entries every 12hrs to cleanup (check every hour)
        /*$schedule->call(function () {
            DB::table('scoreboard')
                ->where('time', '<=', Carbon::now()->subHour(12))
                ->delete();
        })->hourly();*/
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
