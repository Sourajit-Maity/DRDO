<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewNotificationController extends Controller
{
    public function viewallnotification(Request $request)
    {
 
     
        $notifications = auth()->user()->readNotifications;
 
       return view('notify.viewallnotify',compact('notifications',));
    } 

    public function viewnewnotification(Request $request)
    {
 
     
        $notifications = auth()->user()->unreadNotifications;
 
       return view('notify.viewnewnotify',compact('notifications',));
    } 
}
