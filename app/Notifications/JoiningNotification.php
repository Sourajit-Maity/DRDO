<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class JoiningNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $user; 
  
    public function __construct(User $user)
    {
        $this->user = $user;
    }

   
    public function via($notifiable)
    {
        return ['database'];
    }

  
    public function toArray($notifiable)
    {
        return [
           
            'data' => $this->user->name,
            
        ];
    }
}
