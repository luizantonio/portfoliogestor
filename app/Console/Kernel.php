<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use  \App\Console\Commands\SendEmails;
use Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        \App\Console\Commands\SendEmails::class,
		Commands\SendEmails::class,

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

		 //$schedule->command('inspire')->hourly();
		 //$schedule->command('test')->cron('*/5 * * * *');
		 //$schedule->command(SendEmails::class, ['--force'])->everyFiveMinutes();


		 //Log::info('1');
        //$schedule->call(function () {
           // $user = User::find(1);
            //$user->name = 'cron...';
        //})->everyMinute();


		// $test = new SendEmails();
	
		 //$schedule->call(function () {
         //  $test = new SendEmails->handle();
        //})->hourly();
		
		
		 
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
