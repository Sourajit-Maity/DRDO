@extends('adminlte::page')
@include('layouts.lng')
@include('layouts.ring')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [

    
]])

<script>
      $(document).ready(function(){

        $(".time_wrap").hide();

        get_attendance_data();

        function get_attendance_data(){
          var url = 'get-attandance-all';
          $.ajax({
              type: "GET",
              url: url,
              success: function(data)
              {
                if(data.length>0){
                  var dat = JSON.parse(data);
                  var in_time = dat[0].in_time;
                  in_time = in_time.split(" ");
                  in_date = in_time[0].split("-");
                  in_time_split = in_time[1].split(":");

                  var hr = in_time_split[0];
                  var mn = in_time_split[1];
                  var sec = in_time_split[2];
                  mn = parseInt(mn)+30;
                  if(mn>60){
                    mn = mn-60;
                    hr = parseInt(hr)+1;
                  }
                  hr = parseInt(hr)+5;

                  var actual_date = in_date[1]+'/'+in_date[2]+'/'+in_date[0]+' '+hr+':'+mn+':'+sec;
                   
                  // alert(actual_date); 
                  $("#cin_submit").hide();

                  var hoursLabel = document.getElementById("hour");
                  var minutesLabel = document.getElementById("minute");
                  var secondsLabel = document.getElementById("second");

                  $(".time_wrap").show();
                    

                  setInterval(function(){ 
                    var start_date = new Date(actual_date);// Count up to this date
                    var current_date = new Date();
                    var totalSeconds =  (current_date - start_date)/1000;

                      hoursLabel.innerHTML = Math.floor(totalSeconds / 3600);
                      totalSeconds %= 3600;
                      minutesLabel.innerHTML = Math.floor(totalSeconds / 60);
                      secondsLabel.innerHTML = parseInt(totalSeconds % 60);
                    }, 1000);
                }

              }
            });
     
        }

        $("#attend_form").submit(function(e){
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            
            $.ajax({
              type: "POST",
              url: url,
              data: form.serialize(), // serializes the form's elements.
              success: function(data)
              {
                if(data==1){
                    get_attendance_data();
                    
                  }else{
                    alert("Please Try again!");
                  }
              }
            });
        });

      });
        
    </script> 
<div class="container">
<!-- <H2>Welcome To Dashboard</H2> -->
<img style="width:100% height:60%;" src="/images/drdo_logo_0.png" >
<br/><br/>


       
        <h1 class="display-4 text-center" style="font-size: 3.0rem">{{ __('lang.welcome', ['Name' => Auth::user()->name])}}</h1>
      
        <h4 class="display-4 text-center" style="font-size: 1.5rem">{{ __('lang.message')}}</h4>
        <br><br>
    
  
        <br><br>
    <div class="row justify-content-center">
        <div class="col-md-6 pull-left">
            <div class="card">
                
            
                <div class="card-body" style="min-height: 157px;">
                
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
  
                    @can('isSuperAdmin')
                        <div class="btn btn-success btn-lg">
                          You have Super Admin Access
                        </div>
                    @elsecan('isAdmin')
                        <div class="btn btn-primary btn-lg">
                          You have Admin Access
                        </div>
                    @elsecan('isClusterHead')
                        <div class="btn btn-primary btn-lg">
                          You have Cluster Head Access
                        </div>
                    @elsecan('isECRM')
                        <div class="btn btn-primary btn-lg">
                          You have ECRM Access
                        </div>
                    @elsecan('isBDM')
                        <div class="btn btn-primary btn-lg">
                          You have BDM Access
                        </div>
                    @elsecan('isTeamLeader')
                        <div class="btn btn-primary btn-lg">
                          You have Team Leader Access
                        </div>    
                    @else
                        <div class="btn btn-info btn-lg">
                          You have ACW Access
                        </div>
                    @endcan
                    
                    @if(Auth::user()->role=='1')
                      <h2>DRDO-CAS</h2>
                    @else

                      <h2> {{$employee->c_name}}</h2>
                     
                    @endif
  
                </div>

               

                
            </div>
        </div>

       
       
                  

        <div class="col-md-6 pull-left">
                <!-- USERS LIST -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Give Attendance</h3>

                    <div class="card-tools">
                      <span class="badge badge-info">Today-{!! \Carbon\Carbon::now()->format('d M Y') !!}</span>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                      
                    </div>
                  </div>
                  <!-- /.card-header --> 
           
								
                  <form method="POST" id="attend_form" action="daily-attandance-time">
                        @csrf

                        <div class="form-group row">
                            <label for="shift_id" class="col-md-4 col-form-label text-md-right">{{ __('Shift') }}</label>

                            <div class="col-md-6">
                               
                            <select  name="shift_id" id="shift_id" class="form-control @error('shift_id') is-invalid @enderror"  required autocomplete="shift_id">
                          
                            @foreach($shift as $shifts)
                                        <option value="{{$shifts->id}}">{{$shifts->name}}</option>
                                    @endforeach 
                              
                                                                            
                                                     
                             </select>
                                @error('shift_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         
                        <div id="cin_submit" class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                           
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Check In') }}
                                </button>
                              
                                
                                </div>  
                        </div>

                        <div class="time_wrap form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              Time
                              <span id="hour"></span> : 
                              <span id="minute"></span> : 
                              <span id="second"></span>

                              
                            </div>  
                        </div>
                       
                    </form>
               
                    
                   
                    
                   
                  <!-- /.card-footer -->
                </div>
                <!--/.card -->
              </div>
              <!-- /.col -->
    </div>
    <div class="clear"></div>
</div>


@if(Auth::user()->role=='1')
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$company}}</h3>

                <p>All Company</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ route('view-company') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <h3>{{$emp}}</h3>

                <p>View Employees</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ route('view-employee') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$user}}</h3>

                <p>All Complain</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('view-complain') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> 
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ Auth::user()->name }}</h3>

                <p>My Profile</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('add-info-tab') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          
          
