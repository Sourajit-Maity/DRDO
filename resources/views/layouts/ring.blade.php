@section('content_top_nav_right')
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{auth()->user()->unreadNotifications->count()}}</span>
        </a>
        @foreach (auth()->user()->notifications as $notification)
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <span class="dropdown-item dropdown-header">{{$notification->data['data']}}</span>
          <div class="dropdown-divider"></div>
          
         
          <div class="dropdown-divider"></div>
          <a href="{{ route('view-new-notification') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
        @endforeach
    </li>
@endsection 