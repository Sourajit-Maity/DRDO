<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User; 
use App\Notifications\JoiningNotification;
use Illuminate\Support\Facades\Notification;


class SendNewUserNotification
{
    
   
    public function handle($event)
    {
        //$admins = User::whereHas('roles', function ($query) {
            //$query->where('id', 1);
       // })->get();

     //  $user = User::find(1);

   // User::find(1)->notify(new TaskCompleted($user));

        $admins = User::find(1);

        Notification::send($admins, new JoiningNotification($event->user)); 
    }
}
