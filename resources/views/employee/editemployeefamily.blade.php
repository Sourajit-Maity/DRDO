@extends('adminlte::page')
@include('layouts.apps')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    
    'Admin' => '#',
    'Employee' => route('view-employee'),
    'Edit Employee Family' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Employee Family') }}</div>

                <div class="card-body">
                <form  action="{{ route('update-family-info', $family->id) }}" method="POST" enctype="multipart/form-data">
                   
                        @csrf
                        
                        <div class="form-group row">
                            <label for="member_name" class="col-md-4 col-form-label text-md-right">{{ __('Member Name/सदस्य का नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="member_name" type="text" class="form-control @error('member_name') is-invalid @enderror" name="member_name"  value="{{ $family->member_name }}" required autocomplete="member_name">
                                <input id="emp_id" type="hidden" class="form-control @error('emp_id') is-invalid @enderror" name="emp_id" value="{{ $family->emp_id }}" required autocomplete="emp_id" autofocus>

                                @error('member_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('DOB/जन्म तारीख') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob"  value="{{ $family->dob }}" required autocomplete="dob">

                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="contact_no" class="col-md-4 col-form-label text-md-right">{{ __('Contact No/संपर्क नंबर') }}</label>

                            <div class="col-md-6">
                                <input id="contact_no" type="text" class="form-control @error('contact_no') is-invalid @enderror only-numeric" name="contact_no" maxlength="12"  value="{{ $family->contact_no }}" required autocomplete="contact_no">

                                @error('contact_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addhar_no" class="col-md-4 col-form-label text-md-right">{{ __('Aadhar No/आधार नंबर') }}</label>

                            <div class="col-md-6">
                                <input id="addhar_no" type="text" class="form-control @error('addhar_no') is-invalid @enderror only-numeric" name="addhar_no" maxlength="12" value="{{ $family->addhar_no }}" required autocomplete="addhar_no">

                                @error('addhar_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="relation" class="col-md-4 col-form-label text-md-right">{{ __('Relation/रिश्ता') }}</label>

                            <div class="col-md-6">
                            <select class="form-control @error('relation') is-invalid @enderror"  name="relation" >

                            
                            <option value='{{ $family->relation }}'>{{ $family->relation }}</option>
                                <option value='Father'>Father</option>
                                <option value='Mother'>Mother</option> 
                                <option value='Spouse'>Spouse</option>
                                <option value='Son'>Son</option>
                                <option value='Daughter'>Daughter</option> 
				            </select>
                       
                                @error('skill_grade')
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
