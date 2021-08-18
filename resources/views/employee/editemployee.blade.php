@extends('adminlte::page')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'PIM' => '#',  
    'Employee' => route('view-employee'),
    'Edit Employee' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('EDIT Employee') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('update-employee', $employee->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="emp_firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="emp_firstname" type="text" class="form-control @error('emp_firstname') is-invalid @enderror" name="emp_firstname" value="{{ $employee->emp_firstname }}" required autocomplete="emp_firstname" autofocus>

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
                                <input id="emp_middle_name" type="text" class="form-control" name="emp_middle_name" value="{{ $employee->emp_middle_name }}" required autocomplete="emp_middle_name" autofocus>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="emp_lastname" type="text" class="form-control @error('emp_lastname') is-invalid @enderror" name="emp_lastname" value="{{ $employee->emp_lastname }}" required autocomplete="emp_lastname" autofocus>

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
                                <input id="emp_nick_name" type="text" class="form-control @error('emp_nick_name') is-invalid @enderror" name="emp_nick_name" value="{{ $employee->emp_nick_name }}" required autocomplete="emp_nick_name" autofocus>

                                @error('emp_nick_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_smoker" class="col-md-4 col-form-label text-md-right">{{ __('Smoker/Non-Smoker') }}</label>

                            <div class="col-md-6">

                                <select  name="emp_smoker" id="emp_smoker" class="form-control @error('emp_smoker') is-invalid @enderror" name="emp_smoker" value="{{ $employee->emp_smoker }}" required autocomplete="emp_smoker">
                                <option value="" disabled selected>Select Smoker/Non-Smoker</option>
                                            <option value='0'>Smoker</option>
                                            <option value='1'>Non-Smoker</option>                                             
                                                     
                                 </select>
                                @error('emp_smoker')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ethnic_race_code" class="col-md-4 col-form-label text-md-right">{{ __('Ethnic Race') }}</label>

                            <div class="col-md-6">
                                <input id="ethnic_race_code" type="text" class="form-control @error('ethnic_race_code') is-invalid @enderror" name="ethnic_race_code" value="{{ $employee->ethnic_race_code }}" required autocomplete="ethnic_race_code" autofocus>

                                @error('ethnic_race_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_birthday" class="col-md-4 col-form-label text-md-right">{{ __('Employee Birthday') }}</label>

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
                            <label for="operational_company_id" class="col-md-4 col-form-label text-md-right">{{ __('Operational Company') }}</label>

                            <div class="col-md-6">
                             
                            <select  name="operational_company_id" id="operational_company_id" 
     class="form-control @error('operational_company_id') is-invalid @enderror" required autocomplete="operational_company_id">
                      
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
                               
                            <select  name="operational_company_location_id" id="operational_company_location_id" class="form-control @error('operational_company_location_id') is-invalid @enderror"  required autocomplete="operational_company_location_id">
                            <option>--Select Location--</option>
                            @foreach($companylocation as $companylocations)
                                        <option value="{{$companylocations->id}}">{{$companylocations->l_name}}</option>
                                    @endforeach 
                              
                                                                            
                                                     
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
                            <select  name="operational_company_loc_dept_id" id="operational_company_loc_dept_id" class="form-control @error('operational_company_loc_dept_id') is-invalid @enderror"  required autocomplete="operational_company_loc_dept_id">
                                 
                                 <option>--Select Department--</option>
                                 @foreach($locationdepartment as $companylocations)
                                        <option value="{{$companylocations->id}}">{{$companylocations->d_name}}</option>
                                    @endforeach                                          
                                                     
                             </select>
                                @error('operational_company_loc_dept_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                              
                                <select  name="emp_gender" id="emp_gender" class="form-control @error('emp_gender') is-invalid @enderror" name="emp_gender" value="{{ $employee->emp_gender }}" required autocomplete="emp_gender">
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
                            <select  name="emp_marital_status" id="emp_marital_status" class="form-control @error('emp_marital_status') is-invalid @enderror" name="emp_marital_status" value="{{ $employee->emp_marital_status }}" required autocomplete="emp_marital_status">
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
                              
                                <select  name="emp_religion_id" id="emp_religion_id" class="form-control @error('emp_religion_id') is-invalid @enderror" name="emp_religion_id" value="{{ $employee->emp_religion_id }}" required autocomplete="emp_religion_id">
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
                                 <option value="" disabled selected>Select Nationality</option>
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
                            <label for="emp_pan_num" class="col-md-4 col-form-label text-md-right">{{ __('Pan Number') }}</label>

                            <div class="col-md-6">
                                <input id="emp_pan_num" type="text" class="form-control @error('emp_pan_num') is-invalid @enderror" name="emp_pan_num" value="{{ $employee->emp_pan_num }}" required autocomplete="emp_pan_num" autofocus>

                                @error('emp_pan_num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_aadhar_num" class="col-md-4 col-form-label text-md-right">{{ __('Adhaar Number') }}</label>

                            <div class="col-md-6">
                                <input id="emp_aadhar_num" type="text" class="form-control @error('emp_aadhar_num') is-invalid @enderror" name="emp_aadhar_num" value="{{ $employee->emp_aadhar_num }}" required autocomplete="emp_aadhar_num" autofocus>

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
                                <input id="emp_other_id" type="text" class="form-control @error('emp_other_id') is-invalid @enderror" name="emp_other_id" value="{{ $employee->emp_other_id }}" required autocomplete="emp_other_id" autofocus>

                                @error('emp_other_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_bloodgroup" class="col-md-4 col-form-label text-md-right">{{ __('Employee Blood Group') }}</label>

                            <div class="col-md-6">
                                <input id="emp_bloodgroup" type="text" class="form-control @error('emp_bloodgroup') is-invalid @enderror" name="emp_bloodgroup" value="{{ $employee->emp_bloodgroup }}" required autocomplete="emp_bloodgroup" autofocus>

                                @error('emp_bloodgroup')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_street1" class="col-md-4 col-form-label text-md-right">{{ __('Address Line 1') }}</label>

                            <div class="col-md-6">
                                <input id="emp_street1" type="text" class="form-control @error('emp_street1') is-invalid @enderror" name="emp_street1" value="{{ $employee->emp_street1 }}" required autocomplete="emp_street1" autofocus>

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
                                <input id="emp_street2" type="text" class="form-control @error('emp_street2') is-invalid @enderror" name="emp_street2" value="{{ $employee->emp_street2 }}" required autocomplete="emp_street2" autofocus>

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
                                <input id="city_code" type="text" class="form-control @error('city_code') is-invalid @enderror" name="city_code" value="{{ $employee->city_code }}" required autocomplete="city_code" autofocus>

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
                                <input id="state_code" type="text" class="form-control @error('state_code') is-invalid @enderror" name="state_code" value="{{ $employee->state_code }}" required autocomplete="state_code" autofocus>

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
                                <input id="district_code" type="text" class="form-control @error('district_code') is-invalid @enderror" name="district_code" value="{{ $employee->district_code }}" required autocomplete="district_code" autofocus>

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
                                <input id="emp_pincode" type="text" class="form-control @error('emp_pincode') is-invalid @enderror" name="emp_pincode" value="{{ $employee->emp_pincode }}" required autocomplete="emp_pincode" autofocus>

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
                                <input id="emp_hm_telephone" type="text" class="form-control @error('emp_hm_telephone') is-invalid @enderror" name="emp_hm_telephone" value="{{ $employee->emp_hm_telephone }}" required autocomplete="emp_hm_telephone" autofocus>

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
                                <input id="emp_mobile" type="text" class="form-control @error('emp_mobile') is-invalid @enderror" name="emp_mobile" value="{{ $employee->emp_mobile }}" required autocomplete="emp_mobile" autofocus>

                                @error('emp_mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_work_telephone" class="col-md-4 col-form-label text-md-right">{{ __('Employee Work Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="emp_work_telephone" type="text" class="form-control @error('emp_work_telephone') is-invalid @enderror" name="emp_work_telephone" value="{{ $employee->emp_work_telephone }}" required autocomplete="emp_work_telephone" autofocus>

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
                                <input id="emp_work_email" type="email" class="form-control @error('emp_work_email') is-invalid @enderror" name="emp_work_email" value="{{ $employee->emp_work_email }}" required autocomplete="emp_work_email">

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
                                <input id="emp_oth_email" type="email" class="form-control @error('emp_oth_email') is-invalid @enderror" name="emp_oth_email" value="{{ $employee->emp_oth_email }}" required autocomplete="emp_oth_email">

                                @error('emp_oth_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sal_grd_code" class="col-md-4 col-form-label text-md-right">{{ __('Salary Grade Code') }}</label>

                            <div class="col-md-6">
                                <input id="sal_grd_code" type="text" class="form-control @error('sal_grd_code') is-invalid @enderror" name="sal_grd_code" value="{{ $employee->sal_grd_code }}" required autocomplete="sal_grd_code">

                                @error('sal_grd_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="joined_date" class="col-md-4 col-form-label text-md-right">{{ __('Joining Date') }}</label>

                            <div class="col-md-6">
                                <input id="joined_date" type="date" class="form-control @error('joined_date') is-invalid @enderror" name="joined_date" value="{{ $employee->joined_date }}" required autocomplete="joined_date">

                                @error('joined_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
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
<script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="operational_company_id"]').on('change',function(){
               var cID = jQuery(this).val();
               
               if(cID)
               {
                
                  jQuery.ajax({
                    
                     url : 'edit-employee/getldlocation/' + cID,
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
               var dID = jQuery(this).val();
               if(dID)
               {
                  jQuery.ajax({
                     url : 'getldlocation/getldunit/' + dID,
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
