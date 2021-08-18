@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    
    'Admin' => '#',
    'Employee' => route('view-employee'),
    'Add Employee Blood Document' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Add Blood Document') }}</div>
 
                <div class="card-body">
                <form  action="{{ route('submit_employee_blood_doc', $employeeblood->id) }}" method="POST" enctype="multipart/form-data">
                   
                        @csrf
              
                        <div class="form-group row">
                            <label for="blood_doc" class="col-md-4 col-form-label text-md-right size">{{ __('Employee Blood Doc/कर्मचारी रक्त दस्तावेज़') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                             
                            
                                <input type="file" name="blood_doc" class="form-control">
                                @error('blood_doc')
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
