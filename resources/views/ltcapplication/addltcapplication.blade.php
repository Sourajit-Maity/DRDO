@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Leave Travel Concession' => route('view-leave-travel-apply'),
    
    'Apply Leave Travel Concession' => route('add-leave-travel-apply'),

]])

<script>
$(document).ready(function(){

    $("#designation_id").change(function(){
        var val = $(this).val();
        $("#emp_id").html('');
        var op='<option>Choose</option>';
        $("#emp_id").append(op);
        jQuery.ajax({  
            url : '/getemployee/' +val,
            type : "GET",
            dataType : "json",
            success:function(data)
            {
                
                for(var i=0;i<data.length;i++){
                    op='<option value="'+data[i].id+'">'+data[i].emp_nick_name+'</option>';
                    $("#emp_id").append(op);
                }
            }
        });
        
    });
    $("#emp_id").change(function(){
        var val = $(this).val();
        $("#employee_type").html('');
        var op='<option>Choose</option>';
        $("#employee_type").append(op);
        jQuery.ajax({ 
            url : '/getemployeetype/' +val,
            type : "GET",
            dataType : "json",
            success:function(data)
            {
                
                for(var i=0;i<data.length;i++){
                    op='<option value="'+data[i].id+'">'+data[i].emp_type_name+'</option>';
                    $("#employee_type").append(op);
                }
            }
        });
        
    });
    $(".emp_id").change(function(){
        var val = $(this).val();
        var that = $(this);
        jQuery.ajax({ 
            url : '/getemployeejoining/' +val,
            type : "GET",
            dataType : "json",
            success:function(data)
            {
                that.parents('div').find('.date_of_joining').val(data[0].joined_date);
            }
        });
        
    });

});
</script>

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
                            <label for="designation_id" class="col-md-2 col-form-label text-md-right size">{{ __('Designation/पदनाम') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                            <input id="designation_id" type="text" class="form-control @error('designation_id') is-invalid @enderror" name="display_name" value="{{ $myprofile->display_name }}" required autocomplete="designation_id" readonly>
                            <input id="designation_id" type="hidden" class="form-control @error('designation_id') is-invalid @enderror" name="designation_id" value="{{ $myprofile->designation }}" required autocomplete="designation_id" readonly>

                                @error('designation_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                            <label for="emp_id" class="col-md-2 col-form-label text-md-right size">{{ __('Employee/कर्मचारी का नाम') }}<span style="color:red"> *</span></label>

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
                            <label for="employee_type" class="col-md-2 col-form-label text-md-right size">{{ __('Employee Type/कर्मचारी का प्रकार') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="employee_type" type="text" class="form-control @error('employee_type') is-invalid @enderror" name="emp_type_name" value="{{ $myprofile->emp_type_name }}" required autocomplete="employee_type" readonly>
                                <input id="employee_type" type="hidden" class="form-control @error('employee_type') is-invalid @enderror" name="employee_type" value="{{ $myprofile->emp_status }}" required autocomplete="employee_type" readonly>

                                @error('employee_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          

                            <label for="date_of_joining" class="col-md-2 col-form-label text-md-right size">{{ __('Date of Joining/शामिल होने की तारीख') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="date_of_joining" type="text" class="form-control @error('date_of_joining') is-invalid @enderror" name="date_of_joining" value="{{ $myprofile->joined_date }}" required autocomplete="date_of_joining" readonly>
                               
                                @error('date_of_joining')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="present_pay_npa_si" class="col-md-2 col-form-label text-md-right size">{{ __('Present pay+NPA+SI/वर्तमान वेतन+एनपीए+एसआई') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="present_pay_npa_si" type="text" class="form-control @error('present_pay_npa_si') is-invalid @enderror" name="present_pay_npa_si" value="{{ $myprofile->committed_amount }}" required autocomplete="present_pay_npa_si" readonly>

                                @error('present_pay_npa_si')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          

                            <label for="home_town" class="col-md-2 col-form-label text-md-right size">{{ __('HomeTown/गृहनगर') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="home_town" type="text" class="form-control @error('home_town') is-invalid @enderror" name="home_town" value="{{ $myprofile->emp_street2 }}" required autocomplete="home_town" readonly>
                               
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
            

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Apply Leave Travel Concession') }}</div>

                            <div class="card-body">

                        <div class="form-group row">
                            <label for="spouse_ltc" class="col-md-4 col-form-label text-md-right size">{{ __('Whether spouse is employed and if so whether entitled to LTC/क्या पति/पत्नी कार्यरत हैं और यदि हां, तो क्या एलटीसी के हकदार हैं?') }}</label>

                            <div class="col-md-6">
                            
                            <select  name="spouse_ltc" id="spouse_ltc" class="form-control @error('spouse_ltc') is-invalid @enderror"  required autocomplete="spouse_ltc">
                           
                           <option value=""disable selected>Select Type</option>
                               <option value="yes">YES</option>
                               <option value="no">No</option>
                               <option value="na">N/A</option>
                               </select>
                               @error('spouse_ltc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group row">
                            <label for="leave_travel_type_id" class="col-md-4 col-form-label text-md-right size">{{ __('Leave Concession Type/छुट्टी का प्रकार') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6"> 
                               
                            <select  name="leave_travel_type_id" id="leave_travel_type_id" class="form-control @error('leave_travel_type_id') is-invalid @enderror"  value="{{ old('leave_travel_type_id') }}" required autocomplete="leave_travel_type_id">
                                  <option value=""disable selected>--Select Leave Concession Type--</option>
                                 @foreach($leavecocessiontype as $leavetypes)
                                        <option value="{{$leavetypes->id}}">{{$leavetypes->leave_travel_concession}}</option>
                                    @endforeach
                                                                            
                                                     
                             </select>
                                @error('leave_travel_type_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hometown_ltc" class="col-md-4 col-form-label text-md-right size">{{ __('Whether the concession is to be availed for visiting Home Town and if so
block for which LTC is to be availed/क्या होम टाउन जाने के लिए रियायत का लाभ उठाया जाना है और यदि ऐसा है तो
ब्लॉक जिसके लिए एलटीसी का लाभ उठाया जाना है') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                                <input id="hometown_ltc" type="text" class="form-control @error('hometown_ltc') is-invalid @enderror" name="hometown_ltc" value="{{ old('hometown_ltc') }}"  autocomplete="hometown_ltc">

                               
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="destination_ltc" class="col-md-4 col-form-label text-md-right size">{{ __('Destination/गंतव्य') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                                <input id="destination_ltc" type="text" class="form-control @error('destination_ltc') is-invalid @enderror" name="destination_ltc" value="{{ old('destination_ltc') }}" required autocomplete="destination_ltc">

                                @error('destination_ltc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="single_fare" class="col-md-4 col-form-label text-md-right size">{{ __('Single rail fare/bus fare/air fare from the headquarters to home town/place of
visit by shortest route/मुख्यालय से गृह नगर/स्थान के लिए रेल किराया/बस किराया/हवाई किराया शामिल है
सबसे छोटे मार्ग से यात्रा करें') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                                <input id="single_fare" type="text" class="form-control @error('single_fare') is-invalid @enderror only-numeric" name="single_fare" value="{{ old('single_fare') }}" required autocomplete="single_fare">

                                @error('single_fare')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="advance" class="col-md-4 col-form-label text-md-right">{{ __('Amount of advance required/आवश्यक अग्रिम राशि') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                                <input id="advance" type="text" class="form-control @error('advance') is-invalid @enderror only-numeric" name="advance" value="{{ old('advance') }}" required autocomplete="advance">

                                @error('advance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                                <div class="form-group row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label size">Date from/तारीख से</label><span style="color:red"> *</span>
                                    <div class="col-sm-4">
                                        <input type="date" min="{{date('Y-m-d')}}" name="date_from" class="form-control @error('date_from') is-invalid @enderror" id="FromDate">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="date" name="date_to" class="form-control @error('date_to') is-invalid @enderror" id="ToDate">
                                    </div>
                                </div>
                                
                                
                                <div class="form-group row">
                            <label for="days" class="col-md-4 col-form-label text-md-right size">{{ __('Days/दिन') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                            <input type="text" name="days" class="form-control @error('days') is-invalid @enderror only-numeric" id="TotalDays" placeholder="Number of leave days" readonly>
                                @error('days')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reason" class="col-md-4 col-form-label text-md-right size">{{ __('Reason/कारण') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                            <textarea type="text" name="reason" class="form-control @error('reason') is-invalid @enderror" placeholder="Reason"></textarea>

                                @error('reason')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="total_person_availed" class="col-md-4 col-form-label text-md-right size">{{ __('Total Person/कुल व्यक्ति') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                            <input type="text" name="total_person_availed" class="form-control @error('total_person_availed') is-invalid @enderror only-numeric" id="total_person_availed" placeholder="Number of Total Person">

                                @error('total_person_availed')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                                <div class="form-group row">
                            <label for="ticket_file" class="col-md-4 col-form-label text-md-right size">{{ __('Ticket Copy/टिकट कॉपी') }}</label><span style="color:red"> *</span>
                            <span style="color:red">Image File Only</span>
                            <div class="col-md-6">
                             
                            
                                <input type="file" name="ticket_file" class="form-control @error('ticket_file') is-invalid @enderror">
                                @error('ticket_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                                <div class="form-group row">
                            <label for="declare" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>

                            <div class="col-md-6">
                            <span style="color:red"> *</span>I declare that the particulars furnished above are true and correct to the best
of my knowledge. I undertake to produce the tickets for the outward journey
within ten days of receipt of the advance. In the event of cancellation of the
journey or if I fail to produce the tickets within ten days of receipt of advance, I
undertake to refund the entire advance in one lumpsum. <input id="accept" name="declare" class="" type="checkbox" value="y"/>
 
                            
                            @error('declare')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                           
                            <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" id="submitbtn" disabled="disabled" class="btn btn-success">
                                    {{ __('Apply') }}
                                </button>
                                <a href="{{ route('view-leave-travel-apply') }}" class="btn btn-danger">Back</a>                             </div>
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
                $('#accept').click(function() {
            if ($('#submitbtn').is(':disabled')) {
                $('#submitbtn').removeAttr('disabled');
            } else {
                $('#submitbtn').attr('disabled', 'disabled');
            }
        });
    </script>
    @endsection