<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\UpdateUsersonline as NotificationsUpdateUsersonline;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;

class UpdateUsersonline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:online';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   $users=[];
        $allusers=User::all();
        foreach($allusers as $item){
            if(Cache::has('user-is-online-' . $item->id)){
                $users[]=User::find($item->id);
            }
        }
                    
        Notification::send($users, new NotificationsUpdateUsersonline());
       

        return Command::SUCCESS;
    }
}