</section>
@elseif(Auth::user()->role=='2')
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$company}}</h3>

                <p>All Company</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ route('view-company') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <h3>{{$emp}}</h3>

                <p>View Employees</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ route('view-employee') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$user}}</h3>

                <p>All Complain</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('view-complain') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> 
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ Auth::user()->name }}</h3>

                <p>My Profile</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('add-info-tab') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          
          
</section>
@endif


<br><br>




<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h2>Notification</h2>

                <p>
                @foreach (auth()->user()->unreadNotifications as $notification)
                        <div style="padding:5px;border-bottom:1px solid #bbb;">
                        {{$notification->data['data']}}
                        </div>
                     @endforeach
                     </p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <h2>Announcement</h2>

                <p>
                @auth
                     @foreach($announcementsArr as $announcement)
                        <div style="padding:5px;border-bottom:1px solid #bbb;">
                        {{ $announcement }}
                        </div>
                     @endforeach
                   @endauth</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h2>My Activity</h2>

                <p> <div style="padding:5px;border-bottom:1px solid #bbb;">
                        <a  href="{{ route('given-feedback') }}">View Given Feedback</a>
                        </div>
                        <div style="padding:5px;border-bottom:1px solid #bbb;">
                        <a  href="{{ route('given-complain') }}">View Given Complain</a>
                        </div>
                        <div style="padding:5px;border-bottom:1px solid #bbb;">
                        <a  href="{{ route('my-daily-report') }}">View Daily Report</a>
                        </div>
                        <div style="padding:5px;border-bottom:1px solid #bbb;">
                        <a  href="{{ route('my-training') }}">View Training</a>
                        </div>
                        <div style="padding:5px;border-bottom:1px solid #bbb;">
                        <a href="{{ route('my-exam-score') }}">View Exam Score</a>
                        </div></p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> 
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h2>Pending Task</h2>

                  <p> 
                   <div style="padding:5px;border-bottom:1px solid #bbb;">
                        <a  href="{{ route('my-attandance-checkout') }}">Check out</a>
                        </div>
                        <div style="padding:5px;border-bottom:1px solid #bbb;">
                        <a  href="{{ route('add-daily-report') }}">Your Daily Report</a>
                        </div>
                        @if(Auth::user()->role=='1' || Auth::user()->role=='2' || Auth::user()->role=='3'|| Auth::user()->role=='4')
                        <div style="padding:5px;border-bottom:1px solid #bbb;">
                        <a  href="{{ route('leave') }}">Leave Approve</a>
                        </div>
                        @endif
                     </p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
  
</section>
@if(Auth::user()->role=='1')
<div class="col-md-6 pull-left">
                <!-- USERS LIST -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Latest Employees</h3>

                    <div class="card-tools">
                      <span class="badge badge-info">4 New Members</span>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">
                      @foreach($newemployee as $newemployees)
                      <li>
                        
                        @if($newemployees->emp_img =='0') 
                        <img src="assets/images/dummy.png" alt="User Image">
                        @else  
                        <img src="{{url('assets/images')}}/{{$newemployees->emp_img}}" alt="User Image">
                        @endif 
                        <a class="users-list-name" href="#">{{$newemployees->emp_nick_name}}</a>
                        <span class="users-list-date">{{$newemployees->c_name}}</span>
                        <span class="users-list-date">{!! \Carbon\Carbon::parse($newemployees->created_at)->format('d M Y') !!}</span>
                      </li>
                     @endforeach
                    </ul>
                    <!-- /.users-list -->
                  </div>
                 
                  <!-- /.card-footer -->
                </div>
                <!--/.card -->
              </div>
              <!-- /.col -->
            </div>
            @else
            <div id="app">
        @include('layouts.flash-message')


        @yield('content')
      </div>
            
              @endif
     
            <div class="clear"></div>
            </div>

 

            







@include('footerimport')
@endsection

@section('scripts')
@parent
@if(Auth::user()->role=='1')
    <script>
    function sendMarkRequest(id = null) {
        return $.ajax("{{ route('mark-as-read') }}", {
            method: 'POST',
            data: {
                _token,
                id
            }
        });
    }

    $(function() {
        $('.mark-as-read').click(function() {
            let request = sendMarkRequest($(this).data('id'));

            request.done(() => {
                $(this).parents('div.alert').remove();
            });
        });

        $('#mark-all').click(function() {
            let request = sendMarkRequest();

            request.done(() => {
                $('div.alert').remove();
            })
        });
    });
    </script>
   
@endif
@endsection

