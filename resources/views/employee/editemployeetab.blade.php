@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    
    'Admin' => '#',
    'Employee' => route('view-employee'),
    'Edit Employee' => route('add-employee'),
 
]])

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #066fcc;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 10px 10px;
    transition: 0.3s;
    font-size: 13px;
    color: #fff;
}

.tab button.active,.tab button:hover {
  color:#000;
}


/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}


/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
.tight-gutter {
        padding: 0 2px;
    }

</style>


<script>
$(document).ready(function(){
    $("#district_code").html();
    $("#defaultOpen").click();
    $("#basic_info").show();

    $(".tablinks").click(function(){
        var id_val = $(this).attr('id_attr');
        $(".tablinks").removeClass("active");
        $(this).addClass("active");
        $(".tabcontent").hide();
        $("#"+id_val).show();
    });

    var countryID = $('#operational_company_id').val();

    jQuery.ajax({ 
        url : 'add-employee/getlocation/' +countryID,
        type : "GET",
        dataType : "json",
        success:function(data)
        {
            alert(data);
       
        }
    });

    $.getJSON('/assets/countryList.json', function(json) {
        console.log(json);
        var op='<option>Choose</option>';
        for(var i=0;i<json.length;i++){
            op+='<option value="'+json[i].dial_code+'">'+json[i].dial_code+' - '+json[i].name+'</option>';
        }
        $("#work_country_code").html(op);
    });

    $.getJSON('/assets/countryList.json', function(json) {
        console.log(json);
        var op='<option>Choose</option>';
        for(var i=0;i<json.length;i++){
            op+='<option value="'+json[i].dial_code+'">'+json[i].dial_code+' - '+json[i].name+'</option>';
        }
        $("#country_code_mobile").html(op);
    });

    $.getJSON('/assets/countryList.json', function(json) {
        console.log(json);
        var op='<option>Choose</option>';
        for(var i=0;i<json.length;i++){
            op+='<option value="'+json[i].dial_code+'">'+json[i].dial_code+' - '+json[i].name+'</option>';
        }
        $("#country_code_home").html(op);
    });

    $("#state_code").change(function(){
        var val = $(this).val();
        $("#district_code").html('');
        var op='<option>Choose</option>';
        $("#district_code").append(op);
        jQuery.ajax({ 
            url : '/getdistrict/' +val,
            type : "GET",
            dataType : "json",
            success:function(data)
            {
                
                for(var i=0;i<data.length;i++){
                    op='<option value="'+data[i].id+'">'+data[i].district_name+'</option>';
                    $("#district_code").append(op);
                }
            }
        });
        
    });

    $("#operational_company_location_id").change(function(){
        var val = $(this).val();
        $("#operational_company_loc_dept_id").html('');
        var op='<option>Choose</option>';
        $("#operational_company_loc_dept_id").append(op);
        jQuery.ajax({ 
            url : '/getunit/' +val,
            type : "GET",
            dataType : "json",
            success:function(data)
            {
                
                for(var i=0;i<data.length;i++){
                    op='<option value="'+data[i].id+'">'+data[i].d_name+'</option>';
                    $("#operational_company_loc_dept_id").append(op);
                }
            }
        });
        
    });
});
</script>
<script>
$(document).ready(function() {
    $('.language').select2();
});
</script>

<div class="container_wrapper">
<div class="tab">
<button class="tablinks active" id_attr="basic_info">BASIC INFO</button>
  <button class="tablinks"  id_attr="personal_info">PERSONAL DETAILS</button>
  <button class="tablinks"  id_attr="family_info">FAMILY DETAILS</button>
  <button class="tablinks"  id_attr="education">EDUCATIONAL DETAILS</button>
  <button class="tablinks"  id_attr="team">TEAM DETAILS</button>
  <button class="tablinks"  id_attr="remuneration">REMUNERATION DETAILS</button>
  <button class="tablinks"  id_attr="skills">SKILL DETAILS</button> 
  <button class="tablinks"  id_attr="bank">BANK DETAILS</button>
  <button class="tablinks"  id_attr="promotion">PROMOTION DETAILS</button> 
  <button class="tablinks" id_attr="assets">OFFICE ASSETS</button>
  
  
 
</div>
<div id="app">
        @include('layouts.flash-message')


        @yield('content')
    </div>

