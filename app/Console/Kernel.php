<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\DatetimeHelper;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class Kernel extends ConsoleKernel
{

    protected function schedule(Schedule $schedule)
    {
        $schedule->call(

          function(){

            $users = User::all();

            foreach ($users as $user ) {
              if($user->premium_date!=null || $user->premium_date!=""){

              $days = DatetimeHelper::premiumDays($user->premium_date);
              print_r($days);
              if( $user->is_premium="yes"){
                 if($days>30){
                     $user->is_premium="no";
                 }
                $user->premium_count=$days;
                $user->update();

                }}}
          }

          )->daily();
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
