@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'TA-DA' => route('view-employeetada'),
    
    'Apply TA-DA' => route('add-employeetada'),

]])
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function(){

    $("#travel_by").change(function(){
        var val = $(this).val();
        $("#ta_entitlement_id").html('');
        var op='<option>Choose</option>';
        $("#ta_entitlement_id").append(op);
        jQuery.ajax({ 
            url : '/getentitlementname/' +val,
            type : "GET",
            dataType : "json",
            success:function(data)
            
            {
                
                for(var i=0;i<data.length;i++){
                    op='<option value="'+data[i].id+'">'+data[i].entitlement_name+'</option>';
                    $("#ta_entitlement_id").append(op);
                }
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
                <div class="card-header">{{ __('Apply TA-DA') }}</div>

                            <div class="card-body">
                            <form action="{{route('submit-employeetada')}}" method="POST" enctype="multipart/form-data">
                            @csrf 

                         <div class="form-group row">
                            <label for="ta_da_advance" class="col-md-3 col-form-label text-md-right size">{{ __('TA-DA Advance in Rs/रुपये के लिए टीए-डीए अग्रिम') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="ta_da_advance" type="text" class="ta_da_advance form-control @error('ta_da_advance') is-invalid @enderror only-numeric" name="ta_da_advance" value="{{ old('ta_da_advance') }}" required autocomplete="ta_da_advance">

                                @error('ta_da_advance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                            <label for="hall_ordinary_da" class="col-md-3 col-form-label text-md-right size">{{ __('Hall/Ordinary DA/हॉल/साधारण डीए') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="hall_ordinary_da" type="text" class="form-control @error('hall_ordinary_da') is-invalid @enderror" name="hall_ordinary_da" value="{{ old('hall_ordinary_da') }}" required autocomplete="hall_ordinary_da">

                                @error('hall_ordinary_da')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group row">
                            <label for="travel_by" class="col-md-3 col-form-label text-md-right size">{{ __('Travel By/इसके द्वारा यात्रा') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                             
                                <select  name="travel_by" id="travel_by" class="form-control @error('travel_by') is-invalid @enderror" name="travel_by"  required autocomplete="travel_by">
                                <option value=""disable selected>Select Travel By</option>
                             
                                @foreach($travel as $travels)
                                        <option value="{{$travels->id}}">{{$travels->crm}}</option>
                                    @endforeach
                                   
                   
                             </select>
                                @error('travel_by')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      
                            <label for="ta_entitlement_id" class="col-md-3 col-form-label text-md-right size">{{ __('Class of Entitlement/पात्रता की श्रेणी') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                               
                            <select  name="ta_entitlement_id" id="ta_entitlement_id" class="form-control @error('ta_entitlement_id') is-invalid @enderror"  value="{{ old('ta_entitlement_id') }}" required autocomplete="ta_entitlement_id">
                                  <option value=""disable selected>Select Class of Entitlement</option>
                                 
                             </select>
                                @error('ta_entitlement_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                    <label for="location_from" class="col-sm-2 text-right control-label col-form-label size">Location From/स्थान से</label><span style="color:red"> *</span>
                                    <div class="col-sm-3">
                                        <input type="text" placeholder="location from" name="location_from" class="form-control @error('location_from') is-invalid @enderror">
                                    </div>
                                    <label for="location_to" class="col-sm-2 text-right control-label col-form-label size">Location To/के लिए स्थान</label><span style="color:red"> *</span>

                                    <div class="col-sm-3">
                                        <input type="text" name="location_to" placeholder="location to" class="form-control @error('location_to') is-invalid @enderror">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="date_from" class="col-sm-2 text-right control-label col-form-label size">Date from/तारीख से</label><span style="color:red"> *</span>
                                    <div class="col-sm-3">
                                        <input type="date" min="{{date('Y-m-d')}}" name="date_from" class="form-control @error('date_from') is-invalid @enderror" id="FromDate">
                                    </div>
                                    <label for="date_to" class="col-sm-2 text-right control-label col-form-label size">Date To/की तारीख</label><span style="color:red"> *</span>

                                    <div class="col-sm-3">
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
                <div class="card-header">{{ __('Employee Details') }}</div>

               
                            <div class="card-body">
                            

                         <div class="form-group row">
                            <label for="emp_name" class="col-md-3 col-form-label text-md-right size">{{ __('Employee Name/कर्मचारी का नाम') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="emp_name" type="text" class=" form-control @error('emp_name') is-invalid @enderror" name="emp_name" value="{{ $myprofile->emp_nick_name }}" required autocomplete="emp_name" readonly>

                                @error('emp_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                            <label for="emp_dept" class="col-md-3 col-form-label text-md-right size">{{ __('Employee Department/कर्मचारी का विभाग') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="emp_dept" type="text" class="form-control @error('emp_dept') is-invalid @enderror" name="emp_dept" value="{{ $myprofile->d_name }}"  required autocomplete="emp_dept" readonly>

                                @error('emp_dept')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group row">
                            <label for="cas_no" class="col-md-3 col-form-label text-md-right size">{{ __('CAS No/CAS संख्या') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="cas_no" type="text" class="form-control @error('cas_no') is-invalid @enderror" name="cas_no" value="{{ old('cas_no') }}" required autocomplete="cas_no">

                                @error('cas_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      
                            <label for="phone_no" class="col-md-3 col-form-label text-md-right size">{{ __('Phone No/फोन नंबर') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror only-numeric" name="phone_no" value="{{ $myprofile->emp_mobile }}" required autocomplete="phone_no" maxlength="12" >

                                @error('phone_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_designation" class="col-md-3 col-form-label text-md-right size">{{ __('Employee Designation/कर्मचारी का पदनाम') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="emp_designation" type="text" class="form-control @error('emp_designation') is-invalid @enderror" name="emp_designation" value="{{ $myprofile->display_name }}" required autocomplete="emp_designation" readonly>

                                @error('emp_designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      
                            <label for="emp_gpf" class="col-md-3 col-form-label text-md-right size">{{ __('Employee GPF No/कर्मचारी का जीपीएफ संख्या.') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="emp_gpf" type="text" class="form-control @error('emp_gpf') is-invalid @enderror" name="emp_gpf" value="{{ old('emp_gpf') }}" required autocomplete="emp_gpf">

                                @error('emp_gpf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="basic_pay" class="col-md-3 col-form-label text-md-right size">{{ __('Basic Pay/मूल वेतन') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="basic_pay" type="text" class="form-control @error('basic_pay') is-invalid @enderror only-numeric" name="basic_pay" value="{{ $myprofile->committed_amount }}" required autocomplete="basic_pay" readonly>

                                @error('basic_pay')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      
                            <label for="grade_pay" class="col-md-3 col-form-label text-md-right size">{{ __('Grade Pay/ग्रेड पे') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="grade_pay" type="text" class="form-control @error('grade_pay') is-invalid @enderror only-numeric" name="grade_pay" value="{{ old('grade_pay') }}" required autocomplete="grade_pay" >

                                @error('grade_pay')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="authority_move" class="col-md-3 col-form-label text-md-right size">{{ __('Authority to Move/स्थानांतरित करने का अधिकार') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="authority_move" type="text" class="form-control @error('authority_move') is-invalid @enderror" name="authority_move" value="{{ old('authority_move') }}" required autocomplete="authority_move">

                                @error('authority_move')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      
                            <label for="temp_move" class="col-md-3 col-form-label text-md-right size">{{ __('Temporary Duty Move to/अस्थायी ड्यूटी यहां ले जाएं') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="temp_move" type="text" class="form-control @error('temp_move') is-invalid @enderror" name="temp_move" value="{{ old('temp_move') }}" required autocomplete="temp_move">

                                @error('temp_move')
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
                <div class="card-header">{{ __(' HOD Details') }}</div>
                
                <div class="card-body">

                <div class="form-group row">
                            <label for="hod_name" class="col-md-3 col-form-label text-md-right size">{{ __('Hod Name/विभागाध्यक्ष') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="hod_name" type="text" class="hod_name form-control @error('hod_name') is-invalid @enderror" name="hod_name" value="{{ $hodprofile->emp_nick_name }}" required autocomplete="hod_name" readonly>

                                @error('hod_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                            <label for="hod_designation" class="col-md-3 col-form-label text-md-right size">{{ __('Hod Designation/विभाग के प्रमुख का पदनाम') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="hod_designation" type="text" class="form-control @error('hod_designation') is-invalid @enderror" name="hod_designation" value="{{ $hodprofile->display_name }}" required autocomplete="hod_designation" readonly>

                                @error('hod_designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                         
                          

                            <div class="col-md-3">
                                <input id="hod_department" type="hidden" class="form-control @error('hod_department') is-invalid @enderror" name="hod_department" value="{{ $hodprofile->d_name }}" required autocomplete="hod_department" readonly>

                                @error('hod_department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <input id="dir_name" type="hidden" class="form-control @error('dir_name') is-invalid @enderror" name="dir_name" value="{{ $dirprofile->emp_nick_name }}" required autocomplete="dir_name" readonly>
                                <input id="hod_id" type="hidden" class="form-control @error('hod_id') is-invalid @enderror" name="hod_id" value="{{ $hodprofile->id }}" required autocomplete="hod_id" readonly>
                                <input id="dir_id" type="hidden" class="form-control @error('dir_id') is-invalid @enderror" name="dir_id" value="{{ $dirprofile->id }}" required autocomplete="dir_id" readonly>

                                @error('dir_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Apply') }}
                                </button>
                                <input type="button" onclick="history.go(-1);" value="Back" class="btn btn-danger">
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