<div id="basic_info" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">
           
            {{ __('EMPLOYEE ID') }} - {{ $employee->emp_code }}
					
        	
            </div>

                <div class="card-body">
                <form method="POST" action="{{ route('update-employee-info', $employee->id) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                       
                            <label for="emp_firstname" class="col-md-4 col-form-label text-md-right size">{{ __('First Name/पहला नाम') }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                          
                                <input id="emp_firstname" type="text" class="form-control @error('emp_firstname') is-invalid @enderror" name="emp_firstname" value="{{ $employee->emp_firstname }}" required autocomplete="emp_firstname" autofocus>
                                <input id="emp_code" type="hidden" class="form-control" name="emp_code" value=" {{ $employee->emp_code }}"  autocomplete="emp_code">
                                @error('emp_firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_middle_name" class="col-md-4 col-form-label text-md-right size">{{ __('Middle Name/मध्य नाम') }}</label>

                            <div class="col-md-8">
                                <input id="emp_middle_name" type="text" class="form-control" name="emp_middle_name" value="{{ $employee->emp_middle_name }}"  autocomplete="emp_middle_name" autofocus>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_lastname" class="col-md-4 col-form-label text-md-right size">{{ __('Last Name/अंतिम नाम') }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                                <input id="emp_lastname" type="text" class="form-control @error('emp_lastname') is-invalid @enderror" name="emp_lastname" value="{{ $employee->emp_lastname }}" required autocomplete="emp_lastname" autofocus>

                                @error('emp_lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_nick_name" class="col-md-4 col-form-label text-md-right size">{{ __('Display Name/प्रदर्शित होने वाला नाम') }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                                <input id="emp_nick_name" type="text" class="form-control @error('emp_nick_name') is-invalid @enderror" name="emp_nick_name" value="{{ $employee->emp_nick_name }}" required autocomplete="emp_nick_name" autofocus readonly>
                                <a href="{{ route('addemployee-image',[$employee->id]) }}" class="btn btn-xs btn-info">
                                    Add Employee Image</a>
                                @error('emp_nick_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cadre_id" class="col-md-4 col-form-label text-md-right size">{{ __('Cadre/संवर्ग') }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                              
                                <select  name="cadre_id" id="cadre_id" class="form-control @error('cadre_id') is-invalid @enderror" name="cadre_id" value="{{ $employee->cadre_id }}" required autocomplete="cadre_id">
                                @if($employee->cadre_id != null) 
                                @foreach($empcadre as $empcadres)
                                        <option value="{{$empcadres->cadre}}">{{$empcadres->cadre_type_name}}</option>
                                    @endforeach
                                    @else  
                                    <option value=""disable selected>Select Cadre</option>
                                        
                                @endif
                                 
                                    @foreach($cadre as $cadres)
                                        <option value="{{$cadres->id}}">{{$cadres->job_type}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('cadre_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="father_name" class="col-md-4 col-form-label text-md-right size">{{ __("Father's Name/पिता का नाम") }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                                <input id="father_name" type="text" class="form-control @error('father_name') is-invalid @enderror" name="father_name" value="{{ $employee->father_name }}" required autocomplete="father_name" autofocus>
                                
                                @error('father_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mother_name" class="col-md-4 col-form-label text-md-right size">{{ __("Mother's Name/मां का नाम") }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                                <input id="mother_name" type="text" class="form-control @error('mother_name') is-invalid @enderror" name="mother_name" value="{{ $employee->mother_name }}" required autocomplete="mother_name" autofocus>
                                
                                @error('mother_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="emp_street1" class="col-md-4 col-form-label text-md-right size">{{ __('Address/पता पंक्ति') }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                                <input id="emp_street1" type="text" class="form-control @error('emp_street1') is-invalid @enderror" name="emp_street1" value="{{ $employee->emp_street1 }}" required autocomplete="emp_street1" autofocus>

                                @error('emp_street1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_street2" class="col-md-4 col-form-label text-md-right size">{{ __('Home Town/गृहनगर') }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                                <input id="emp_street2" type="text" class="form-control" name="emp_street2" value="{{ $employee->emp_street2 }}"  autocomplete="emp_street2" autofocus>

                               
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city_code" class="col-md-4 col-form-label text-md-right size">{{ __('City/नगर') }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                                <input id="city_code" type="text" class="form-control @error('city_code') is-invalid @enderror" name="city_code" value="{{ $employee->city_code }}" required autocomplete="city_code" autofocus>

                                @error('city_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>
                        <div class="form-group row">
                            <label for="state_code" class="col-md-4 col-form-label text-md-right size">{{ __('State/राज्य') }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                             
                                <select  name="state_code" id="state_code" class="form-control @error('state_code') is-invalid @enderror" name="state_code" value="{{ $employee->state_code }}" required autocomplete="state_code">
                                 @if($employee->state_code != null) 
                                 @foreach($empstate as $empstates)
                                        <option value="{{$empstates->state_code_id}}">{{$empstates->state_nme}}</option>
                                    @endforeach
                                    @else  
                                    <option value=""disable selected>Select state</option>
                                        
                                @endif
                                
                                    @foreach ($state as $key => $value)
                               
                               <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach  
                                                                             
                                                     
                             </select>
                                @error('state_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="district_code" class="col-md-4 col-form-label text-md-right size">{{ __('District/जिला') }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                             
                                <select  name="district_code" id="district_code" class="form-control @error('district_code') is-invalid @enderror" name="district_code" value="{{ $employee->district_code }}" required autocomplete="district_code">
                                @if($employee->district_code != null) 
                                @foreach($empdistrict as $empdistricts)
                                        <option value="{{$empdistricts->district_code_id}}">{{$empdistricts->district_nme}}</option>
                                    @endforeach
                                    @else  
                                    <option value=""disable selected>Select District</option>
                                        
                                @endif
                               
                                                                           
                                                   
                             </select>
                                @error('district_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_pincode" class="col-md-4 col-form-label text-md-right size">{{ __('Pin Code/पिन कोड') }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                                <input id="emp_pincode" type="text" class="form-control @error('emp_pincode') is-invalid @enderror only-numeric" name="emp_pincode" value="{{ $employee->emp_pincode }}" required autocomplete="emp_pincode" maxlength="6" autofocus>

                                @error('emp_pincode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_work_email" class="col-md-4 col-form-label text-md-right size">{{ __('Office Mail Id/कार्यालय मेल आईडी') }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                                <input id="emp_work_email" type="email" class="form-control @error('emp_work_email') is-invalid @enderror" name="emp_work_email" value="{{ $employee->emp_work_email }}" required autocomplete="emp_work_email" readonly>

                                @error('emp_work_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                  
                        <div class="form-group row">
                            <label for="emp_work_telephone" class="col-md-4 col-form-label text-md-right size">{{ __('Office Contact Number/कार्यालय संपर्क नंबर') }}<span style="color:red"> *</span></label>

                        
                            <div class="col-md-8">
                                <input id="emp_work_telephone" type="text" class="form-control @error('emp_work_telephone') is-invalid @enderror only-numeric" name="emp_work_telephone" value="{{ $employee->emp_work_telephone }}" required autocomplete="emp_work_telephone" maxlength="8" autofocus>
                                @error('emp_work_telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                
                        </div>
                        <div class="form-group row">
                            <label for="emp_ofc_mobile" class="col-md-4 col-form-label text-md-right size">{{ __('Mobile No/मोबाइल नंबर') }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                                <input id="emp_ofc_mobile" type="text" class="form-control only-numeric" name="emp_ofc_mobile" value="{{ $employee->emp_ofc_mobile }}" required autocomplete="emp_ofc_mobile" maxlength="10" autofocus>
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_pan_num" class="col-md-4 col-form-label text-md-right size">{{ __('Pan No/पैन नंबर') }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                                <input id="emp_pan_num" type="text" class="form-control @error('emp_pan_num') is-invalid @enderror" name="emp_pan_num" value="{{ $employee->emp_pan_num }}" required autocomplete="emp_pan_num" maxlength="10" autofocus>
                                <a href="{{ route('addemployee-pan-doc',[$employee->id]) }}" class="btn btn-xs btn-info">
                                    Add Pan Card</a>
                                @error('emp_pan_num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right"> 
                                <button type="submit" class="btn btn-success">
                                    {{ __('Save') }}
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
<div id="personal_info" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                

                <div class="card-body">
                <form method="POST" action="{{ route('update-employee-personal', $employee->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="emp_oth_email" class="col-md-4 col-form-label text-md-right size">{{ __('Personal Mail Id/व्यक्तिगत मेल आईडी') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="emp_oth_email" type="email" class="form-control @error('emp_oth_email') is-invalid @enderror" name="emp_oth_email" value="{{ $employee->emp_oth_email }}" required autocomplete="emp_oth_email">

                                @error('emp_oth_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_mobile" class="col-md-4 col-form-label text-md-right size">{{ __('Personal Contact No/व्यक्तिगत संपर्क संख्या') }}</label><span style="color:red"> *</span>

                            
                            <div class="col-md-6">
                                <input id="emp_mobile" type="text" class="form-control @error('emp_mobile') is-invalid @enderror only-numeric" name="emp_mobile" value="{{ $employee->emp_mobile }}" required autocomplete="emp_mobile" maxlength="12" autofocus>
                                @error('emp_mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                
                        </div>
                        <div class="form-group row">
                            <label for="emp_birthday" class="col-md-4 col-form-label text-md-right size">{{ __('Date Of Birth/जन्म तारीख') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="emp_birthday" type="date" class="form-control @error('emp_birthday') is-invalid @enderror" name="emp_birthday" value="{{ $employee->emp_birthday }}" required autocomplete="emp_birthday" autofocus>

                                @error('emp_birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="emp_bloodgroup" class="col-md-4 col-form-label text-md-right size">{{ __('Employee Blood Group/कर्मचारी रक्त समूह') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            <select  name="emp_bloodgroup" id="emp_bloodgroup" class="form-control @error('emp_bloodgroup') is-invalid @enderror" name="emp_bloodgroup" value="{{ $employee->emp_bloodgroup }}" required autocomplete="emp_bloodgroup">
                            @if($employee->emp_bloodgroup != null) 
                            <option value="{{ $employee->emp_bloodgroup }}">{{ $employee->emp_bloodgroup }}</option> 
                                    @else  
                                    <option value=""disable selected>Select Blood Group</option>
                                        
                                @endif
                           
                                                       <option value='A+'>A+</option>
                                                        <option value='A-'>A-</option> 
                                                        <option value='B+'>B+</option> 
                                                        <option value='B-'>B-</option>
                                                        <option value='o-'>o-</option> 
                                                        <option value='o+'>o+</option> 
                                                        <option value='AB-'>AB-</option> 
                                                        <option value='AB+'>AB+</option>                                            
                                                     
                                                    </select>
                                                    <a href="{{ route('addemployee-blood-doc',[$employee->id]) }}" class="btn btn-xs btn-info">
                                    Add Blood Group Certificate</a>
                                @error('emp_bloodgroup')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_hm_telephone" class="col-md-4 col-form-label text-md-right size">{{ __('Emergency Contact No/आपातकालीन संपर्क नंबर') }}</label><span style="color:red"> *</span>

                           
                            <div class="col-md-6">
                                <input id="emp_hm_telephone" type="text" class="form-control @error('emp_hm_telephone') is-invalid @enderror only-numeric" name="emp_hm_telephone" value="{{ $employee->emp_hm_telephone }}" required autocomplete="emp_hm_telephone" maxlength="12" autofocus>
                                @error('emp_hm_telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                
                        </div>
                        <div class="form-group row">
                            <label for="emergency_contact_name" class="col-md-4 col-form-label text-md-right">{{ __('Emergency Contact Name/आपातकालीन संपर्क नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="emergency_contact_name" type="text" class="form-control @error('emergency_contact_name') is-invalid @enderror" name="emergency_contact_name" value="{{ $employee->emergency_contact_name }}" required autocomplete="emergency_contact_name" autofocus>

                                @error('emergency_contact_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="related_person" class="col-md-4 col-form-label text-md-right size">{{ __('Relation With The Person/व्यक्ति के साथ संबंध') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="related_person" type="text" class="form-control @error('related_person') is-invalid @enderror" name="related_person" value="{{ $employee->related_person }}" required autocomplete="related_person" autofocus>

                                @error('related_person')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_of_superannuation" class="col-md-4 col-form-label text-md-right size">{{ __('Date Of Superannuation/सेवानिवृत्ति की तारीख') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="date_of_superannuation" readonly type="text" class="form-control @error('date_of_superannuation') is-invalid @enderror" name="date_of_superannuation"  value="{!! \Carbon\Carbon::parse($employee->date_of_superannuation)->format('d M Y') !!}" required autocomplete="date_of_superannuation" autofocus>

                                @error('date_of_superannuation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_aadhar_num" class="col-md-4 col-form-label text-md-right size">{{ __('Aadhar Card/आधार कार्ड') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="emp_aadhar_num" type="text" class="form-control only-numeric" name="emp_aadhar_num" value="{{ $employee->emp_aadhar_num }}" required autocomplete="emp_aadhar_num" maxlength="12" autofocus>

                                <a href="{{ route('addemployee-addhar-doc',[$employee->id]) }}" class="btn btn-xs btn-info">
                                    Add Addhar Certificate</a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_gender" class="col-md-4 col-form-label text-md-right size">{{ __('Gender/लिंग') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                              
                                <select  name="emp_gender" id="emp_gender" class="form-control @error('emp_gender') is-invalid @enderror" name="emp_gender" value="{{ $employee->emp_gender }}" required autocomplete="emp_gender">
                                @if($employee->emp_gender != null) 
                                <option value="{{ $employee->emp_gender }}" >{{ $employee->emp_gender }}</option>
                                    @else  
                                    <option value=""disable selected>Select Gender</option>
                                        
                                @endif
                           
                               
                                                       <option value='Male'>Male</option>
                                                        <option value='Female'>Female</option>
                                                        <option value='Transgender'>Transgender</option>                                             
                                                     
                                 </select>
                                @error('emp_gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="caste" class="col-md-4 col-form-label text-md-right size">{{ __('Caste/जाति') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                              
                                <select  name="caste" id="caste" class="form-control @error('caste') is-invalid @enderror" name="caste" value="{{ $employee->caste }}" required autocomplete="caste">
                                @if($employee->caste != null) 
                                <option value="{{ $employee->caste }}" >{{ $employee->caste }}</option>
                                    @else  
                                    <option value=""disable selected>Select Caste</option>
                                        
                                @endif
                           
                                                       <option value='General'>General</option>
                                                       <option value='SC'>SC</option>
                                                        <option value='ST'>ST</option>
                                                        <option value='OBC-A'>OBC-A</option>                                             
                                                        <option value='OBC-B'>OBC-B</option> 
                                 </select>
                                 <a href="{{ route('addemployee-caste-doc',[$employee->id]) }}" class="btn btn-xs btn-info">
                                    Add Caste Certificate</a>
                                @error('caste')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="disability" class="col-md-4 col-form-label text-md-right size">{{ __('Disability/विकलांगता') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                              
                                <select  name="disability" id="disability" class="form-control @error('disability') is-invalid @enderror" name="disability" value="{{ $employee->disability }}" required autocomplete="disability">
                                @if($employee->disability != null) 
                                <option value="{{ $employee->disability }}" >{{ $employee->disability }}</option>
                                    @else  
                                    <option value=""disable selected>Select Disability</option>
                                        
                                @endif
                           
                               
                                                       <option value='Yes'>Yes</option>
                                                        <option value='No'>No</option>
                                                                                                 
                                                     
                                 </select>
                                 <a href="{{ route('addemployee-disable-doc',[$employee->id]) }}" class="btn btn-xs btn-info">
                                    Add Disability Certificate</a>
                                @error('disability')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
            
                        <div class="form-group row">
                            <label for="emp_marital_status" class="col-md-4 col-form-label text-md-right size">{{ __('Maritial Status/वैवाहिक स्थिति') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            <select  name="emp_marital_status" id="emp_marital_status" class="form-control @error('emp_marital_status') is-invalid @enderror" name="emp_marital_status" value="{{ $employee->emp_marital_status }}" required autocomplete="emp_marital_status">
                            @if($employee->emp_marital_status != null) 
                            <option value="{{ $employee->emp_marital_status }}" >{{ $employee->emp_marital_status }}</option>
                                    @else  
                                    <option value=""disable selected>Select Maritial Status</option>
                                        
                                @endif
                                                       <option value='Married'>Married</option>
                                                        <option value='Unmarried'>Unmarried</option> 
                                                        <option value='Widow'>Widow</option> 
                                                        <option value='Divorcee'>Divorcee</option>                                             
                                                     
                                                    </select>
                                @error('emp_marital_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="emp_religion_id" class="col-md-4 col-form-label text-md-right size">{{ __('Religion/धर्म') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                              
                                <select  name="emp_religion_id" id="emp_religion_id" class="form-control @error('emp_religion_id') is-invalid @enderror" name="emp_religion_id" value="{{ $employee->emp_religion_id }}" required autocomplete="emp_religion_id">
                                @if($employee->emp_religion_id != null) 
                                @foreach($empreligion as $empreligions)
                                        <option value="{{$empreligions->emp_religion}}">{{$empreligions->reli_name}}</option>
                                    @endforeach
                                    @else  
                                    <option value=""disable selected>Select Religion</option>
                                        
                                @endif
                                 
                                    @foreach($religion as $religions)
                                        <option value="{{$religions->id}}">{{$religions->name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('emp_religion_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_nationality_id" class="col-md-4 col-form-label text-md-right size">{{ __('Nationality/राष्ट्रीयता') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                             
                                <select  name="emp_nationality_id" id="emp_nationality_id" class="form-control @error('emp_nationality_id') is-invalid @enderror"  value="{{ $employee->emp_nationality_id }}" required autocomplete="emp_nationality_id">
                                @if($employee->emp_nationality_id != null) 
                                @foreach($empnationality as $empnationalitys)
                                        <option value="{{$empnationalitys->emp_nationality}}">{{$empnationalitys->nation_name}}</option>
                                    @endforeach
                                    @else  
                                    <option value=""disable selected>Select Nationality</option>
                                        
                                @endif
                               
                                    @foreach($nationality as $nationalitys)
                                        <option value="{{$nationalitys->id}}">{{$nationalitys->name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('emp_nationality_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_language" class="col-md-4 col-form-label text-md-right size">{{ __('Languages Known/ज्ञात भाषाएँ') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                             
                                <select style="width:100% !important" name="emp_language[]" id="emp_language" class="form-control @error('emp_language') is-invalid @enderror language"   required autocomplete="emp_language" multiple="multiple" >
                                
                                
                                
                                    
                                 @foreach($language as $languages) 
                                      
                                     @if(in_array($languages->lng_name, $lng))
                                        <option selected value="{{$languages->lng_name}}">{{$languages->lng_name}}</option>
                                    @else  
                                        <option  value="{{$languages->lng_name}}">{{$languages->lng_name}}</option>
                                        
                                    @endif 
                                @endforeach 
                                                                                                 
                                                     
                             </select>
                                @error('emp_language')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                     
                        <div class="form-group row">
                            <label for="emp_food_habit" class="col-md-4 col-form-label text-md-right size">{{ __('Food Habit/खाने की आदत') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">

                                <select  name="emp_food_habit" id="emp_food_habit" class="form-control @error('emp_food_habit') is-invalid @enderror"  value="{{ $employee->emp_food_habit }}" required autocomplete="emp_food_habit">
                                @if($employee->emp_food_habit != null) 
                                <option value="{{ $employee->emp_food_habit }}" >{{ $employee->emp_food_habit }}</option>
                                    @else  
                                    <option value=""disable selected>Select Food Habit</option>
                                        
                                @endif
                               
                                            <option value='Veg'>Veg</option>
                                            <option value='Non-Veg'>Non-Veg</option>
                                            <option value='Vegan'>Vegan</option>                                              
                                                     
                                 </select>
                                @error('emp_food_habit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Save') }}
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
<div id="family_info" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>Family Details</h2>
            </div>
            
            <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('addemployee-family-info',[$employee->id]) }}"><i class="fas fa-plus-square"></i></a>
            </div>
        </div>
            <div class="table-responsive">
           
        
               
            <table id="myTable" class="table table-bordered table-striped {{ count($empfamily) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        
                       
                        <th>Member Name <p>(सदस्य का नाम)</p></th>
                        <th>Date Of Birth<p>(जन्म की तारीख)</p></th>
                        <th>Contact No <p>(संपर्क नंबर)</p></th>
                        <th>Relation <p>(रिश्ता)</p></th>
                        <th>Aadhar No<p>(आधार नंबर)</p></th>
                        <th>Actions<p>(कार्रवाई)</p></th>
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($empfamily) > 0)
                        @foreach ($empfamily as $family)
                        
                            <tr data-entry-id="{{ $family->id }}">
                                <!-- <td></td> -->
                                
                                <td>{{ $family->member_name }}</td>
                                <td>{{ $family->dob }}</td>
                                <td>{{ $family->contact_no }}</td>
                                <td>{{ $family->relation }}</td>
                                <td>{{ $family->addhar_no }}</td>

                                
                             <td> <a href="{{ route('editemployee-family-info',[$family->id]) }}" class="btn btn-xs btn-info">
                                    <i class="fas fa-edit"></i></a></td>

                                  

                             
                            </tr>
                        
                            @endforeach
                    @else
                        <tr>
                            <td colspan="7">No entries in table</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
                        

                 </div>
            </div>
        </div>
    </div>
</div>

<div id="education" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>EDUCATION</h2>
            </div>
            
            <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('addemployee-education',[$employee->id]) }}"><i class="fas fa-plus-square"></i></a>
            </div>
        </div>
            <div class="table-responsive">
           
        
               
            <table id="myTable" class="table table-bordered table-striped {{ count($educationemployee) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        
                        <th>Degree Type<p>(उपाधि प्रकार)</p></th>
                        <th>Institute Name<p>(संस्थान का नाम)</p></th>
                        <th>Degree<p>(डिग्री)</p></th>
                        <th>Grade<p>(ग्रेड)</p></th>
                        <th>Passing Year<p>(बीतता वर्ष)</p></th>                        
                        <th>Actions<p>(कार्रवाई)</p></th>
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($educationemployee) > 0)
                        @foreach ($educationemployee as $education)
                        
                            <tr data-entry-id="{{ $education->id }}">
                                <!-- <td></td> -->
                                
                                <td>{{ $education->name }}</td>
                                <td>{{ $education->ins_name }}</td>
                                <td>{{ $education->degree }}</td>
                                <td>{{ $education->grade }}</td>
                                <td>{{ $education->year }}</td>

                                
                             <td> <a href="{{ route('editemployee-education',[$education->id]) }}" class="btn btn-xs btn-info">
                                    <i class="fas fa-edit"></i></a></td>

                            </tr>
                        
                            @endforeach
                    @else
                        <tr>
                            <td colspan="7">No entries in table</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
                        

                 </div>
            </div>
        </div>
    </div>
</div>
<div id="team" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              

                <div class="card-body">
                <form method="POST" action="{{ route('update-employee-teaminfo', $employee->id) }}" enctype="multipart/form-data">
                        @csrf

                <div class="form-group row">
                            <label for="operational_company_id" class="col-md-4 col-form-label text-md-right size">{{ __('Organization/संगठन') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                             
                          
                             @foreach($empcompany as $empcompanys)
                             <input id="operational_company_id" type="text" class="form-control @error('operational_company_id') is-invalid @enderror" name="" value="{{$empcompanys->company_name}}"  required autocomplete="operational_company_id" readonly>
                             <input id="operational_company_id" type="hidden" class="form-control @error('operational_company_id') is-invalid @enderror" name="operational_company_id" value="{{$empcompanys->operational_company}}"  required autocomplete="operational_company_id" readonly>       
                                      
                                    @endforeach
                                                                            
                         
                             <input id="emp_code" type="hidden" class="form-control @error('emp_code') is-invalid @enderror" name="emp_code" value="{{ $employee->emp_code }}"  autofocus>
                                @error('operational_company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="operational_company_location_id" class="col-md-4 col-form-label text-md-right size">{{ __('Location/संगठन स्थान') }} <span style="color:red"> *</span></label>
                            
                            <div class="col-md-6">
                               
                            <select  name="operational_company_location_id" id="operational_company_location_id" class="form-control @error('operational_company_location_id') is-invalid @enderror" value="{{ $employee->operational_company_location_id }}" required autocomplete="operational_company_location_id">
                            @if($employee->operational_company_location_id != null) 
                            @foreach($empcompanylocation as $empcompanylocations)
                                        <option value="{{$empcompanylocations->operational_company_loc}}">{{$empcompanylocations->location_name}}</option>
                                    @endforeach
                                    @else  
                                    <option value=""disable selected>Select Company Location</option>
                                        
                                @endif
                                
                                    @foreach ($companylocation as $companylocations)
                               
                                    <option value="{{$companylocations->id}}">{{$companylocations->l_name}}</option>
                              @endforeach                                        
                                                     
                             </select>
                                @error('operational_company_location_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="operational_company_location_id" class="col-md-2 col-form-label text-md-right"><a href="{{route('add-company-location')}}"> {{ __('Add Location') }}  </a></label>
                        </div>
                        <div class="form-group row">
                            <label for="operational_company_loc_dept_id" class="col-md-4 col-form-label text-md-right size">{{ __('Department/विभाग') }}<span style="color:red"> *</span></label>
                            <div class="col-md-6">   

                            <select  name="operational_company_loc_dept_id" id="operational_company_loc_dept_id" class="form-control @error('operational_company_loc_dept_id') is-invalid @enderror" value="{{ $employee->operational_company_loc_dept_id }}" required autocomplete="operational_company_loc_dept_id">
                            @if($employee->operational_company_loc_dept_id != null) 
                            @foreach($emplocationdepartment as $emplocationdepartments)
                                        <option value="{{$emplocationdepartments->operational_company_loc_dept}}">{{$emplocationdepartments->dept_name}}</option>
                                    @endforeach 
                                    @else  
                                    <option value=""disable selected>Select Department</option>
                                        
                                @endif 
                           
                                 @foreach ($locationdepartment as $key => $value)
                               
                               <option value="{{ $key }}">{{ $value }}</option>
                              @endforeach  
                                                                              
                                                     
                             </select>
                                @error('operational_company_loc_dept_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="operational_company_location_id" class="col-md-2 col-form-label text-md-right"><a href="{{route('add-company-location-subunit')}}"> {{ __('Add Subunit') }}  </a></label>

                        </div>
                     
                       
                        <div class="form-group row">
                            <label for="reporting_to" class="col-md-4 col-form-label text-md-right size">{{ __('Reporting To/को रिपोर्ट करेंगे') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                                
                                <select  name="reporting_to" id="reporting_to" class="form-control @error('reporting_to') is-invalid @enderror" name="reporting_to" value="{{ $employee->reporting_to }}" required autocomplete="reporting_to">
                                @if($employee->reporting_to != null) 
                                @foreach($empreporting as $empreportings)
                                        <option value="{{$empreportings->reporting}}">{{$empreportings->user_name}}</option>
                                    @endforeach 
                                    @else  
                                    <option value=""disable selected>Select Reporting</option>
                                        
                                @endif
                                
                                
                                    @foreach($reporting as $reportings)
                                        <option value="{{$reportings->u_id}}">{{$reportings->nick_name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('reporting_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="shift" class="col-md-4 col-form-label text-md-right size">{{ __('Shift/खिसक जाना') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">

                                <select  name="shift" id="shift" class="form-control @error('shift') is-invalid @enderror" name="shift" value="{{ $employee->shift }}" required autocomplete="shift">
                                
                                @if($employee->shift != null) 
                                @foreach($empshift as $empshifts)
                                        <option value="{{$empshifts->shift_id}}">{{$empshifts->work_name}}</option>
                                    @endforeach 
                                    @else  
                                    <option value=""disable selected>Select Shift</option>
                                        
                                @endif
                               
                                    @foreach($shift as $shifts)
                                        <option value="{{$shifts->id}}">{{$shifts->name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('shift')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="joined_date" class="col-md-4 col-form-label text-md-right size">{{ __('Date Of Joining/शामिल होने की तारीख') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                                <input id="joined_date" type="date" class="form-control @error('joined_date') is-invalid @enderror" name="joined_date" value="{{ $employee->joined_date }}" required autocomplete="joined_date">

                                @error('joined_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="emp_status_type" class="col-md-4 col-form-label text-md-right size">{{ __('Employee Status/कर्मचारी स्थिति') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                            <select  name="emp_status_type" id="emp_status_type" class="form-control @error('emp_status_type') is-invalid @enderror" name="emp_status_type" value="{{ $employee->emp_status_type }}" required autocomplete="emp_status_type">
                            @if($employee->emp_status_type != null) 
                            <option value="{{ $employee->emp_status_type }}">{{ $employee->emp_status_type }}</option> 
                                    @else  
                                    <option value=""disable selected>Select Status</option>
                                        
                                @endif
                           
                                                       <option value='Active'>Active</option>
                                                        <option value='Inactive'>Inactive</option> 
                                                        <option value='Dormant'>Dormant</option>                                            
                                                     
                                                    </select>
                                @error('emp_status_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_status" class="col-md-4 col-form-label text-md-right size">{{ __('Employee Type/कर्मचारी का प्रकार') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">

                                <select  name="emp_status" id="emp_status" class="form-control @error('emp_status') is-invalid @enderror" name="emp_status" value="{{ $employee->emp_status }}" required autocomplete="emp_status">
                                @if($employee->emp_status != null) 
                                @foreach($emptype as $emptypes)
                                        <option value="{{$emptypes->emp_status_id}}">{{$emptypes->emp_type_name_name}}</option>
                                    @endforeach 
                                    @else  
                                    <option value=""disable selected>Select Type</option>
                                        
                                @endif
                                 
                            
                                    @foreach($type as $types)
                                        <option value="{{$types->id}}">{{$types->emp_type_name}}</option>
                                    @endforeach 
                                                                                       
                                                     
                                 </select>
                                @error('emp_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                 
                        <div class="form-group row">
                            <label for="designation" class="col-md-4 col-form-label text-md-right size">{{ __('Designation/पद') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                             
                            
                    
                    @foreach($emprole as $emproles)
                    <input id="designation" type="text" class="form-control @error('designation') is-invalid @enderror" name="" value="{{$emproles->role_name}}"  required autocomplete="designation" readonly>
                    <input id="designation" type="hidden" class="form-control @error('designation') is-invalid @enderror" name="designation" value="{{$emproles->designation_id}}"  required autocomplete="designation" readonly>
                                     
                                    @endforeach 
                                

                                @error('designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="job_role" class="col-md-4 col-form-label text-md-right size">{{ __('Job Role/नौकरी भूमिका') }}</label>

                            <div class="col-md-6">
                               
                            <select  name="job_role" id="job_role" class="form-control" name="job_role" value="{{ $employee->job_role }}"  autocomplete="job_role">
                            @if($employee->job_role != null) 
                            @foreach($emprolecategory as $emprolecategorys)
                                        <option value="{{$emprolecategorys->job_role_id}}">{{$emprolecategorys->respname_name}}</option>
                                    @endforeach  
                                    @else  
                                    <option value=""disable selected>Select Job Role</option>
                                        
                                @endif
                            
                                    
                                 @foreach ($rolecategory as $rolecategorys)
                               
                                 <option value="{{$rolecategorys->id}}">{{$rolecategorys->respname}}</option>
                               @endforeach  
                                                                            
                                                     
                             </select>
                             
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Save') }}
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
<div id="remuneration" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                <form method="POST" action="{{ route('update-employee-salary', $employee->id) }}" enctype="multipart/form-data">
                        @csrf      
                        <div class="form-group row">
                            <label for="committed_amount" class="col-md-4 col-form-label text-md-right size">{{ __('Basic Pay/मूल वेतन') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="committed_amount" type="text" class="form-control @error('committed_amount') is-invalid @enderror only-numeric" name="committed_amount" value="{{ $employee->committed_amount }}" required autocomplete="committed_amount" autofocus>
                                
                                @error('committed_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="ctc_per_month" class="col-md-4 col-form-label text-md-right size">{{ __('Dearness Allowance/महंगाई भत्ता') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="ctc_per_month" type="text" class="form-control @error('ctc_per_month') is-invalid @enderror only-numeric" name="ctc_per_month" value="{{ $employee->ctc_per_month }}" required autocomplete="ctc_per_month" autofocus>

                                @error('ctc_per_month')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="esi_number" class="col-md-4 col-form-label text-md-right size">{{ __('House Rent Allowance/मकान किराया भत्ता') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="esi_number" type="text" class="form-control @error('esi_number') is-invalid @enderror" name="esi_number" value="{{ $employee->esi_number }}" required autocomplete="esi_number" autofocus>

                                @error('esi_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pf_uan_no" class="col-md-4 col-form-label text-md-right size">{{ __('PF UAN NO/पीएफ यूएएन नंबर') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="pf_uan_no" type="text" class="form-control @error('pf_uan_no') is-invalid @enderror" name="pf_uan_no" value="{{ $employee->pf_uan_no }}" required autocomplete="pf_uan_no">

                                @error('pf_uan_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pf_no" class="col-md-4 col-form-label text-md-right size">{{ __('PF NO/पीएफ यूएएन नंबर') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="pf_no" type="text" class="form-control @error('pf_no') is-invalid @enderror" name="pf_no" value="{{ $employee->pf_no }}" required autocomplete="pf_no">

                                @error('pf_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ctc_per_annum" class="col-md-4 col-form-label text-md-right size">{{ __('Non performing Asset/अनर्जक परिसंपत्ति') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="ctc_per_annum" type="text" class="form-control @error('ctc_per_annum') is-invalid @enderror only-numeric" name="ctc_per_annum" value="{{ $employee->ctc_per_annum }}" required autocomplete="ctc_per_annum">

                                @error('ctc_per_annum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="payroll_org" class="col-md-4 col-form-label text-md-right size">{{ __('DA-TPT Allowance/डीए-टीपीटी भत्ता') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="payroll_org" type="text" class="form-control @error('payroll_org') is-invalid @enderror" name="payroll_org" value="{{ $employee->payroll_org }}" required autocomplete="payroll_org">

                                @error('payroll_org')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pf_effective_date" class="col-md-4 col-form-label text-md-right size">{{ __('VAR INCR/वार इनसीआर') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="pf_effective_date" type="text" class="form-control @error('pf_effective_date') is-invalid @enderror" name="pf_effective_date" value="{{ $employee->pf_effective_date }}" required autocomplete="pf_effective_date">

                                @error('pf_effective_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Save') }}
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

<div id="skills" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

             
                <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>SKILLS</h2>
            </div>
            
            <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('addemployee-skills',[$employee->id]) }}"><i class="fas fa-plus-square"></i></a>
            </div>
        </div>
            <div class="table-responsive">
           
        
               
            <table id="myTable" class="table table-bordered table-striped {{ count($skillemployee) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        
                        <th>Employee Skill <p>(कर्मचारी कौशल)</p></th>
                        <th>Skill Grade <p>(कौशल ग्रेड)</p></th>

                        <th>Actions <p>(कार्रवाई)</p></th>
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($skillemployee) > 0)
                        @foreach ($skillemployee as $education)
                        
                            <tr data-entry-id="{{ $education->id }}">
                                <!-- <td></td> -->
                                
                                <td>{{ $education->name }}</td>
                                <td>{{ $education->skill_grade }}</td>
                                

                                
                             <td> <a href="{{ route('editemployee-skills',[$education->id]) }}" class="btn btn-xs btn-info">
                                    <i class="fas fa-edit"></i></a></td>


                            </tr>
                        
                            @endforeach
                    @else
                        <tr>
                            <td colspan="7">No entries in table</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
                        

                      
                </div>
            </div>
        </div>
    </div>
</div>

<div id="bank" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                   
                <form method="POST" action="{{ route('update-employee-bank', $employee->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="acnt_holder_name" class="col-md-4 col-form-label text-md-right size">{{ __('Account Holder Name/खाता धारक का नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="acnt_holder_name" type="text" class="form-control @error('acnt_holder_name') is-invalid @enderror" name="acnt_holder_name" value="{{ $employee->acnt_holder_name }}" required autocomplete="acnt_holder_name" autofocus>

                                @error('acnt_holder_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bank_name" class="col-md-4 col-form-label text-md-right size">{{ __('Bank Name/बैंक का नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="bank_name" type="text" class="form-control @error('bank_name') is-invalid @enderror" name="bank_name" value="{{ $employee->bank_name }}" required autocomplete="bank_name">

                                @error('bank_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="branch_name" class="col-md-4 col-form-label text-md-right size">{{ __('Branch Name/शाखा का नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="branch_name" type="text" class="form-control @error('branch_name') is-invalid @enderror" name="branch_name" value="{{ $employee->branch_name }}" required autocomplete="branch_name">

                                @error('branch_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="account_number" class="col-md-4 col-form-label text-md-right size">{{ __('Account No/खाता नंबर') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="account_number" type="text" class="form-control @error('account_number') is-invalid @enderror only-numeric" name="account_number" value="{{ $employee->account_number }}" required autocomplete="account_number">

                                @error('account_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="neft_code" class="col-md-4 col-form-label text-md-right size">{{ __('Neft Code/एनईएफटी कोड') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="neft_code" type="text" class="form-control @error('neft_code') is-invalid @enderror" name="neft_code" value="{{ $employee->neft_code }}" required autocomplete="neft_code">

                                @error('neft_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ifsc_code" class="col-md-4 col-form-label text-md-right size">{{ __('Ifsc Code/आईएफएससी कोड') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="ifsc_code" type="text" class="form-control @error('ifsc_code') is-invalid @enderror" name="ifsc_code" value="{{ $employee->ifsc_code }}" required autocomplete="ifsc_code">

                                @error('ifsc_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Save') }}
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
<div id="promotion" class="tabcontent">
   <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                            

                <div class="card-body">

                <div class="panel panel-default">
                <div class="panel-body">
                <div class="row">
                <div class="form-group col-md-6">
                <h2>PROMOTION</h2>
                </div>

                <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('addemployee-promotion',[$employee->id]) }}"><i class="fas fa-plus-square"></i></a>
                </div>
                </div>
                <div class="table-responsive">



            <table id="myTable" class="table table-bordered table-striped {{ count($promotionemployee) > 0 ? 'datatable' : '' }} pointer">
                <thead>
                <tr>
                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                    
                    <th>Promotion Date <p>(पदोन्नति तारीख)</p></th>
                    <th>Effective From <p>(से प्रभावी)</p></th>
                    <th>Last Designation <p>(अंतिम पदनाम)</p></th>
                    <th>Last Salary<p>(आखरी तनख्वा)</p></th>
                    
                    
                    <th>Actions<p>(कार्रवाई)</p></th>
                </tr>
                </thead>

                <tbody>
                @if (count($promotionemployee) > 0)
                    @foreach ($promotionemployee as $promotion)
                    
                        <tr data-entry-id="{{ $promotion->id }}">
                            <!-- <td></td> -->
                            
                            <td>{{ $promotion->promotion_date }}</td>
                            <td>{{ $promotion->effective_from }}</td>
                            <td>{{ $promotion->name}}</td>
                            <td>{{ $promotion->last_salary }}</td>
                            

                            
                        <td> <a href="{{ route('editemployee-promotion',[$promotion->id]) }}" class="btn btn-xs btn-info">
                                <i class="fas fa-edit"></i></a></td>

                        </tr>
                    
                        @endforeach
                @else
                    <tr>
                        <td colspan="7">No entries in table</td>
                    </tr>
                @endif
                </tbody>
            </table>

                 </div>
                </div>
             </div>
                    

          </div>
        </div>
      </div>
    </div>
 </div>

<div id="assets" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>OFFICE ASSETS</h2>
            </div>
            <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('addemployee-assets',[$employee->id]) }}"><i class="fas fa-plus-square"></i></a>
            </div>
            
        </div>
            <div class="table-responsive">
           
        
               
            <table id="myTable" class="table table-bordered table-striped {{ count($assets) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        
                        <th>Assets Name<p>(संपत्ति का नाम)</p></th>
                        <th>Assets Details<p>(संपत्ति विवरण)</p></th>
                        <th>Giving Date<p>(तारीख देना)</p></th>
                        <th>Return Date<p>(वापसी दिनांक)</p></th>
                        <th>Return Assets Condition<p>(वापसी आस्तियों की स्थिति)</p></th>
                        <th>Issuer<p>(जारीकर्ता)</p></th>
                        
                        <th>Actions<p>(कार्रवाई)</p></th>
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($assets) > 0)
                        @foreach ($assets as $employee)
                        
                            <tr data-entry-id="{{ $employee->id }}">
                                <!-- <td></td> -->
                                
                                <td>{{ $employee->assets_name }}</td>
                                <td>{{ $employee->assets_details }}</td>
                                <td>{{ $employee->giving_date }}</td>
                                <td>{{ $employee->return_date }}</td>
                                <td>{{ $employee->return_property_conditions }}</td>
                                <td>{{ $employee->issuer }}</td>

                                
                             <td> <a href="{{ route('editemployee-assets',[$employee->id]) }}" class="btn btn-xs btn-info">
                                    <i class="fas fa-edit"></i></a>

                               </td>
                            </tr>
                        
                            @endforeach
                    @else
                        <tr>
                            <td colspan="7">No entries in table</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
  
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@include('footerimport')
@endsection

 





