@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Leave' => route('leave'),

]])

    <div id="main-wrapper">
    
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Leave Management</h4>
                        <div class="ml-auto text-right">
                            
                        </div>
                    </div>
                </div>
            </div>

           
                <div class="row">
                    <div class="col-md-2">
                        @can('isEmployee')
                        <a class="btn btn-lg btn-dark" href="{{route('leave.create')}}">Apply leave</a>
                        @endcan
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                               
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            
                                            <th>Employee Name <p>(नाम)</p></th>
                                            <th>Leave type <p>(छोड़ें प्रकार)</p></th>
                                            <th>Date from<p>(तारीख से)</p></th>
                                            <th>Date to <p>(की तारीख)</p></th>
                                            <th>No. of days <p>(दिनों की संख्या)</p></th>
                                            <th>Reason <p>(कारण)</p></th>
                                            <th>Action <p>(कार्य)</p> </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($leaves as $leave)
                                            <tr>
                                               
                                                <td>{{$leave->emp_nick_name}}</td>
                                                <td>{{$leave->name}}</td>
                                                <td>{{$leave->date_from}}</td>
                                                <td>{{$leave->date_to}}</td>
                                                <td>{{$leave->days}}</td>
                                                <td>{{$leave->reason}}</td>
                                                <td> 
									   <a href="{{ route('view-leave-details',[$leave->id]) }}" class="btn btn-xs btn-success">
                                       <i class="far fa-eye"></i></a>   

									  </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                               
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('footerimport')

     @endsection
     <style>
     th,th p {text-align: center !important;}
     </style>
