@extends('adminlte::page')
@include('layouts.apps')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    
    'Admin' => '#',
    'Employee' => route('view-employee'),
    'Add Employee Promotion' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add Promotion') }}</div>
 
                <div class="card-body">
                <form  action="{{ route('submit_employee_promotion', $promotion->id) }}" method="POST" enctype="multipart/form-data">
                   
                        @csrf
              
                        <div class="form-group row">
                            <label for="promotion_date" class="col-md-4 col-form-label text-md-right">{{ __('Promotion Date/पदोन्नति तारीख') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="promotion_date" type="date" class="form-control @error('promotion_date') is-invalid @enderror" name="promotion_date"  required autocomplete="promotion_date" autofocus>

                                @error('promotion_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="effective_from" class="col-md-4 col-form-label text-md-right">{{ __('Effective From/से प्रभावी') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="effective_from" type="date" class="form-control @error('effective_from') is-invalid @enderror" name="effective_from"  required autocomplete="effective_from" autofocus>

                                @error('effective_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_designation" class="col-md-4 col-form-label text-md-right">{{ __('New Designation/नया पदनाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            <select  name="last_designation" id="last_designation" 
                    class="form-control @error('last_designation') is-invalid @enderror" 
                    required autocomplete="last_designation">
                   
                    
                    <option value=""disable selected>Select Designation</option>    
                            @foreach ($roles as $key => $value)
                               
                                        <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach                                            
                                                     
                             </select>

                                @error('last_designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_salary" class="col-md-4 col-form-label text-md-right">{{ __('New Salary/आखरी तनख्वा') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="last_salary" type="text" class="form-control @error('last_salary') is-invalid @enderror only-numeric" name="last_salary"  required autocomplete="last_salary" autofocus>

                                @error('last_salary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="letters" class="col-md-4 col-form-label text-md-right">{{ __('All Promotion and Increment Letters/सभी पदोन्नति और वेतन वृद्धि पत्र') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                               
                                <input type="file" name="letters" class="form-control @error('letters') is-invalid @enderror">
                                @error('letters')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Submit') }}
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
