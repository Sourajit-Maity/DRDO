@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Leave Travel Concession' => route('view-leave-travel-apply'),

]])

    <div id="main-wrapper">
    
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Leave Travel Concession Management</h4>
                        <div class="ml-auto text-right">
                            
                        </div>
                    </div>
                </div>
            </div>

           
                <div class="row">
                    <div class="col-md-2">
                        @can('isEmployee')
                        <a class="btn btn-lg btn-dark" href="{{route('add-ltc-member')}}">Add Member</a>
                        @endcan
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                               
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Sl.No.<p>(क्रमांक</p></th>
                                            <th>LTC Application Id<p>(एलटीसी आवेदन आईडी)</p></th>
                                            <th>Employee Name<p>(कर्मचारी का नाम)</p></th>
                                            <th>Leave type<p>(छुट्टी का प्रकार)</p></th>
                                            <th>Date from<p>(तारीख से)</p></th>
                                            <th>Date to<p>(की तारीख)</p></th>
                                            <th>No. of days<p>(दिनों की संख्या)</p></th>
                                            <th>Reason<p>(कारण)</p></th>
                                            <th>Add Member<p>(सदस्य जोड़ें)</p></th>
                                            <th>Leave Travel Details<p>(यात्रा विवरण)</p></th>
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($leaves as $leave)
                                            <tr>
                                                <td>{{$loop -> index+1 }}</td>
                                                <td>{{$leave->id}}</td>
                                                <td>{{$leave->emp_nick_name}}</td>
                                                <td>{{$leave->leave_travel_concession}}</td>
                                                <td>{{$leave->date_from}}</td>
                                                <td>{{$leave->date_to}}</td>
                                                <td>{{$leave->days}}</td>
                                                <td>{{$leave->reason}}</td>
                                                <td> 
                                                    @if(Auth::user()->role=='1')
                                                        <a href="{{ route('view-ltc-member',[$leave->id]) }}" class="btn btn-xs btn-info">
                                                        <i class="fas fa-plus-square"></i>Member</a>  
                                                    @else
                                                        <a href="{{ route('add-ltc-member',[$leave->id]) }}" class="btn btn-xs btn-info">
                                                        <i class="fas fa-plus-square"></i>Member</a>  
                                                </td>
									                @endif
                                                    <td> 
                                                     <a href="{{ route('view-leave-travel-apply-details',[$leave->id]) }}" class="btn btn-xs btn-info">Leave</a>  
                                                       
                                                   
                                                   </td>
									               
                                               
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                    {{ $leaves->links() }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('footerimport')
         
            
        </div>
    </div>

@endsection
     <style>
     th,th p {text-align: center !important;}
     </style>