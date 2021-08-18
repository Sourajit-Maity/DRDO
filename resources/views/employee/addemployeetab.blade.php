@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    
    'PIM' => '#',
    'Employee' => route('view-employee'),
    'Add Employee' => route('add-employee'),

]])
<div class="container">
<div class="tab">
<button class="tablinks" onclick="openCity(event, 'London')">Basic Info</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')">Personal</button>
  <button class="tablinks" onclick="openCity(event, 'Tokyo')">Team Info</button>
  <button class="tablinks" onclick="openCity(event, 'Patna')">Education</button>
  <button class="tablinks" onclick="openCity(event, 'Durgapur')">Skills</button>
  <button class="tablinks" onclick="openCity(event, 'France')">Salary</button>
  <button class="tablinks" onclick="openCity(event, 'Berlin')">Bank</button>
  <button class="tablinks" onclick="openCity(event, 'Amritsar')">Promotion</button>
  <button class="tablinks" onclick="openCity(event, 'Usa')">Assets</button>
  <button class="tablinks" onclick="openCity(event, 'Delhi')">Employee Image</button>
  
 
</div>

<div id="London" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD Employee') }}</div>

                <div class="card-body">
                    <form  action="{{ route('submit_employee.post') }}" method="POST" enctype="multipart/form-data">
                   
                        @csrf

                        <div class="form-group row">
                            <label for="emp_firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="emp_firstname" type="text" class="form-control @error('emp_firstname') is-invalid @enderror" name="emp_firstname" value="{{ old('emp_firstname') }}" required autocomplete="emp_firstname" autofocus>

                                @error('emp_firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_middle_name" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>

                            <div class="col-md-6">
                                <input id="emp_middle_name" type="text" class="form-control" name="emp_middle_name" value="{{ old('emp_middle_name') }}" required autocomplete="emp_middle_name" autofocus>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="emp_lastname" type="text" class="form-control @error('emp_lastname') is-invalid @enderror" name="emp_lastname" value="{{ old('emp_lastname') }}" required autocomplete="emp_lastname" autofocus>

                                @error('emp_lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_nick_name" class="col-md-4 col-form-label text-md-right">{{ __('Nick Name') }}</label>

                            <div class="col-md-6">
                                <input id="emp_nick_name" type="text" class="form-control @error('emp_nick_name') is-invalid @enderror" name="emp_nick_name" value="{{ old('emp_nick_name') }}" required autocomplete="emp_nick_name" autofocus>

                                @error('emp_nick_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_pan_num" class="col-md-4 col-form-label text-md-right">{{ __('Pan Number') }}</label>

                            <div class="col-md-6">
                                <input id="emp_pan_num" type="text" class="form-control @error('emp_pan_num') is-invalid @enderror" name="emp_pan_num" value="{{ old('emp_pan_num') }}" required autocomplete="emp_pan_num" autofocus>

                                @error('emp_pan_num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_street1" class="col-md-4 col-form-label text-md-right">{{ __('Address Line 1') }}</label>

                            <div class="col-md-6">
                                <input id="emp_street1" type="text" class="form-control @error('emp_street1') is-invalid @enderror" name="emp_street1" value="{{ old('emp_street1') }}" required autocomplete="emp_street1" autofocus>

                                @error('emp_street1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_street2" class="col-md-4 col-form-label text-md-right">{{ __('Address Line 2') }}</label>

                            <div class="col-md-6">
                                <input id="emp_street2" type="text" class="form-control @error('emp_street2') is-invalid @enderror" name="emp_street2" value="{{ old('emp_street2') }}" required autocomplete="emp_street2" autofocus>

                                @error('emp_street2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city_code" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">
                                <input id="city_code" type="text" class="form-control @error('city_code') is-invalid @enderror" name="city_code" value="{{ old('city_code') }}" required autocomplete="city_code" autofocus>

                                @error('city_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="state_code" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                            <div class="col-md-6">
                             
                                <select  name="state_code" id="state_code" class="form-control @error('state_code') is-invalid @enderror" name="state_code"  required autocomplete="state_code">
                                 <option value="" disabled selected>Select State</option>
                                    @foreach($state as $states)
                                        <option value="{{$states->state_name}}">{{$states->state_name}}</option>
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
                            <label for="district_code" class="col-md-4 col-form-label text-md-right">{{ __('District') }}</label>

                            <div class="col-md-6">
                             
                                <select  name="district_code" id="district_code" class="form-control @error('district_code') is-invalid @enderror" name="district_code"  required autocomplete="district_code">
                                 <option value="" disabled selected>Select District</option>
                                    @foreach($district as $districts)
                                        <option value="{{$districts->district_name}}">{{$districts->district_name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('district_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_pincode" class="col-md-4 col-form-label text-md-right">{{ __('Pin Code') }}</label>

                            <div class="col-md-6">
                                <input id="emp_pincode" type="text" class="form-control @error('emp_pincode') is-invalid @enderror" name="emp_pincode" value="{{ old('emp_pincode') }}" required autocomplete="emp_pincode" autofocus>

                                @error('emp_pincode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_hm_telephone" class="col-md-4 col-form-label text-md-right">{{ __('Home Telephone Number') }}</label>

                            <div class="col-md-6">
                                <input id="emp_hm_telephone" type="number" class="form-control @error('emp_hm_telephone') is-invalid @enderror" name="emp_hm_telephone" value="{{ old('emp_hm_telephone') }}" required autocomplete="emp_hm_telephone" autofocus>

                                @error('emp_hm_telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_mobile" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="emp_mobile" type="number" class="form-control @error('emp_mobile') is-invalid @enderror" name="emp_mobile" value="{{ old('emp_mobile') }}" required autocomplete="emp_mobile" autofocus>

                                @error('emp_mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_work_telephone" class="col-md-4 col-form-label text-md-right">{{ __('Work Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="emp_work_telephone" type="number" class="form-control @error('emp_work_telephone') is-invalid @enderror" name="emp_work_telephone" value="{{ old('emp_work_telephone') }}" required autocomplete="emp_work_telephone" autofocus>

                                @error('emp_work_telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_work_email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="emp_work_email" type="email" class="form-control @error('emp_work_email') is-invalid @enderror" name="emp_work_email" value="{{ old('emp_work_email') }}" required autocomplete="emp_work_email">

                                @error('emp_work_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_oth_email" class="col-md-4 col-form-label text-md-right">{{ __('Other E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="emp_oth_email" type="email" class="form-control @error('emp_oth_email') is-invalid @enderror" name="emp_oth_email" value="{{ old('emp_oth_email') }}" required autocomplete="emp_oth_email">

                                @error('emp_oth_email')
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

<div id="Paris" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                

                <div class="card-body">
                   

                        <div class="form-group row">
                            <label for="emp_birthday" class="col-md-4 col-form-label text-md-right">{{ __('Employee Birthday') }}</label>

                            <div class="col-md-6">
                                <input id="emp_birthday" type="date" class="form-control @error('emp_birthday') is-invalid @enderror" name="emp_birthday" value="{{ old('emp_birthday') }}" required autocomplete="emp_birthday" autofocus>

                                @error('emp_birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                              
                                <select  name="emp_gender" id="emp_gender" class="form-control @error('emp_gender') is-invalid @enderror" name="emp_gender" value="{{ old('emp_gender') }}" required autocomplete="emp_gender">
                                <option value="" disabled selected>Select Gender</option>
                                                       <option value='0'>Male</option>
                                                        <option value='1'>Female</option>                                             
                                                     
                                 </select>
                                @error('emp_gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_marital_status" class="col-md-4 col-form-label text-md-right">{{ __('Maritial Status') }}</label>

                            <div class="col-md-6">
                            <select  name="emp_marital_status" id="emp_marital_status" class="form-control @error('emp_marital_status') is-invalid @enderror" name="emp_marital_status" value="{{ old('emp_marital_status') }}" required autocomplete="emp_marital_status">
                            <option value="" disabled selected>Select Maritial status</option>
                                                       <option value='0'>Married</option>
                                                        <option value='1'>Unmarried</option>                                             
                                                     
                                                    </select>
                                @error('emp_marital_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="emp_religion_id" class="col-md-4 col-form-label text-md-right">{{ __('Religion') }}</label>

                            <div class="col-md-6">
                              
                                <select  name="emp_religion_id" id="emp_religion_id" class="form-control @error('emp_religion_id') is-invalid @enderror" name="emp_religion_id" value="{{ old('emp_religion_id') }}" required autocomplete="emp_religion_id">
                                 <option value="" disabled selected>Select Religion</option>
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
                            <label for="emp_nationality_id" class="col-md-4 col-form-label text-md-right">{{ __('Nationality') }}</label>

                            <div class="col-md-6">
                             
                                <select  name="emp_nationality_id" id="emp_nationality_id" class="form-control @error('emp_nationality_id') is-invalid @enderror"  value="{{ old('emp_nationality_id') }}" required autocomplete="emp_nationality_id">
                                 <option value="" disabled selected> Nationality</option>
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
                            <label for="emp_bloodgroup" class="col-md-4 col-form-label text-md-right">{{ __('Employee Blood Group') }}</label>

                            <div class="col-md-6">
                                <input id="emp_bloodgroup" type="text" class="form-control @error('emp_bloodgroup') is-invalid @enderror" name="emp_bloodgroup" value="{{ old('emp_bloodgroup') }}" required autocomplete="emp_bloodgroup" autofocus>

                                @error('emp_bloodgroup')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 
                       
                        <div class="form-group row">
                            <label for="emp_aadhar_num" class="col-md-4 col-form-label text-md-right">{{ __('Adhaar Number') }}</label>

                            <div class="col-md-6">
                                <input id="emp_aadhar_num" type="text" class="form-control @error('emp_aadhar_num') is-invalid @enderror" name="emp_aadhar_num" value="{{ old('emp_aadhar_num') }}" required autocomplete="emp_aadhar_num" autofocus>

                                @error('emp_aadhar_num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_other_id" class="col-md-4 col-form-label text-md-right">{{ __('Employee Other Id') }}</label>

                            <div class="col-md-6">
                                <input id="emp_other_id" type="text" class="form-control @error('emp_other_id') is-invalid @enderror" name="emp_other_id" value="{{ old('emp_other_id') }}" required autocomplete="emp_other_id" autofocus>

                                @error('emp_other_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_language" class="col-md-4 col-form-label text-md-right">{{ __('Languages') }}</label>

                            <div class="col-md-6">

                                <select  name="emp_language" id="emp_language" class="form-control @error('language') is-invalid @enderror"  required autocomplete="emp_language">
                                <option value="" disabled selected>Languages</option>
                                    @foreach($language as $languages)
                                        <option value="{{$languages->id}}">{{$languages->lng_name}}</option>
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
                            <label for="emp_food_habit" class="col-md-4 col-form-label text-md-right">{{ __('Food Habit') }}</label>

                            <div class="col-md-6">

                                <select  name="emp_food_habit" id="emp_food_habit" class="form-control @error('emp_food_habit') is-invalid @enderror"   required autocomplete="emp_food_habit">
                                <option value="" disabled selected>Select Food Habit</option>
                                            <option value='0'>Veg</option>
                                            <option value='1'>Non-Veg</option>
                                            <option value='2'>Vegan</option>                                              
                                                     
                                 </select>
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

<div id="Tokyo" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              

                <div class="card-body">
                    

                <div class="form-group row">
                            <label for="operational_company_id" class="col-md-4 col-form-label text-md-right">{{ __('Operational Company') }}</label>

                            <div class="col-md-6">
                             
                            <select  name="operational_company_id" id="operational_company_id" 
     class="form-control @error('operational_company_id') is-invalid @enderror" 
   name="operational_company_id" value="{{ old('operational_company_id') }}" required autocomplete="operational_company_id">
                           <option value="" disabled selected>Select Company</option>
                            @foreach ($company as $key => $value)
                               
                                        <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach                                            
                                                     
                             </select>
                                @error('operational_company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="operational_company_location_id" class="col-md-4 col-form-label text-md-right">{{ __('Operational Location') }}</label>

                            <div class="col-md-6">
                               
                            <select  name="operational_company_location_id" id="operational_company_location_id" class="form-control @error('operational_company_location_id') is-invalid @enderror" name="operational_company_location_id" value="{{ old('operational_company_location_id') }}" required autocomplete="operational_company_location_id">
                                 <option>--Select Location--</option>
                                                                            
                                                     
                             </select>
                                @error('operational_company_location_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="operational_company_loc_dept_id" class="col-md-4 col-form-label text-md-right">{{ __('Operational  Department') }}</label>

                            <div class="col-md-6">   
                            <select  name="operational_company_loc_dept_id" id="operational_company_loc_dept_id" class="form-control @error('operational_company_loc_dept_id') is-invalid @enderror" name="operational_company_loc_dept_id" value="{{ old('operational_company_loc_dept_id') }}" required autocomplete="operational_company_loc_dept_id">
                                 <option>--Select Department--</option>
                                                                            
                                                     
                             </select>
                                @error('operational_company_loc_dept_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label for="joined_date" class="col-md-4 col-form-label text-md-right">{{ __('Joining Date') }}</label>

                            <div class="col-md-6">
                                <input id="joined_date" type="date" class="form-control @error('joined_date') is-invalid @enderror" name="joined_date" value="{{ old('joined_date') }}" required autocomplete="joined_date">

                                @error('joined_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reporting_to" class="col-md-4 col-form-label text-md-right">{{ __('Reporting To') }}</label>

                            <div class="col-md-6">
                                
                                <select  name="reporting_to" id="reporting_to" class="form-control @error('reporting_to') is-invalid @enderror" name="reporting_to" value="{{ old('reporting_to') }}" required autocomplete="reporting_to">
                                <option value="" disabled selected>Reporting To</option>
                                    @foreach($reporting as $reportings)
                                        <option value="{{$reportings->id}}">{{$reportings->name}}</option>
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
                            <label for="shift" class="col-md-4 col-form-label text-md-right">{{ __('Shift') }}</label>

                            <div class="col-md-6">

                                <select  name="shift" id="shift" class="form-control @error('shift') is-invalid @enderror" name="shift" value="{{ old('shift') }}" required autocomplete="shift">
                                <option value="" disabled selected>Shift</option>
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
                            <label for="emp_status" class="col-md-4 col-form-label text-md-right">{{ __('Employee Status') }}</label>

                            <div class="col-md-6">

                                <select  name="emp_status" id="emp_status" class="form-control @error('emp_status') is-invalid @enderror" name="emp_status" value="{{ old('emp_status') }}" required autocomplete="emp_status">
                                <option value="" disabled selected>Select Employee Status</option>
                            
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
                            <label for="org_age" class="col-md-4 col-form-label text-md-right">{{ __('Organization Age') }}</label>

                            <div class="col-md-6">
                                <input id="org_age" type="date"  class="form-control @error('org_age') is-invalid @enderror" name="org_age" value="{{ old('org_age') }}" required autocomplete="org_age">

                                @error('org_age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="designation" class="col-md-4 col-form-label text-md-right">{{ __('Designation') }}</label>

                            <div class="col-md-6">
                             
                            <select  name="designation" id="designation" 
                    class="form-control @error('designation') is-invalid @enderror" 
                    value="{{ old('designation') }}" required autocomplete="designation">
                           <option value="" disabled selected>Select Designation</option>
                            @foreach ($roles as $key => $value)
                               
                                        <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach                                            
                                                     
                             </select>
                                @error('designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="job_role" class="col-md-4 col-form-label text-md-right">{{ __('Job Role') }}</label>

                            <div class="col-md-6">
                               
                            <select  name="job_role" id="job_role" class="form-control @error('job_role') is-invalid @enderror" name="job_role" value="{{ old('job_role') }}" required autocomplete="job_role">
                                 <option>--Select Job Role--</option>
                                                                            
                                                     
                             </select>
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

<div id="Patna" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                <div class="form-group row">
                            <label for="emp_education_id" class="col-md-4 col-form-label text-md-right">{{ __('Degree Type') }}</label>

                            <div class="col-md-6">
                         
                            <select class="form-control @error('emp_education_id') is-invalid @enderror"  name="emp_education_id" required>
                            <option value="" disabled selected>Degree Type</option>
                                    @foreach($education as $educations)
                                        <option value="{{$educations->id}}">{{$educations->name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                       
                                @error('emp_education_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                 
                   
                    <div class="form-group row">
                            <label for="ins_name" class="col-md-4 col-form-label text-md-right">{{ __('Institute Name') }}</label>

                            <div class="col-md-6">
                                <input id="ins_name" type="text" class="form-control @error('ins_name') is-invalid @enderror" name="ins_name" required autocomplete="ins_name" autofocus>

                                @error('ins_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="degree" class="col-md-4 col-form-label text-md-right">{{ __('Degree Name') }}</label>

                            <div class="col-md-6">
                                <input id="degree" type="text" class="form-control @error('degree') is-invalid @enderror" name="degree"  required autocomplete="degree" autofocus>
                                @error('degree')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="grade" class="col-md-4 col-form-label text-md-right">{{ __('Grade') }}</label>

                            <div class="col-md-6">
                                <input id="grade" type="number" class="form-control @error('grade') is-invalid @enderror" name="grade"  required autocomplete="grade" autofocus>

                                @error('grade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="year" class="col-md-4 col-form-label text-md-right">{{ __('Passing Year') }}</label>

                            <div class="col-md-6">
                                <input id="year" type="number" class="form-control @error('year') is-invalid @enderror" name="year"  required autocomplete="year" autofocus>

                                @error('year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="notes" class="col-md-4 col-form-label text-md-right">{{ __('Additional Notes') }}</label>

                            <div class="col-md-6">
                                <input id="notes" type="text" class="form-control" name="notes" required autocomplete="notes" autofocus>


                            </div>
                        </div>
               
                
                        

                 </div>
            </div>
        </div>
    </div>
</div>
<div id="Durgapur" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">

             
                        <div class="form-group row">
                            <label for="skills" class="col-md-4 col-form-label text-md-right">{{ __('Skills') }}</label>

                            <div class="col-md-6">
                             
                            <select class="form-control @error('emp_skill_id') is-invalid @enderror"  name="emp_skill_id">
                                    @foreach($skills as $skill)
                                        <option value="{{$skill->id}}">{{$skill->name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                       
                                @error('skills')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="skill_grade" class="col-md-4 col-form-label text-md-right">{{ __('Skill Grade') }}</label>

                            <div class="col-md-6">
                             
                            <select class="form-control @error('skill_grade') is-invalid @enderror"  name="skill_grade">
                                    
                                        <option value="" disabled selected>Select Grade</option>
                                                       <option value='1'>1</option>
                                                        <option value='2'>2</option> 
                                                        <option value='3'>3</option>
                                                        <option value='4'>4</option> 
                                                        <option value='5'>5</option>
                                 
                             </select>
                       
                                @error('skill_grade')
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
<div id="France" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">

                               
                        <div class="form-group row">
                            <label for="committed_amount" class="col-md-4 col-form-label text-md-right">{{ __('Committed Amount') }}</label>

                            <div class="col-md-6">
                                <input id="committed_amount" type="text" class="form-control @error('committed_amount') is-invalid @enderror" name="committed_amount" value="{{ old('committed_amount') }}" required autocomplete="committed_amount" autofocus>
                                
                                @error('committed_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="ctc_per_month" class="col-md-4 col-form-label text-md-right">{{ __('CTC Per Month') }}</label>

                            <div class="col-md-6">
                                <input id="ctc_per_month" type="text" class="form-control @error('ctc_per_month') is-invalid @enderror" name="ctc_per_month" value="{{ old('ctc_per_month') }}" required autocomplete="ctc_per_month" autofocus>

                                @error('ctc_per_month')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="esi_number" class="col-md-4 col-form-label text-md-right">{{ __('ESI Number') }}</label>

                            <div class="col-md-6">
                                <input id="esi_number" type="text" class="form-control @error('esi_number') is-invalid @enderror" name="esi_number" value="{{ old('esi_number') }}" required autocomplete="esi_number" autofocus>

                                @error('esi_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pf_uan_no" class="col-md-4 col-form-label text-md-right">{{ __('Pf UAN Number') }}</label>

                            <div class="col-md-6">
                                <input id="pf_uan_no" type="text" class="form-control @error('pf_uan_no') is-invalid @enderror" name="pf_uan_no" value="{{ old('pf_uan_no') }}" required autocomplete="pf_uan_no">

                                @error('pf_uan_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pf_no" class="col-md-4 col-form-label text-md-right">{{ __('PF Number') }}</label>

                            <div class="col-md-6">
                                <input id="pf_no" type="text" class="form-control @error('pf_no') is-invalid @enderror" name="pf_no" value="{{ old('pf_no') }}" required autocomplete="pf_no">

                                @error('pf_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ctc_per_annum" class="col-md-4 col-form-label text-md-right">{{ __('CTC Per Annum') }}</label>

                            <div class="col-md-6">
                                <input id="ctc_per_annum" type="text" class="form-control @error('ctc_per_annum') is-invalid @enderror" name="ctc_per_annum" value="{{ old('ctc_per_annum') }}" required autocomplete="ctc_per_annum">

                                @error('ctc_per_annum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="payroll_org" class="col-md-4 col-form-label text-md-right">{{ __('Pyaroll Organization') }}</label>

                            <div class="col-md-6">
                                <input id="payroll_org" type="text" class="form-control @error('payroll_org') is-invalid @enderror" name="payroll_org" value="{{ old('payroll_org') }}" required autocomplete="payroll_org">

                                @error('payroll_org')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pf_effective_date" class="col-md-4 col-form-label text-md-right">{{ __('Pf Effective Date') }}</label>

                            <div class="col-md-6">
                                <input id="pf_effective_date" type="date" class="form-control @error('pf_effective_date') is-invalid @enderror" name="pf_effective_date" value="{{ old('pf_effective_date') }}" required autocomplete="pf_effective_date">

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
<div id="Berlin" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                   

                        <div class="form-group row">
                            <label for="acnt_holder_name" class="col-md-4 col-form-label text-md-right">{{ __('Account Holder Name') }}</label>

                            <div class="col-md-6">
                                <input id="acnt_holder_name" type="text" class="form-control @error('acnt_holder_name') is-invalid @enderror" name="acnt_holder_name" value="{{ old('acnt_holder_name') }}" required autocomplete="acnt_holder_name" autofocus>

                                @error('acnt_holder_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bank_name" class="col-md-4 col-form-label text-md-right">{{ __('Bank Name') }}</label>

                            <div class="col-md-6">
                                <input id="bank_name" type="text" class="form-control @error('bank_name') is-invalid @enderror" name="bank_name" value="{{ old('bank_name') }}" required autocomplete="bank_name">

                                @error('bank_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="branch_name" class="col-md-4 col-form-label text-md-right">{{ __('Branch Name') }}</label>

                            <div class="col-md-6">
                                <input id="branch_name" type="text" class="form-control @error('branch_name') is-invalid @enderror" name="branch_name" value="{{ old('branch_name') }}" required autocomplete="branch_name">

                                @error('branch_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="account_number" class="col-md-4 col-form-label text-md-right">{{ __('Account Number') }}</label>

                            <div class="col-md-6">
                                <input id="account_number" type="number" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{ old('account_number') }}" required autocomplete="account_number">

                                @error('account_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="neft_code" class="col-md-4 col-form-label text-md-right">{{ __('Neft Code') }}</label>

                            <div class="col-md-6">
                                <input id="neft_code" type="text" class="form-control @error('neft_code') is-invalid @enderror" name="neft_code" value="{{ old('neft_code') }}" required autocomplete="neft_code">

                                @error('neft_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ifsc_code" class="col-md-4 col-form-label text-md-right">{{ __('Ifsc_code') }}</label>

                            <div class="col-md-6">
                                <input id="ifsc_code" type="text" class="form-control @error('ifsc_code') is-invalid @enderror" name="ifsc_code" value="{{ old('ifsc_code') }}" required autocomplete="ifsc_code">

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
<div id="Amritsar" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                

                <div class="card-body">
                   

                <div class="form-group row">
                            <label for="promotion_date" class="col-md-4 col-form-label text-md-right">{{ __('Promotion Date') }}</label>

                            <div class="col-md-6">
                                <input id="promotion_date" type="date" class="form-control @error('promotion_date') is-invalid @enderror" name="promotion_date" value="{{ old('promotion_date') }}" required autocomplete="promotion_date" autofocus>

                                @error('promotion_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="effective_from" class="col-md-4 col-form-label text-md-right">{{ __('Effective From') }}</label>

                            <div class="col-md-6">
                                <input id="effective_from" type="date" class="form-control @error('effective_from') is-invalid @enderror" name="effective_from" value="{{ old('effective_from') }}" required autocomplete="effective_from" autofocus>

                                @error('effective_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_designation" class="col-md-4 col-form-label text-md-right">{{ __('Last Designation') }}</label>

                            <div class="col-md-6">
                                <input id="last_designation" type="text" class="form-control @error('last_designation') is-invalid @enderror" name="last_designation" value="{{ old('last_designation') }}" required autocomplete="last_designation" autofocus>

                                @error('last_designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_salary" class="col-md-4 col-form-label text-md-right">{{ __('Last Salary') }}</label>

                            <div class="col-md-6">
                                <input id="last_salary" type="text" class="form-control @error('last_salary') is-invalid @enderror" name="last_salary" value="{{ old('last_salary') }}" required autocomplete="last_salary" autofocus>

                                @error('last_salary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="letters" class="col-md-4 col-form-label text-md-right">{{ __('All Promotion and Increment Letters') }}</label>

                            <div class="col-md-6">
                               
                                <input type="file" name="letters" class="form-control">
                                @error('letters')
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

<div id="Usa" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">

                <div class="form-group row">
                            <label for="property_name" class="col-md-4 col-form-label text-md-right">{{ __('Property Name') }}</label>

                            <div class="col-md-6">
                                <input id="property_name" type="text" class="form-control @error('property_name') is-invalid @enderror" name="property_name" value="{{ old('property_name') }}" required autocomplete="property_name" autofocus>

                                @error('property_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="property_details" class="col-md-4 col-form-label text-md-right">{{ __('Property Details') }}</label>

                            <div class="col-md-6">
                                <input id="property_details" type="text" class="form-control @error('property_details') is-invalid @enderror" name="property_details" value="{{ old('property_details') }}" required autocomplete="property_details" autofocus>

                                @error('property_details')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="giving_date" class="col-md-4 col-form-label text-md-right">{{ __('Giving Date') }}</label>

                            <div class="col-md-6">
                                <input id="giving_date" type="date" class="form-control @error('giving_date') is-invalid @enderror" name="giving_date" value="{{ old('giving_date') }}" required autocomplete="giving_date" autofocus>

                                @error('giving_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="return_date" class="col-md-4 col-form-label text-md-right">{{ __('Return Date') }}</label>

                            <div class="col-md-6">
                                <input id="return_date" type="date" class="form-control @error('return_date') is-invalid @enderror" name="return_date" value="{{ old('return_date') }}" required autocomplete="return_date">

                                @error('return_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="return_property_conditions" class="col-md-4 col-form-label text-md-right">{{ __('Return Property Conditions') }}</label>

                            <div class="col-md-6">
                                <input id="return_property_conditions" type="text" class="form-control @error('return_property_conditions') is-invalid @enderror" name="return_property_conditions" value="{{ old('return_property_conditions') }}" required autocomplete="return_property_conditions">

                                @error('return_property_conditions')
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
<div id="Delhi" class="tabcontent">
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              

                <div class="card-body">
                  
                <div class="form-group row">
                            <label for="emp_img" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                             
                            
                                <input type="file" name="file" class="form-control">
                                @error('emp_img')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
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
$(".selectpicker").select2({
    tags: true,
    tokenSeparators: [',', ' ']   

})
});
    </script>
    <script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="designation"]').on('change',function(){
               var desigID = jQuery(this).val();
               if(desigID)
               {
                  jQuery.ajax({
                     url : 'add-employee/getrole/' +desigID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="job_role"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="job_role"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="job_role"]').empty();
               }
            });
    });
    </script>
<script type="text/javascript">
    jQuery(document).ready(function ()
    {
            
            jQuery('select[name="operational_company_id"]').on('change',function(){
               var countryID = jQuery(this).val();
               if(countryID)
               {
                  jQuery.ajax({
                     url : 'add-employee/getlocation/' +countryID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="operational_company_location_id"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="operational_company_location_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="operational_company_location_id"]').empty();
               }
            });
    });
    </script>

<script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="operational_company_location_id"]').on('change',function(){
               var deptID = jQuery(this).val();
               if(deptID)
               {
                  jQuery.ajax({
                     url : 'getlocation/getunit/' +deptID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="operational_company_loc_dept_id"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="operational_company_loc_dept_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="operational_company_loc_dept_id"]').empty();
               }
            });
    });
    </script>
<script type="text/javascript">
    $(document).ready(function() {
        $('select').selectpicker();
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
</script>

