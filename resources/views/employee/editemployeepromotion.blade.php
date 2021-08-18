@extends('adminlte::page')
@include('layouts.apps')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    
    'Admin' => '#',
    'Employee' => route('view-employee'),
    'Edit Employee Promotion' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Promotion') }}</div>

                <div class="card-body">
                <form  action="{{ route('update-employee-promotion', $promotion->id) }}" method="POST" enctype="multipart/form-data">
                   
                        @csrf
                
                        <div class="form-group row">
                            <label for="promotion_date" class="col-md-4 col-form-label text-md-right">{{ __('Promotion Date/पदोन्नति तारीख') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            <input id="emp_id" type="hidden" class="form-control @error('emp_id') is-invalid @enderror" name="emp_id" value="{{ $promotion->emp_id }}" required autocomplete="emp_id" autofocus>
                                <input id="promotion_date" type="date" class="form-control @error('promotion_date') is-invalid @enderror" name="promotion_date" value="{{ $promotion->promotion_date }}" required autocomplete="promotion_date" autofocus>

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
                                <input id="effective_from" type="date" class="form-control @error('effective_from') is-invalid @enderror" name="effective_from" value="{{ $promotion->effective_from }}" required autocomplete="effective_from" autofocus>

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
                   
                    @if($promotion->last_designation != null) 
                             @foreach($emprole as $emproles)
                                        <option value="{{$emproles->designation_id}}">{{$emproles->role_name}}</option>
                                    @endforeach
                                    @else  
                                    <option value=""disable selected>Select Designation</option>
                                        
                                @endif
                                    
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
                            <label for="last_salary" class="col-md-4 col-form-label text-md-right">{{ __('Last Salary/आखरी तनख्वा') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="last_salary" type="text" class="form-control @error('last_salary') is-invalid @enderror only-numeric" name="last_salary" value="{{ $promotion->last_salary }}" required autocomplete="last_salary" autofocus>

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
                               
                                <input type="file" name="letters" class="form-control @error('letters') is-invalid @enderror" value="{{ $promotion->letters }}">
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
@include('footerimport')
@endsection
