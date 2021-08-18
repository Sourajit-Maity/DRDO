@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Leave' => route('leave'),
    
    'Leave Application Details' => '#',

]])



    <div class="page-wrapper">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    @endif
    <div class="container">
    <div class="row justify-content-center"> 
        <div class="col-md-12">
            <div class="card">
               
                <div class="card-header">{{ __('Employee Details') }}</div>
                <form action="#" method="post" class="form-horizontal">
                            @csrf
                <div class="card-body">

                <div class="form-group row">
                            <label for="designation_id" class="col-md-3 col-form-label text-md-right size">{{ __('Designation/पदनाम') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                            <input id="designation_id" type="text" class="form-control @error('designation_id') is-invalid @enderror" name="display_name" value="{{ $leave->display_name }}" required autocomplete="designation_id" readonly>

                                @error('designation_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                            <label for="emp_id" class="col-md-3 col-form-label text-md-right size">{{ __('Name/नाम') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="emp_nick_name" type="text" class="form-control @error('emp_nick_name') is-invalid @enderror" name="emp_nick_name" value="{{ $leave->emp_nick_name }}" required autocomplete="emp_nick_name" readonly>

                                @error('emp_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="employee_type" class="col-md-3 col-form-label text-md-righ size">{{ __('Employee Type/कर्मचारी का प्रकार') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="employee_type" type="text" class="form-control @error('employee_type') is-invalid @enderror" name="emp_type_name" value="{{ $leave->emp_type_name }}" required autocomplete="employee_type" readonly>
                                <input id="employee_type" type="hidden" class="form-control @error('employee_type') is-invalid @enderror" name="employee_type" value="{{ $leave->emp_status }}" required autocomplete="employee_type" readonly>

                                @error('employee_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          

                            <label for="dept_id" class="col-md-3 col-form-label text-md-right size">{{ __('Department/विभाग') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="d_name" type="text" class="form-control @error('d_name') is-invalid @enderror" name="d_name" value="{{ $leave->d_name }}" required autocomplete="d_name" readonly>

                                @error('dept_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dept_phone_no" class="col-md-3 col-form-label text-md-right size">{{ __('Departmemnt Phone No/विभागीय फोन नंबर') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="dept_phone_no" type="text" class="form-control @error('dept_phone_no') is-invalid @enderror" name="dept_phone_no" value="{{ $leave->dept_phone_no }}" required autocomplete="dept_phone_no" readonly>

                                @error('dept_phone_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          

                            <label for="phone_no" class="col-md-3 col-form-label text-md-right size">{{ __('Phone No/फोन नंबर') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror only-numeric" value="{{ $leave->phone_no }}" name="phone_no"  required autocomplete="phone_no" readonly>
                               
                                @error('phone_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                      

                </div>
            </div>
        </div>
    </div>
</div>
                     

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">{{ __('Apply Leave') }}</div>
                <div class="card-body">
                            
   
                        <div class="form-group row">
                            <label for="date_from" class="col-md-3 col-form-label text-md-right size">{{ __('Date from/तारीख से') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="FromDate" type="date" min="{{date('Y-m-d')}}" name="date_from" class="form-control @error('date_from') is-invalid @enderror" name="date_from" value="{{ $leave->date_from }}" required autocomplete="date_from" readonly>

                                @error('date_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          

                            <label for="date_to" class="col-md-3 col-form-label text-md-right size">{{ __('Date to/की तारीख') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="ToDate" type="date"  name="date_to" class="form-control @error('date_to') is-invalid @enderror"  required autocomplete="date_to" value="{{ $leave->date_to }}" readonly >
                               
                                @error('date_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                                <div class="form-group row">
                                    <label for="leave_type" class="col-md-3 col-form-label text-md-right size">{{ __('Leave Type/छुट्टी का प्रकार') }}<span style="color:red"> *</span></label>

                                    <div class="col-md-3">
                                    <input id="leave_type" type="text"  name="leave_type" class="form-control @error('leave_type') is-invalid @enderror"  required autocomplete="leave_type" value="{{ $leave->leave_name }}" readonly >

                                    @error('leave_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                          

                                <label for="days" class="col-md-3 col-form-label text-md-right size" >{{ __('Days/कुल छुट्टी के दिन') }}<span style="color:red"> *</span></label>

                                <div class="col-md-3">
                                <input type="text" name="days" class="form-control" id="TotalDays" value="{{ $leave->days }}" placeholder="Number of leave days" readonly>
                                
                                    @error('leave_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group row">
                           <label for="reason" class="col-md-3 col-form-label text-md-right size">{{ __('Reason/कारण') }}<span style="color:red"> *</span></label>
                                    <div class="col-md-3">
                                    <input id="reason" type="text" value="{{ $leave->reason }}" class="form-control @error('reason') is-invalid @enderror" name="reason"  required autocomplete="reason" readonly>

                                        </div>
                                        <label for="personal_id"  class="col-md-3 col-form-label text-md-right size">{{ __('Personal Id No/व्यक्तिगत पहचान संख्या') }}</label>

                                        <div class="col-md-3">
                                            <input id="personal_id" value="{{ $leave->personal_id }}" type="text" class="form-control" name="personal_id" readonly>

                                        </div>
                                </div>
                         <div class="form-group row">
                            <label for="sunday_holiday" class="col-md-3 col-form-label text-md-right size a">{{ __('Sunday & Holidays to be prefixed and suffixed/रविवार और छुट्टियों को उपसर्ग और प्रत्यय लगाया जाना चाहिए') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="sunday_holiday" type="text" value="{{ $leave->sunday_holiday }}" class="form-control @error('sunday_holiday') is-invalid @enderror" name="sunday_holiday"  required autocomplete="sunday_holiday" readonly>

                                @error('sunday_holiday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          

                            <label for="leave_address" class="col-md-3 col-form-label text-md-right size">{{ __('Leave Address/पता जब छुट्टी में हो') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="leave_address" type="text" value="{{ $leave->leave_address }}" class="form-control @error('leave_address') is-invalid @enderror" name="leave_address"  required autocomplete="leave_address" readonly>
                               
                                @error('leave_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                          
                            <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                               
                                
                                <a href="{{ route('leave') }}" class="btn btn-danger">
                                   Back</a>
                            </div>
                        </div>

                       
                            
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       

    </div>

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __(' Approval') }}</div>

                <div class="card-body">

                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                           
                                        <th> Director Approval</th>
                                            <th> Admin Approval</th>
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
  
                                            <tr>
                                                
                                                
                                            
                                            <td>
                                                    @if(Auth::user()->role=='1')
                                                        {{--{{$leave->is_approved}}--}}
                                                        @if($leave->leave_type_offer==0)
                                                            <form id="{{$leave->id}}" action="{{route('leave.paid',$leave->id)}}" method="POST">
                                                                @csrf
                                                                {{--<button type="button" onclick="approveLeave({{$leave->id}})" class="btn btn-sm btn-success" name="approve" value="1">Approve</button>--}}
                                                                <button type="submit" onclick="return confirm('Are you sure want to approve for leave?')" class="btn btn-sm btn-success" name="paid" value="1">Approve</button>
                                                            </form>
                                                            <form id="{{$leave->id}}" action="{{route('leave.paid',$leave->id)}}" method="POST">
                                                                @csrf
                                                                {{--<button type="button" onclick="rejectLeave({{$leave->id}})" class="btn btn-sm btn-danger" name="approve" value="2">Reject</button>--}}
                                                                <button type="submit" onclick="return confirm('Are you sure want to reject for leave?')" class="btn btn-sm btn-danger" name="paid" value="2">Reject</button>
                                                            </form>
                                                        @elseif($leave->leave_type_offer==1)

                                                            <form action="{{route('leave.paid',$leave->id)}}" method="POST">
                                                                @csrf
                                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to reject for leave?')" type="submit" name="paid" value="2">Reject</button>
                                                            </form>
                                                        @else
                                                            <form action="{{route('leave.paid',$leave->id)}}" method="POST">
                                                                @csrf
                                                                <button class="btn btn-sm btn-success" onclick="return confirm('Are you sure want to approve for leave?')" type="submit" name="paid" value="1">Approve</button>
                                                            </form>
                                                        @endif

                                                        {{--<a href="{{route('leave.approve',$leave->id)}}" class="btn btn-sm btn-success">Approve</a>--}}
                                                        {{--<a href="{{route('leave.pending',$leave->id)}}" class="btn btn-sm btn-warning">Pending</a>--}}
                                                        {{--<a href="{{route('leave.reject',$leave->id)}}" class="btn btn-sm btn-danger">Reject</a>--}}
                                                    @else
                                                        @if($leave->leave_type_offer==0)
                                                            <span class="badge badge-pill badge-warning">Pending</span>
                                                        @elseif($leave->leave_type_offer==1)
                                                            <span class="badge badge-pill badge-success">Approve</span>
                                                        @else
                                                            <span class="badge badge-pill badge-danger">Reject</span>
                                                        @endif
                                                    @endif
                                                </td>

                                                        <td>
                                                            @if(Auth::user()->role=='2')
                                                            {{--{{$leave->is_approved}}--}}
                                                            @if($leave->is_approved==0)
                                                                <form id="approve-leave-{{$leave->id}}" action="{{route('leave.approve',$leave->id)}}" method="POST">
                                                                    @csrf
                                                                    {{--<button type="button" onclick="approveLeave({{$leave->id}})" class="btn btn-sm btn-success" name="approve" value="1">Approve</button>--}}
                                                                    <button type="submit" onclick="return confirm('Are you sure want to approve leave?')" class="btn btn-sm btn-success" name="approve" value="1">Approve</button>
                                                                </form>
                                                                <form id="reject-leave-{{$leave->id}}" action="{{route('leave.approve',$leave->id)}}" method="POST">
                                                                    @csrf
                                                                    {{--<button type="button" onclick="rejectLeave({{$leave->id}})" class="btn btn-sm btn-danger" name="approve" value="2">Reject</button>--}}
                                                                    <button type="submit" onclick="return confirm('Are you sure want to reject leave?')" class="btn btn-sm btn-danger" name="approve" value="2">Reject</button>
                                                                </form>
                                                            @elseif($leave->is_approved==1)

                                                                <form action="{{route('leave.approve',$leave->id)}}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to reject leave?')" type="submit" name="approve" value="2">Reject</button>
                                                                </form>
                                                            @else
                                                                <form action="{{route('leave.approve',$leave->id)}}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-success" onclick="return confirm('Are you sure want to approve leave?')" type="submit" name="approve" value="1">Approve</button>
                                                                </form>
                                                            @endif

                                                                {{--<a href="{{route('leave.approve',$leave->id)}}" class="btn btn-sm btn-success">Approve</a>--}}
                                                                {{--<a href="{{route('leave.pending',$leave->id)}}" class="btn btn-sm btn-warning">Pending</a>--}}
                                                                {{--<a href="{{route('leave.reject',$leave->id)}}" class="btn btn-sm btn-danger">Reject</a>--}}
                                                                @else
                                                                @if($leave->is_approved==0)
                                                                    <span class="badge badge-pill badge-warning">Pending</span>
                                                                @elseif($leave->is_approved==1)
                                                                    <span class="badge badge-pill badge-success">Approved</span>
                                                                @else
                                                                    <span class="badge badge-pill badge-danger">Rejected</span>
                                                                @endif
                                                            @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                       
                                    </table>
                                    
                                </div>
                                </form>
                </div>
            </div>
        </div>
    </div>
</div>


    @include('footerimport')
@endsection

<style>
    .size {
        font-size: 13px !important; 
     }
     .a {
        margin-top: -10px !important; 
     }
     .btn{
        border-radius: 10px !important;
     }
     </style>