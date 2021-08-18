@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Leave' => route('leave'),
    
    'Apply Leave' => route('leave.create'),

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
                <form action="{{route('leave.store')}}" method="post" class="form-horizontal">
                            @csrf
                <div class="card-body">

                <div class="form-group row">
                            <label for="designation_id" class="col-md-3 col-form-label text-md-right size">{{ __('Designation/पदनाम') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                            <input id="designation_id" type="text" class="form-control @error('designation_id') is-invalid @enderror" name="display_name" value="{{ $myprofile->display_name }}" required autocomplete="designation_id" readonly>
                            <input id="designation_id" type="hidden" class="form-control @error('designation_id') is-invalid @enderror" name="designation_id" value="{{ $myprofile->designation }}" required autocomplete="designation_id" readonly>

                                @error('designation_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                            <label for="emp_id" class="col-md-3 col-form-label text-md-right size">{{ __('Name/नाम') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="emp_nick_name" type="text" class="form-control @error('emp_nick_name') is-invalid @enderror" name="emp_nick_name" value="{{ $myprofile->emp_nick_name }}" required autocomplete="emp_nick_name" readonly>
                                <input id="emp_id" type="hidden" class="form-control @error('emp_id') is-invalid @enderror" name="emp_id" value="{{ $myprofile->id }}" required autocomplete="emp_id" readonly>

                                @error('emp_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="employee_type" class="col-md-3 col-form-label text-md-right size">{{ __('Employee Type/कर्मचारी का प्रकार') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="employee_type" type="text" class="form-control @error('employee_type') is-invalid @enderror" name="emp_type_name" value="{{ $myprofile->emp_type_name }}" required autocomplete="employee_type" readonly>
                                <input id="employee_type" type="hidden" class="form-control @error('employee_type') is-invalid @enderror" name="employee_type" value="{{ $myprofile->emp_status }}" required autocomplete="employee_type" readonly>

                                @error('employee_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          

                            <label for="dept_id" class="col-md-3 col-form-label text-md-right size">{{ __('Department/विभाग') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="dept_id" type="hidden" class="form-control @error('dept_id') is-invalid @enderror" name="dept_id" value="{{ $myprofile->operational_company_loc_dept_id }}" required autocomplete="dept_id" readonly>
                                <input id="d_name" type="text" class="form-control @error('d_name') is-invalid @enderror" name="d_name" value="{{ $myprofile->d_name }}" required autocomplete="d_name" readonly>

                                @error('dept_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dept_phone_no" class="col-md-3 col-form-label text-md-right size">{{ __('Department Ph No/विभागीय फोन नंबर') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="dept_phone_no" type="text" class="form-control @error('dept_phone_no') is-invalid @enderror" name="dept_phone_no" value="{{ $myprofile->phone }}" required autocomplete="dept_phone_no" readonly>

                                @error('dept_phone_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          

                            <label for="phone_no" class="col-md-3 col-form-label text-md-right size">{{ __('Phone No/फोन नंबर') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror only-numeric" name="phone_no" maxlength="10" required autocomplete="phone_no">
                               
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
                            <label for="date_from" class="col-md-3 col-form-label text-md-right size size">{{ __('Date from/तारीख से') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="FromDate" type="date" min="{{date('Y-m-d')}}" name="date_from" class="form-control @error('date_from') is-invalid @enderror" name="date_from"  required autocomplete="date_from" >

                                @error('date_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          

                            <label for="date_to" class="col-md-3 col-form-label text-md-right size">{{ __('Date to/की तारीख') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="ToDate" type="date" min="{{date('Y-m-d')}}" name="date_to" class="form-control @error('date_to') is-invalid @enderror"  required autocomplete="date_to" >
                               
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
                                    <select  name="leave_type" id="leave_type" class="form-control @error('leave_type') is-invalid @enderror"  value="{{ old('leave_type') }}" required autocomplete="leave_type">
                                        <option>Leave Type</option>
                                        @foreach($leavetype as $leavetypes)
                                                <option value="{{$leavetypes->id}}">{{$leavetypes->name}}</option>
                                            @endforeach
                                                                                    
                                                            
                                    </select>
                                    @error('leave_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                          

                                <label for="days" class="col-md-3 col-form-label text-md-right size">{{ __('Days/कुल छुट्टी के दिन') }}<span style="color:red"> *</span></label>

                                <div class="col-md-3">
                                <input type="text" name="days" class="form-control" id="TotalDays" placeholder="Number of leave days" readonly>
                                
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
                                <input id="reason" type="text" class="form-control @error('reason') is-invalid @enderror" name="reason"  required autocomplete="reason" >

                                @error('reason')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          

                            <label for="leave_address" class="col-md-3 col-form-label text-md-right size">{{ __('Leave Address/पता जब छुट्टी में हो') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="leave_address" type="text" class="form-control @error('leave_address') is-invalid @enderror" name="leave_address"  required autocomplete="leave_address" >
                               
                                @error('leave_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                           <div class="form-group row">
                                   
                                        <label for="sunday_holiday" class="col-md-3 col-form-label text-md-right size a">{{ __('Sunday & Holidays to be prefixed and suffixed/रविवार और छुट्टियों को उपसर्ग और प्रत्यय लगाया जाना चाहिए') }}<span style="color:red"> *</span></label>

                                        <div class="col-md-3">
                                            <input id="sunday_holiday" type="text" class="form-control @error('sunday_holiday') is-invalid @enderror" name="sunday_holiday"  required autocomplete="sunday_holiday" >

                                            @error('sunday_holiday')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <label for="personal_id" class="col-md-3 col-form-label text-md-right size">{{ __('Personal Id No/व्यक्तिगत पहचान संख्या') }}</label>

                            <div class="col-md-3">
                                <input id="personal_id" type="text" class="form-control" name="personal_id">

                            </div>
                                </div>
                            <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Apply') }}
                                </button>
                                
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
    @include('footerimport')
    @endsection

@section('js')
    <script>
        $("#ToDate").change(function () {
            var start = new Date($('#FromDate').val());
            var end = new Date($('#ToDate').val());

            var diff = new Date(end - start);
            var days=1;
            days = diff / 1000 / 60 / 60 / 24;
            if(days<0){
              alert("Date To should be grater than Date From");
              $('#ToDate').val('');
              $('#TotalDays').val(0);
              return;
            }

            // $('#TotalDays').val(days);
            if (isNaN(days)) {
                $('#TotalDays').val(0);
            } else {
                $('#TotalDays').val(days+1);
            }
        })

        $("#FromDate").change(function () {
            var start = new Date($('#FromDate').val());
            var end = new Date($('#ToDate').val());

            var diff = new Date(end - start);
            var days=1;
            days = diff / 1000 / 60 / 60 / 24;

            if(days<0){
              alert("Date To should be grater than Date From");
              $('#FromDate').val('');
              $('#TotalDays').val(0);
              return;
            }

            // $('#TotalDays').val(days);
            if (isNaN(days)) {
                $('#TotalDays').val(0);
            } else {
                $('#TotalDays').val(days+1);
            }
        })
    </script>
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