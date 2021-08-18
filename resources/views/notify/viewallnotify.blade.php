@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Notification' => route('view-all-notification'),

]])
@section('plugins.Datatables', true)
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>All Notification</h2>
            </div>
            
            
        </div>
        @if(Auth::user()->role=='1')
                        @forelse($notifications as $notification)
                            <div class="alert alert-success" role="alert">
                            @if($notification->type == 'App\Notifications\JoiningNotification')
                            New User  ({{ $notification->data['data'] }}) has just registered on [{!! \Carbon\Carbon::parse($notification->created_at)->format('d M Y') !!}]
                            @elseif($notification->type == 'App\Notifications\ComplainNotification')  
                             Employee Complain Received on [{!! \Carbon\Carbon::parse($notification->created_at)->format('d M Y') !!}]
                             @elseif($notification->type == 'App\Notifications\AssetsNotification')  
                             Assets Given to Employee Succesfully on [{!! \Carbon\Carbon::parse($notification->created_at)->format('d M Y') !!}]
                             @elseif($notification->type == 'App\Notifications\AssetsReturnNotification')  
                             Assets Return from Employee Succesfully on [{!! \Carbon\Carbon::parse($notification->created_at)->format('d M Y') !!}]
                             @elseif($notification->type == 'App\Notifications\LeaveNotification')  
                              Employee Apply for Leave Request on [{!! \Carbon\Carbon::parse($notification->created_at)->format('d M Y') !!}]
                             @elseif($notification->type == 'App\Notifications\TaskCompleted')  
                             Feedback from Employee Received on [{!! \Carbon\Carbon::parse($notification->created_at)->format('d M Y') !!}]
                             @else
                             New Notification Received
                             @endif   
                               
                            </div> 

                           
                        @empty
                            There are no new notifications
                        @endforelse
                    @else
                        You are logged in!
                    @endif
        </div>
    </div>
    @include('footerimport')
    @include('datatable')
    @endsection
  
