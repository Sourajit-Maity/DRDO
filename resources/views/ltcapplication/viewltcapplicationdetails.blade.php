@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Leave Travel Concession' => route('view-leave-travel-apply'),
    
    'Leave Travel Concession Details' => '#',

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
                <form action="{{route('submit-leave-travel-apply')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                <div class="card-body">

                <div class="form-group row">
                            <label for="designation_id" class="col-md-3 col-form-label text-md-right size">{{ __('Designation/पदनाम') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                            <input id="designation_id" type="text" class="form-control @error('designation_id') is-invalid @enderror" name="display_name" value="{{ $entitlement->display_name }}" required autocomplete="designation_id" readonly>

                                @error('designation_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                            <label for="emp_id" class="col-md-3 col-form-label text-md-right size">{{ __('Employee/कर्मचारी का नाम') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="emp_id" type="text" class="form-control @error('emp_id') is-invalid @enderror" name="emp_id" value="{{ $entitlement->emp_nick_name }}" required autocomplete="emp_id" readonly>

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
                                <input id="employee_type" type="text" class="form-control @error('employee_type') is-invalid @enderror" name="emp_type_name" value="{{ $entitlement->emp_type_name }}" required autocomplete="employee_type" readonly>

                                @error('employee_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          

                            <label for="date_of_joining" class="col-md-3 col-form-label text-md-right size">{{ __('Date of Joining/शामिल होने की तारीख') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="date_of_joining" type="text" class="form-control @error('date_of_joining') is-invalid @enderror" name="date_of_joining" value="{{ $entitlement->date_of_joining }}" required autocomplete="date_of_joining" readonly>
                               
                                @error('date_of_joining')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="present_pay_npa_si" class="col-md-3 col-form-label text-md-right size">{{ __('Present pay+NPA+SI/वर्तमान वेतन+एनपीए+एसआई') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="present_pay_npa_si" type="text" class="form-control @error('present_pay_npa_si') is-invalid @enderror" name="present_pay_npa_si" value="{{ $entitlement->present_pay_npa_si }}" required autocomplete="present_pay_npa_si" readonly>

                                @error('present_pay_npa_si')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          

                            <label for="home_town" class="col-md-3 col-form-label text-md-right size">{{ __('HomeTown/गृहनगर') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="home_town" type="text" class="form-control @error('home_town') is-invalid @enderror" name="home_town" value="{{ $entitlement->home_town }}" required autocomplete="home_town" readonly> 
                               
                                @error('home_town')
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
      
    </div>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Leave Travel Concession Details') }}</div>

                            <div class="card-body">

                        <div class="form-group row">
                            <label for="spouse_ltc" class="col-md-3 col-form-label text-md-right size">{{ __('Whether spouse is employed and if so whether entitled to LTC/क्या पति/पत्नी कार्यरत हैं और यदि हां, तो क्या एलटीसी के हकदार हैं?') }}</label>

                            <div class="col-md-3">
                            <input id="spouse_ltc" type="text" class="form-control @error('spouse_ltc') is-invalid @enderror" name="spouse_ltc"   autocomplete="spouse_ltc" value="{{ $entitlement->spouse_ltc }}" readonly>

                          
                               @error('spouse_ltc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                       
                            <label for="leave_travel_type_id" class="col-md-3 col-form-label text-md-right size">{{ __('Leave Concession Type/छुट्टी का प्रकार') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3"> 
                            <input id="leave_travel_type_id" type="text" class="form-control @error('leave_travel_type_id') is-invalid @enderror" name="leave_travel_type_id"   autocomplete="leave_travel_type_id" value="{{ $entitlement->leave_travel_concession }}" readonly>
 
                           
                                @error('leave_travel_type_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hometown_ltc" class="col-md-3 col-form-label text-md-right size">{{ __('Whether the concession is to be availed for visiting Home Town and if so
block for which LTC is to be availed/क्या होम टाउन जाने के लिए रियायत का लाभ उठाया जाना है और यदि ऐसा है तो
ब्लॉक जिसके लिए एलटीसी का लाभ उठाया जाना है') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="hometown_ltc" type="text" class="form-control @error('hometown_ltc') is-invalid @enderror" name="hometown_ltc"   autocomplete="hometown_ltc" value="{{ $entitlement->hometown_ltc }}" readonly>

                               
                            </div>
                        
                            <label for="destination_ltc" class="col-md-3 col-form-label text-md-right size">{{ __('Destination/गंतव्य') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="destination_ltc" type="text" class="form-control @error('destination_ltc') is-invalid @enderror" name="destination_ltc"  required autocomplete="destination_ltc" value="{{ $entitlement->destination_ltc }}" readonly>

                                @error('destination_ltc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="single_fare" class="col-md-3 col-form-label text-md-right size">{{ __('Single rail fare/bus fare/air fare from the headquarters to home town/place of
visit by shortest route/मुख्यालय से गृह नगर/स्थान के लिए रेल किराया/बस किराया/हवाई किराया शामिल है
सबसे छोटे मार्ग से यात्रा करें') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="single_fare" type="text" class="form-control @error('single_fare') is-invalid @enderror only-numeric" name="single_fare"  required autocomplete="single_fare" value="{{ $entitlement->single_fare }}" readonly>

                                @error('single_fare')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                       
                            <label for="advance" class="col-md-3 col-form-label text-md-right size">{{ __('Amount of advance required/आवश्यक अग्रिम राशि') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="advance" type="text" class="form-control @error('advance') is-invalid @enderror only-numeric" name="advance"  required autocomplete="advance" value="{{ $entitlement->advance }}" readonly>

                                @error('advance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_from" class="col-md-3 col-form-label text-md-right size">{{ __('Date from/तारीख से') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="date_from" type="text" class="form-control @error('date_from') is-invalid @enderror" name="date_from"  required autocomplete="date_from" value="{{ $entitlement->date_from }}" readonly>

                                @error('date_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                       
                            <label for="date_to" class="col-md-3 col-form-label text-md-right size">{{ __('Date to/की तारीख') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="date_to" type="text" class="form-control @error('date_to') is-invalid @enderror" name="date_to"  required autocomplete="date_to" value="{{ $entitlement->date_to }}" readonly>

                                @error('date_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                                

                                <div class="form-group row">
                            <label for="days" class="col-md-3 col-form-label text-md-right size">{{ __('Days/दिन') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                            <input type="text" name="days" class="form-control @error('days') is-invalid @enderror only-numeric" id="TotalDays"  value="{{ $entitlement->days }}" readonly>
                                @error('days')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                       
                            <label for="reason" class="col-md-3 col-form-label text-md-right size">{{ __('Reason/कारण') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                            <input type="text" name="reason" class="form-control @error('reason') is-invalid @enderror" id="reason"  value="{{ $entitlement->reason }}" readonly>

                                @error('reason')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="total_person_availed" class="col-md-3 col-form-label text-md-right size">{{ __('Total Person/कुल व्यक्ति') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                            <input type="text" name="total_person_availed" class="form-control @error('total_person_availed') is-invalid @enderror only-numeric" id="total_person_availed" value="{{ $entitlement->total_person_availed }}" readonly>

                                @error('total_person_availed')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                <div class="card-header">{{ __('Member Details') }}</div>

                <div class="card-body">

                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Sl.No.<p>(क्रमांक)</p></th>
                                            <th>Employee Name <p>(नाम)</p></th>
                                            <th>Application Id<p>(आवेदन पत्र संख्या)</p></th>
                                            <th>Member Name<p>(सदस्य का नाम)</p></th>
                                            <th>Age<p>(उम्र)</p></th>
                                            <th>Relationship<p>(रिश्ता)</p></th>
                                            <th>Maritial Status<p>(वैवाहिक स्थिति)</p></th>
                                            <th>Aaddhar No.<p>(आधार नंबर)</p></th>
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($leaves as $leave)
                                            <tr>
                                                <td>{{$loop -> index+1 }}</td>
                                                <td>{{$leave->emp_nick_name}}</td>
                                                <td>{{$leave->ltc_application_id}}</td>
                                                <td>{{$leave->member_name}}</td>
                                                <td>{!! \Carbon\Carbon::parse($leave->dob)->diffInYears(\Carbon\Carbon::now()) !!} years</td>
                                                
                                                <td>{{$leave->relation}}</td>
                                                <td>{{$leave->maritial_status}}</td>
                                                <td>{{$leave->addhar_no}}</td>
                                                
                                                
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                    {{ $leaves->links() }}
                                </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                              
                                <input type="button" onclick="history.go(-1);" value="Back" class="btn btn-danger">
                            </div>
                        </div>                   
      
  
</form>
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
                                           
                                        <th> Director Approval<p>(निदेशक अनुमोदन)</p></th>
                                            <th> Admin Approval<p>(व्यवस्थापक अनुमोदन)</p></th>
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
  
                                            <tr>
                                                
                                                
                                            
                                            <td>
                                                    @if(Auth::user()->role=='1')
                                                        @if($entitlement->leave_type_offer==0)
                                                            <form id="{{$entitlement->id}}" action="{{route('leave-travel-apply-paid',$entitlement->id)}}" method="POST">
                                                                @csrf
                                                                {{--<button type="button" onclick="approveLeave({{$entitlement->id}})" class="btn btn-sm btn-success" name="approve" value="1">Approve</button>--}}
                                                                <button type="submit" onclick="return confirm('Are you sure want to approve for leave?')" class="btn btn-sm btn-success" name="paid" value="1">Approve</button>
                                                            </form>
                                                            <form id="{{$entitlement->id}}" action="{{route('leave-travel-apply-paid',$leave->id)}}" method="POST">
                                                                @csrf
                                                                {{--<button type="button" onclick="rejectLeave({{$entitlement->id}})" class="btn btn-sm btn-danger" name="approve" value="2">Reject</button>--}}
                                                                <button type="submit" onclick="return confirm('Are you sure want to reject for leave?')" class="btn btn-sm btn-danger" name="paid" value="2">Reject</button>
                                                            </form>
                                                        @elseif($entitlement->leave_type_offer==1)

                                                            <form action="{{route('leave-travel-apply-paid',$entitlement->id)}}" method="POST">
                                                                @csrf
                                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to reject for leave?')" type="submit" name="paid" value="2">Reject</button>
                                                            </form>
                                                        @else
                                                            <form action="{{route('leave-travel-apply-paid',$entitlement->id)}}" method="POST">
                                                                @csrf
                                                                <button class="btn btn-sm btn-success" onclick="return confirm('Are you sure want to approve for leave?')" type="submit" name="paid" value="1">Approve</button>
                                                            </form>
                                                        @endif

                                                    @else
                                                        @if($entitlement->leave_type_offer==0)
                                                            <span class="badge badge-pill badge-warning">Pending</span>
                                                        @elseif($entitlement->leave_type_offer==1)
                                                            <span class="badge badge-pill badge-success">Approve</span>
                                                        @else
                                                            <span class="badge badge-pill badge-danger">Reject</span>
                                                        @endif
                                                    @endif
                                                </td>

                                                <td>
                                                            @if(Auth::user()->role=='2')
                                                          
                                                            @if($entitlement->is_approved==0)
                                                                <form id="approve-leave-{{$entitlement->id}}" action="{{route('leave-travel-apply-approve',$entitlement->id)}}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" onclick="return confirm('Are you sure want to approve leave?')" class="btn btn-sm btn-success" name="approve" value="1">Approve</button>
                                                                </form>
                                                                <form id="reject-leave-{{$entitlement->id}}" action="{{route('leave-travel-apply-approve',$entitlement->id)}}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" onclick="return confirm('Are you sure want to reject leave?')" class="btn btn-sm btn-danger" name="approve" value="2">Reject</button>
                                                                </form>
                                                            @elseif($entitlement->is_approved==1)

                                                                <form action="{{route('leave-travel-apply-approve',$entitlement->id)}}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to reject leave?')" type="submit" name="approve" value="2">Reject</button>
                                                                </form>
                                                            @else
                                                                <form action="{{route('leave-travel-apply-approve',$entitlement->id)}}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-success" onclick="return confirm('Are you sure want to approve leave?')" type="submit" name="approve" value="1">Approve</button>
                                                                </form>
                                                            @endif

                                                                @else
                                                                @if($entitlement->is_approved==0)
                                                                    <span class="badge badge-pill badge-warning">Pending</span>
                                                                @elseif($entitlement->is_approved==1)
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
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Ticket Details') }}</div>

                <div class="card-body">

             
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                            <img src="{{url('assets/ticket')}}/{{$entitlement->ticket_file}}" width="100" height=”100%”>
                            <!-- <iframe src="{{url('assets/ticket')}}/{{$entitlement->ticket_file}}" width=”100%” height=”100%”> -->
                            </div>
                        </div>                   
      
  
</form>
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

            // $('#TotalDays').val(days);
            if (days == NaN) {
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

            // $('#TotalDays').val(days);
            if (days == NaN) {
                $('#TotalDays').val(0);
            } else {
                $('#TotalDays').val(days+1);
            }
        })
    </script>
    @endsection
    <style>
     th,th p {text-align: center !important;}
     </style>