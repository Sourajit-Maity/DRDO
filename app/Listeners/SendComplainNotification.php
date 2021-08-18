<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User; 
use App\Models\Complain; 
use App\Notifications\ComplainNotification;
use Illuminate\Support\Facades\Notification;

class SendComplainNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() 
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $admins = User::find(1);

        Notification::send($admins, new ComplainNotification($event->user)); 
    }
}
