@extends('adminlte::page')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    
    'My Profile' => '#',
    
 
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
    font-size: 12px;
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
    $("#defaultOpen").click();
    $("#basic_info").show();

    $(".tablinks").click(function(){
        var id_val = $(this).attr('id_attr');
        $(".tablinks").removeClass("active");
        $(this).addClass("active");
        $(".tabcontent").hide();
        $("#"+id_val).show();
    });
});
</script>
<div class="container_wrapper">
<div class="tab">
<button class="tablinks active" id_attr="basic_info">BASIC INFO</button>
  <button class="tablinks"  id_attr="personal_info">PERSONAL INFO</button>
  <button class="tablinks"  id_attr="education">EDUCATION</button>
  <button class="tablinks"  id_attr="team">TEAM</button>
  <button class="tablinks"  id_attr="remuneration">REMUNERATION</button>
  <button class="tablinks"  id_attr="skills">SKILLS</button> 
  <button class="tablinks"  id_attr="bank">BANK INFO</button>
  <button class="tablinks"  id_attr="promotion">PROMOTION</button> 
  <button class="tablinks" id_attr="assets">OFFICE ASSETS</button>
  <button class="tablinks"  id_attr="my_leave">LEAVE</button> 
 
  
  
 
</div>

<div id="basic_info" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('EMPLOYEE ID') }} - {{ $myprofile->emp_code }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('my-info-tab-update') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="emp_firstname" class="col-md-4 col-form-label text-md-right size">{{ __('FIRST NAME/पहला नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="emp_firstname" type="text" class="form-control @error('emp_firstname') is-invalid @enderror" name="emp_firstname" value="{{ $myprofile->emp_firstname }}" required autocomplete="emp_firstname" autofocus readonly>

                                @error('emp_firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="emp_middle_name" class="col-md-4 col-form-label text-md-right size">{{ __('MIDDLE NAME/मध्य नाम') }}</label>

                            <div class="col-md-6">
                                <input id="emp_middle_name" type="text" class="form-control" name="emp_middle_name" value="{{ $myprofile->emp_middle_name }}" required autocomplete="emp_middle_name" autofocus readonly>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_lastname" class="col-md-4 col-form-label text-md-right size">{{ __('LAST NAME/अंतिम नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="emp_lastname" type="text" class="form-control @error('emp_lastname') is-invalid @enderror" name="emp_lastname" value="{{ $myprofile->emp_lastname }}" required autocomplete="emp_lastname" autofocus readonly>

                                @error('emp_lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_nick_name" class="col-md-4 col-form-label text-md-right size">{{ __('DISPLAY NAME/प्रदर्शित होने वाला नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="emp_nick_name" type="text" class="form-control @error('emp_nick_name') is-invalid @enderror" name="emp_nick_name" value="{{ Auth::user()->name }}" required autocomplete="emp_nick_name" autofocus readonly>

                                @error('emp_nick_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right size">{{ __('ADDRESS/पता पंक्ति') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="emp_street1" value="{{ $myprofile->emp_street1 }}" required autocomplete="address" readonly>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_street2" class="col-md-4 col-form-label text-md-right size">{{ __('HOME TOWN/गृहनगर') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="emp_street2" type="text" class="form-control @error('emp_street2') is-invalid @enderror" name="emp_street2" value="{{ $myprofile->emp_street2 }}" required autocomplete="address" readonly>

                                @error('emp_street2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_work_email" class="col-md-4 col-form-label text-md-right size">{{ __('OFFICE MAIL ID/कार्यालय मेल आईडी') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="emp_work_email" type="email" class="form-control @error('emp_work_email') is-invalid @enderror" name="emp_work_email" value="{{ Auth::user()->email }}" required autocomplete="emp_work_email" readonly>

                                @error('emp_work_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_mobile" class="col-md-4 col-form-label text-md-right size">{{ __('OFFICE CONTACT NO/कार्यालय संपर्क नंबर') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="emp_mobile" type="number" class="form-control @error('emp_mobile') is-invalid @enderror" name="emp_mobile" value="{{ $myprofile->emp_mobile }}" required autocomplete="emp_mobile" readonly>

                                @error('emp_mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_pan_num" class="col-md-4 col-form-label text-md-right size">{{ __('PAN NO/पैन नंबर') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="emp_pan_num" type="text" class="form-control @error('emp_pan_num') is-invalid @enderror" name="emp_pan_num" value="{{ $myprofile->emp_pan_num }}" required autocomplete="emp_pan_num" readonly>

                                @error('emp_pan_num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_img" class="col-md-4 col-form-label text-md-right size">{{ __('IMAGE/छवि') }}</label>

                            <div class="col-md-6">
                             
                            <img src="{{url('assets/images')}}/{{$myprofile->emp_img}}" width="100" class="img-circle img-left">
                                
                                @error('emp_img')
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

<div id="personal_info" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">{{ __('EMPLOYEE ID') }} - {{ $myprofile->emp_code }}</div>

                <div class="card-body">
                <div class="form-group row">
                            <label for="emp_oth_email" class="col-md-4 col-form-label text-md-right size">{{ __('PERSONAL MAIL ID/व्यक्तिगत मेल आईडी') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="emp_oth_email" type="email" class="form-control @error('emp_oth_email') is-invalid @enderror" name="emp_oth_email" value="{{ $myprofile->emp_oth_email }}" required autocomplete="emp_oth_email" readonly>

                                @error('emp_oth_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_mobile" class="col-md-4 col-form-label text-md-right size">{{ __('PERSONAL CONTACT NO/व्यक्तिगत संपर्क संख्या') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="emp_mobile" type="number" class="form-control @error('emp_mobile') is-invalid @enderror" name="emp_mobile" value="{{ $myprofile->emp_mobile }}" required autocomplete="emp_mobile" readonly>

                                @error('emp_mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                
                       
                        <div class="form-group row">
                            <label for="emp_birthday" class="col-md-4 col-form-label text-md-right size">{{ __('DATE OF BIRTH/जन्म की तारीख') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="emp_birthday" type="date" class="form-control @error('emp_birthday') is-invalid @enderror" name="emp_birthday" value="{{ $myprofile->emp_birthday }}" required autocomplete="emp_birthday" autofocus readonly> 

                                @error('emp_birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_bloodgroup" class="col-md-4 col-form-label text-md-right size">{{ __('BLOOD GROUP/रक्त समूह') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="emp_bloodgroup" type="text" class="form-control @error('emp_bloodgroup') is-invalid @enderror" name="emp_bloodgroup" value="{{ $myprofile->emp_bloodgroup }}" required autocomplete="emp_bloodgroup" autofocus readonly>

                                @error('emp_bloodgroup')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_hm_telephone" class="col-md-4 col-form-label text-md-right size">{{ __('EMERGENCY CONTACT NO/आपातकालीन संपर्क नंबर') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="emp_hm_telephone" type="number" class="form-control @error('emp_hm_telephone') is-invalid @enderror" name="emp_hm_telephone" value="{{ $myprofile->emp_hm_telephone }}" required autocomplete="emp_hm_telephone" readonly>

                                @error('emp_hm_telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="relation_person" class="col-md-4 col-form-label text-md-right size">{{ __('RELATION WITH THE PERSON/व्यक्ति के साथ संबंध') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="relation_person" type="text" class="form-control @error('relation_person') is-invalid @enderror" name="relation_person" value="{{ $myprofile->related_person }}" required autocomplete="relation_person" autofocus readonly>

                                @error('relation_person')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_aadhar_num" class="col-md-4 col-form-label text-md-right size">{{ __('ADHAAR CARD/आधार कार्ड') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="emp_aadhar_num" type="text" class="form-control @error('emp_aadhar_num') is-invalid @enderror" name="emp_aadhar_num" value="{{ $myprofile->emp_aadhar_num }}" required autocomplete="emp_aadhar_num" autofocus readonly>

                                @error('emp_aadhar_num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_gender" class="col-md-4 col-form-label text-md-right size">{{ __('GENDER/लिंग') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                              
                                                                                                  
                                <input id="emp_gender" type="text" class="form-control @error('emp_gender') is-invalid @enderror" name="emp_gender" value="{{ $myprofile->emp_gender }}" required autocomplete="emp_gender" autofocus readonly>                    
                               
                                @error('emp_gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_marital_status" class="col-md-4 col-form-label text-md-right size">{{ __('MARITAL STATUS/वैवाहिक स्थिति') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                                                 
                            <input id="emp_marital_status" type="text" class="form-control @error('emp_marital_status') is-invalid @enderror" name="emp_marital_status" value="{{ $myprofile->emp_marital_status }}" required autocomplete="emp_marital_status" autofocus readonly>                     
                                                   
                                @error('emp_marital_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="emp_religion_id" class="col-md-4 col-form-label text-md-right size">{{ __('RELIGION/धर्म') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            @if($myprofile->emp_religion_id != null) 
                                
                                    @foreach($religion as $religions)
                                    <input id="emp_religion_id" type="text" class="form-control @error('emp_religion_id') is-invalid @enderror" name="emp_religion_id" value="{{$religions->reli_name}}" required autocomplete="emp_religion_id" autofocus readonly> 
                                       
                                    @endforeach  
                                    @else  
                                    <input id="emp_religion_id" type="text" class="form-control @error('emp_religion_id') is-invalid @enderror" name="emp_religion_id" value="" required autocomplete="emp_religion_id" autofocus readonly> 
                                       
                                @endif                                          
                                                     
                              
                                                 
                                @error('emp_religion_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_nationality_id" class="col-md-4 col-form-label text-md-right size">{{ __('NATIONALITY/राष्ट्रीयता') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            @if($myprofile->emp_nationality_id != null) 
                                
                                    @foreach($nationality as $nationalitys)
                                    <input id="emp_nationality_id" type="text" class="form-control @error('emp_nationality_id') is-invalid @enderror" name="emp_nationality_id" value="{{$nationalitys->nation_name}}" required autocomplete="emp_nationality_id" autofocus readonly> 
                                       
                    
                                    @endforeach  
                                    @else  
                                    <input id="emp_nationality_id" type="text" class="form-control @error('emp_nationality_id') is-invalid @enderror" name="emp_nationality_id" value="" required autocomplete="emp_nationality_id" autofocus readonly> 
                                        
                                @endif                                             
                                                     
                             
                                @error('emp_nationality_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                       
                        
                        <div class="form-group row">
                            <label for="emp_language" class="col-md-4 col-form-label text-md-right size">{{ __('LANGUAGES KNOWN/ज्ञात भाषाएँ') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
  
                             <input id="emp_language" type="text" class="form-control @error('emp_language') is-invalid @enderror" name="emp_language" value="{{$arrlanguages}}" required autocomplete="emp_language" autofocus readonly> 
                                @error('emp_language')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_food_habit" class="col-md-4 col-form-label text-md-right size">{{ __('FOOD HABIT/खाने की आदत') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
    
                              <input id="emp_food_habit" type="text" class="form-control @error('emp_food_habit') is-invalid @enderror" name="emp_food_habit" value="{{ $myprofile->emp_food_habit }}" required autocomplete="emp_food_habit" autofocus readonly> 
                                @error('emp_food_habit')
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

<div id="education" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              
            <div class="card-header">{{ __('EMPLOYEE ID') }} - {{ $myprofile->emp_code }}</div>
                <div class="card-body">
                    
               
                <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>EDUCATION</h2>
            </div>
            
            
        </div>
            <div class="table-responsive">
           
        
               
            <table id="myTable" class="table table-bordered table-striped {{ count($educationemployee) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        
                        <th>DEGREE TYPE<p>(उपाधि प्रकार)</p></th>
                        <th>INSTITUTE NAME<p>(संस्थान का नाम)</p></th>
                        <th>DEGREE<p>(डिग्री)</p></th>
                        <th>GRADE<p>(ग्रेड)</p></th>
                        <th>PASSING YEAR<p>(बीतता वर्ष)</p></th>
                        
                        
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
                
            <div class="card-header">{{ __('EMPLOYEE ID') }} - {{ $myprofile->emp_code }}</div>
                <div class="card-body">
                <div class="form-group row">
                            <label for="operational_company_id" class="col-md-4 col-form-label text-md-right size">{{ __('ORGANIZATION/संगठन') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                             
                            
                            @foreach ($company as $companys)
                            <input id="operational_company_id" type="text" class="form-control @error('operational_company_id') is-invalid @enderror" name="operational_company_id" value="{{$companys->company_name}}" required autocomplete="operational_company_id" autofocus readonly> 
                               
                            
                                @endforeach                                            
                                                     
                         
                                @error('operational_company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                <div class="form-group row">
                            <label for="operational_company_loc_dept_id" class="col-md-4 col-form-label text-md-right size">{{ __('DEPARTMENTS/विभाग') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">   
                            @if($myprofile->operational_company_loc_dept_id != null) 
                            @foreach ($locationdepartment as $locationdepartments)
                            <input id="operational_company_loc_dept_id" type="text" class="form-control @error('operational_company_loc_dept_id') is-invalid @enderror" name="operational_company_loc_dept_id" value="{{$locationdepartments->dept_name}}" required autocomplete="operational_company_loc_dept_id" autofocus readonly> 

                                   @endforeach 
                                   @else  
                                   <input id="operational_company_loc_dept_id" type="text" class="form-control @error('operational_company_loc_dept_id') is-invalid @enderror" name="operational_company_loc_dept_id" value="" required autocomplete="operational_company_loc_dept_id" autofocus readonly> 
  
                                @endif 
                        
                                @error('operational_company_loc_dept_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reporting_to" class="col-md-4 col-form-label text-md-right size">{{ __('REPORTING TO/को रिपोर्ट करेंगे') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            @foreach($reporting as $reportings)
                               
                            <input id="reporting_to" type="text" class="form-control @error('reporting_to') is-invalid @enderror" name="reporting_to" value="{{ $reportings->user_name }}" required autocomplete="reporting_to" readonly>

                                @endforeach 
                              
                                @error('reporting_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="operational_company_location_id" class="col-md-4 col-form-label text-md-right size">{{ __('LOCATION/संगठन स्थान') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            @if($myprofile->operational_company_location_id != null) 
                             @foreach ($companylocation as $companylocations)
                             <input id="operational_company_location_id" type="text" class="form-control @error('operational_company_location_id') is-invalid @enderror" name="operational_company_location_id" value="{{$companylocations->location_name}}" required autocomplete="operational_company_location_id" autofocus readonly> 

                            @endforeach 
                            @else  
                            <input id="operational_company_location_id" type="text" class="form-control @error('operational_company_location_id') is-invalid @enderror" name="operational_company_location_id" value="" required autocomplete="operational_company_location_id" autofocus readonly> 

                                @endif 
                                                                            
                                                     
                          
                                @error('operational_company_location_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
            
                       
                     
                        <div class="form-group row">
                            <label for="shift" class="col-md-4 col-form-label text-md-right size">{{ __('SHIFT/खिसक जाना') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            @if($myprofile->shift != null) 
                                 @foreach($shift as $shifts)
                                    <input id="shift" type="text" class="form-control @error('shift') is-invalid @enderror" name="shift" value="{{$shifts->work_name}}" required autocomplete="shift" autofocus readonly> 
 
                                    @endforeach  
                                    @else  
                                    <input id="shift" type="text" class="form-control @error('shift') is-invalid @enderror" name="shift" value="" required autocomplete="shift" autofocus readonly> 
 
                                @endif                                          
                   
                                @error('shift')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="joined_date" class="col-md-4 col-form-label text-md-right size">{{ __('DATE OF JOINING/शामिल होने की तारीख') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="joined_date" type="date" class="form-control @error('joined_date') is-invalid @enderror" name="joined_date" value="{{ $myprofile->joined_date }}" required autocomplete="joined_date" readonly>

                                @error('joined_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_status" class="col-md-4 col-form-label text-md-right size">{{ __('EMPLOYEE STATUS/कर्मचारी स्थिति') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            @if($myprofile->emp_status != null) 
                                  @foreach($type as $types)

                                    <input id="emp_status" type="text" class="form-control @error('emp_status') is-invalid @enderror" name="emp_status" value="{{$types->emp_type_name_name}}" required autocomplete="emp_status" autofocus readonly> 
                              
                                    @endforeach 
                                    @else  
                                    <input id="emp_status" type="text" class="form-control @error('emp_status') is-invalid @enderror" name="emp_status" value="" required autocomplete="emp_status" autofocus readonly> 
                              
                                @endif 
  
                                @error('emp_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_status_type" class="col-md-4 col-form-label text-md-right size">{{ __('EMPLOYEE TYPE/कर्मचारी का प्रकार') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                          
                            <input id="emp_status_type" type="text" class="form-control @error('emp_status_type') is-invalid @enderror" name="emp_status_type" value="{{ $myprofile->emp_status_type }}" required autocomplete="emp_status_type" autofocus readonly> 
                                @error('emp_status_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="org_age" class="col-md-4 col-form-label text-md-right size">{{ __('ORGANISATION AGE/संगठन की उम्र') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="org_age" type="date" class="form-control @error('org_age') is-invalid @enderror" name="org_age" value="{{ $myprofile->org_age }}" required autocomplete="org_age" readonly>

                                @error('org_age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="designation" class="col-md-4 col-form-label text-md-right size">{{ __('DESIGNATION/पद') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            
                           @foreach($roles as $role)
                               <input id="designation" type="text" class="form-control @error('designation') is-invalid @enderror" name="emp_status" value="{{$role->role_name}}" required autocomplete="designation" autofocus readonly> 
                              
                            @endforeach                                            
                             
                                @error('designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="job_role" class="col-md-4 col-form-label text-md-right size">{{ __('JOB ROLE/नौकरी भूमिका') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                               
                            @if($myprofile->job_role != null) 
                            @foreach($rolecategory as $rolecategorys)
                            <input id="job_role" type="text" class="form-control @error('job_role') is-invalid @enderror" name="job_role" value="{{$rolecategorys->respname_name}}" required autocomplete="job_role" autofocus readonly> 
                              
                                       
                                    @endforeach  
                                    @else  
                                    <input id="job_role" type="text" class="form-control @error('job_role') is-invalid @enderror" name="job_role" value="" required autocomplete="job_role" autofocus readonly> 
                             
                                @endif 
     
                                @error('job_role')
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
<div id="remuneration" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">{{ __('EMPLOYEE ID') }} - {{ $myprofile->emp_code }}</div>
                <div class="card-body">

                        <div class="form-group row">
                            <label for="committed_amount" class="col-md-4 col-form-label text-md-right size">{{ __('COMMITTED AMOUNT/प्रतिबद्ध राशि') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="committed_amount" type="text" class="form-control @error('committed_amount') is-invalid @enderror" name="committed_amount" value="{{ $myprofile->committed_amount }}" required autocomplete="committed_amount" autofocus readonly>
                                
                                @error('committed_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="ctc_per_month" class="col-md-4 col-form-label text-md-right size">{{ __('CTC PER MONTH/सीटीसी प्रति माह') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="ctc_per_month" type="text" class="form-control @error('ctc_per_month') is-invalid @enderror" name="ctc_per_month" value="{{ $myprofile->ctc_per_month }}" required autocomplete="ctc_per_month" autofocus readonly>

                                @error('ctc_per_month')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="esi_number" class="col-md-4 col-form-label text-md-right size">{{ __('ESI NO/एसी नंबर') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="esi_number" type="text" class="form-control @error('esi_number') is-invalid @enderror" name="esi_number" value="{{ $myprofile->esi_number }}" required autocomplete="esi_number" autofocus readonly>

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
                                <input id="pf_uan_no" type="text" class="form-control @error('pf_uan_no') is-invalid @enderror" name="pf_uan_no" value="{{ $myprofile->pf_uan_no }}" required autocomplete="pf_uan_no" readonly>

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
                                <input id="pf_no" type="text" class="form-control @error('pf_no') is-invalid @enderror" name="pf_no" value="{{ $myprofile->pf_no }}" required autocomplete="pf_no" readonly>

                                @error('pf_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ctc_per_annum" class="col-md-4 col-form-label text-md-right size">{{ __('CTC PER ANNUM/एक वर्ष के लिए सीटीसी') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="ctc_per_annum" type="text" class="form-control @error('ctc_per_annum') is-invalid @enderror" name="ctc_per_annum" value="{{ $myprofile->ctc_per_annum }}" required autocomplete="ctc_per_annum" readonly>

                                @error('ctc_per_annum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="payroll_org" class="col-md-4 col-form-label text-md-right size">{{ __('PAYROLL ORGANISATION/पेरोल संगठन') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="payroll_org" type="text" class="form-control @error('payroll_org') is-invalid @enderror" name="payroll_org" value="{{ $myprofile->payroll_org }}" required readonly>

                                @error('payroll_org')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label for="pf_effective_date" class="col-md-4 col-form-label text-md-right size">{{ __('PF EFFECTIVE DATE/पीएफ प्रभावी तारीख') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="pf_effective_date" type="date" class="form-control @error('pf_effective_date') is-invalid @enderror" name="pf_effective_date" value="{{ $myprofile->pf_effective_date }}" required autocomplete="pf_effective_date" readonly>

                                @error('pf_effective_date')
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
<div id="skills" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">{{ __('EMPLOYEE ID') }} - {{ $myprofile->emp_code }}</div>
                <div class="card-body">

             
                        
                <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>SKILLS</h2>
            </div>
            
           
        </div>
            <div class="table-responsive">
           
        
               
            <table id="myTable" class="table table-bordered table-striped {{ count($skillemployee) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        
                        <th>EMPLOYEE SKILL <p>(कर्मचारी कौशल)</p></th>
                        <th>SKILL GRADE <p>(कौशल ग्रेड)</p></th>

                        
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($skillemployee) > 0)
                        @foreach ($skillemployee as $education)
                        
                            <tr data-entry-id="{{ $education->id }}">
                                <!-- <td></td> -->
                                
                                <td>{{ $education->name }}</td>
                                <td>{{ $education->skill_grade }}</td>
                                

                                
                             
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
            <div class="card-header">{{ __('EMPLOYEE ID') }} - {{ $myprofile->emp_code }}</div>
                <div class="card-body">
                   

                        <div class="form-group row">
                            <label for="acnt_holder_name" class="col-md-4 col-form-label text-md-right size">{{ __('ACCOUNT HOLDER NAME/खाता धारक का नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="acnt_holder_name" type="text" class="form-control @error('acnt_holder_name') is-invalid @enderror" name="acnt_holder_name" value="{{ $myprofile->acnt_holder_name }}" required autocomplete="acnt_holder_name" autofocus readonly>

                                @error('acnt_holder_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bank_name" class="col-md-4 col-form-label text-md-right size">{{ __('BANK NAME/बैंक का नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="bank_name" type="text" class="form-control @error('bank_name') is-invalid @enderror" name="bank_name" value="{{ $myprofile->bank_name }}" required autocomplete="bank_name" readonly>

                                @error('bank_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="branch_name" class="col-md-4 col-form-label text-md-right size">{{ __('BRANCH NAME/शाखा का नाम') }}</label><span style="color:red"> *</span> 

                            <div class="col-md-6">
                                <input id="branch_name" type="text" class="form-control @error('branch_name') is-invalid @enderror" name="branch_name" value="{{ $myprofile->branch_name }}" required autocomplete="branch_name" readonly>

                                @error('branch_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="account_number" class="col-md-4 col-form-label text-md-right size">{{ __('ACCOUNT NO/खाता नंबर') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="account_number" type="number" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{ $myprofile->account_number }}" required autocomplete="account_number" readonly>

                                @error('account_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="neft_code" class="col-md-4 col-form-label text-md-right size">{{ __('NEFT CODE/एनईएफटी कोड') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="neft_code" type="text" class="form-control @error('neft_code') is-invalid @enderror" name="neft_code" value="{{ $myprofile->neft_code }}" required autocomplete="neft_code" readonly>

                                @error('neft_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ifsc_code" class="col-md-4 col-form-label text-md-right size">{{ __('IFSC CODE/आईएफएससी कोड') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="ifsc_code" type="text" class="form-control @error('ifsc_code') is-invalid @enderror" name="ifsc_code" value="{{ $myprofile->ifsc_code }}" required autocomplete="ifsc_code" readonly>

                                @error('ifsc_code')
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
<div id="promotion" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                
            <div class="card-header">{{ __('EMPLOYEE ID') }} - {{ $myprofile->emp_code }}</div>
                <div class="card-body">
                   

                <div class="panel panel-default">
                <div class="panel-body">
                <div class="row">
                <div class="form-group col-md-6">
                <h2>PROMOTION</h2>
                </div>

               
                </div>
                <div class="table-responsive">



            <table id="myTable" class="table table-bordered table-striped {{ count($promotionemployee) > 0 ? 'datatable' : '' }} pointer">
                <thead>
                <tr>
                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                    
                    <th>PROMOTION DATE <p>(पदोन्नति तारीख)</p></th>
                    <th>EFFECTIVE FROM <p>(से प्रभावी)</p></th>
                    <th>LAST DESIGNATION <p>(अंतिम पदनाम)</p></th>
                    <th>LAST SALARY <p>(आखरी तनख्वा)</p></th>

                </tr>
                </thead>

                <tbody>
                @if (count($promotionemployee) > 0)
                    @foreach ($promotionemployee as $promotion)
                    
                        <tr data-entry-id="{{ $promotion->id }}">
                            <!-- <td></td> -->
                            
                            <td>{{ $promotion->promotion_date }}</td>
                            <td>{{ $promotion->effective_from }}</td>
                            <td>{{ $promotion->last_designation }}</td>
                            <td>{{ $promotion->last_salary }}</td>
                            

                            
                        
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
              
            <div class="card-header">{{ __('EMPLOYEE ID') }} - {{ $myprofile->emp_code }}</div>
                <div class="card-body">
                  
                <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>OFFICE ASSETS</h2>
            </div>
           
            
        </div>
            <div class="table-responsive">
           
        
               
            <table id="myTable" class="table table-bordered table-striped {{ count($assets) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        
                        <th>ASSETS NAME<p>(संपत्ति का नाम)</p></th>
                        <th>ASSETS DETAILS<p>(संपत्ति विवरण)</p></th>
                        <th>GIVING DATE<p>(तारीख देना)</p></th>
                        <th>RETURN DATE<p>(वापसी दिनांक)</p></th>
                        <th>RETURN ASSETS CONDITION<p>(वापसी आस्तियों की स्थिति)</p></th>
                        <th>ISSUER<p>(जारीकर्ता)</p></th>
                        
                     
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
<div id="my_leave" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">{{ __('EMPLOYEE ID') }} - {{ $myprofile->emp_code }}</div>
                <div class="card-body">

             
                        
                <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>MY LEAVE</h2>
            </div>
            
           
        </div>
            <div class="table-responsive">
           
        
               
            <table id="myTable" class="table table-bordered table-striped {{ count($allleave) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        
                        <th>LEAVE TYPE<p>(छोड़ें प्रकार)</p></th>
                        <th>DATE FROM<p>(तारीख से)</p></th>
                        <th>DATE TO<p>(की तारीख)</p></th>
                        <th>NO. OF DAYS<p>(दिनों की संख्या)</p></th>
                        <th>TOTAL DAYS<p>(कुल दिन)</p></th>
                        <th>REMAINING<p>(बचा हुआ)</p></th>
                        <th>REASON<p>(कारण)</p></th>
                       

                        
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($allleave) > 0)
                        @foreach ($allleave as $allleaves)
                        
                            <tr data-entry-id="{{ $allleaves->id }}">
                                <!-- <td></td> -->
                                
                               
                                <td>{{$allleaves->name}}</td>
                                <td>{{$allleaves->date_from}}</td>
                                <td>{{$allleaves->date_to}}</td>
                                <td>{{$allleaves->days}}</td>
                                <td>{{$allleaves->no_of_days}}</td>
                                <td>{{ $allleaves->no_of_days - $allleaves->days }}</td>
                                <td>{{$allleaves->reason}}</td>
                                

                                
                             
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
    </form>
                </div>
            </div>
        </div>
    </div>
</div>



</div>
@include('footerimport')
@endsection
<script>
$(document).ready(function() {
    $('.language').select2();
});
</script>
   

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
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
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
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

