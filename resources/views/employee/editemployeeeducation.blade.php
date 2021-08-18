@extends('adminlte::page')
@include('layouts.apps')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    
    'Admin' => '#',
    'Employee' => route('view-employee'),
    'Edit Education' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Education') }}</div>

                <div class="card-body">
                <form  action="{{ route('update-employee-education', $eduemployee->id) }}" method="POST" enctype="multipart/form-data">
                   
                        @csrf
                        <div class="form-group row">
                            <label for="emp_education_id" class="col-md-4 col-form-label text-md-right">{{ __('Degree Type/उपाधि प्रकार') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            <input id="emp_id" type="hidden" class="form-control @error('emp_id') is-invalid @enderror" name="emp_id" value="{{ $eduemployee->emp_id }}" required autocomplete="emp_id" autofocus> 
                            <select class="form-control @error('emp_education_id') is-invalid @enderror"  name="emp_education_id" value="{{ $eduemployee->emp_education_id }}" required>
                            @foreach($oldeducation as $oldeducations)
                                        <option value="{{$oldeducations->edu_id}}">{{$oldeducations->edu_name}}</option>
                                    @endforeach 
                                    @foreach($azheducation as $educations)
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
                            <label for="ins_name" class="col-md-4 col-form-label text-md-right">{{ __('Institute Name/संस्थान का नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="ins_name" type="text" class="form-control @error('ins_name') is-invalid @enderror" name="ins_name" value="{{ $eduemployee->ins_name }}" required autocomplete="ins_name" autofocus>

                                @error('ins_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="degree" class="col-md-4 col-form-label text-md-right">{{ __('Degree Name/उपाधी का नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="degree" type="text" class="form-control @error('degree') is-invalid @enderror" name="degree" value="{{ $eduemployee->degree }}" required autocomplete="degree" autofocus>
                                @error('degree')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="grade" class="col-md-4 col-form-label text-md-right">{{ __('Grade/ग्रेड') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="grade" type="text" class="form-control @error('grade') is-invalid @enderror" name="grade" value="{{ $eduemployee->grade }}" required autocomplete="grade" autofocus>

                                @error('grade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="year" class="col-md-4 col-form-label text-md-right">{{ __('Passing Year/बीतता साल') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="year" type="text" class="form-control @error('year') is-invalid @enderror only-numeric" name="year" value="{{ $eduemployee->year }}" required autocomplete="year" maxlength="4" autofocus>

                                @error('year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="notes" class="col-md-4 col-form-label text-md-right">{{ __('Additional Notes/अतिरिक्त टिप्पणी') }}</label>

                            <div class="col-md-6">
                                <input id="notes" type="text" class="form-control" name="notes" value="{{ $eduemployee->notes }}"  autocomplete="notes" autofocus>

                                <a href="{{ route('addemployee-edu-doc',[$eduemployee->id]) }}" class="btn btn-xs btn-info">
                                    Add Education Certificate</a>
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
