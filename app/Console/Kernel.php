<?php

namespace App\Console;

use App\Helpers\Helper;
use App\Models\Chapter;
use App\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;

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
        //00 06 * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
        //00 06 * * * cd /var/www/html/autodeploy/yamato/current && php artisan schedule:run >> /dev/null 2>&1
        $schedule->call(function () {
            echo "START PROCESS SCHEDULE"."\n";
            $total_user = User::where('block',0)->count();
            $limit = 10;
            $skip = 0;
            // send message to all users
            while($skip < $total_user){
                $users = User::where('block',0)->skip($skip)->take($limit)->get();
                $skip += $limit;
                // send message to users
                foreach ($users as $user){
                    // check have new chapter or not
                    if(isset($user->user_notifies) && sizeof($user->user_notifies)){
                        $current_day = \Carbon\Carbon::createFromFormat("Y-m-d",$user->register_date)->diffInDays(\Carbon\Carbon::now()) + 1;
                        $chapter = Chapter::where('day', $current_day)->where('public', 1)->whereHas('book', function ($q) {
                            $q->where('public', 1);
                        })->first();
                        // send notify chapter
                        if($chapter && isset($chapter->book->public) && $chapter->book->public){
                            foreach ($user->user_notifies as $user_notify){
                                $data = [
                                    'tokens' => $user_notify->token,
                                    'message' => $chapter->book->name.'第'.$chapter->name.'が解放されました！',
                                ];
                                echo "USER ID: $user->id\n";
                                echo "CURRENT DAY: $current_day\n";
                                echo $data['message']."\n";
                                echo Helper::pushNotify($data);
                                echo "\n";
                            }
                        }
                    }
                }
            }
        });
        // $schedule->command('inspire')->hourly();
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
