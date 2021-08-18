@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    
    'Admin' => '#',
    'Employee' => route('view-employee'),
    'Add Employee Language' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Language') }}</div>

                <div class="card-body">
                <form  action="{{ route('submit_employee_language', $emplanguage->id) }}" method="POST" enctype="multipart/form-data">
                   
                        @csrf
                        <div class="form-group row">
                            <label for="language_id" class="col-md-4 col-form-label text-md-right">{{ __('Language') }}</label>

                            <div class="col-md-6">
                             
                            <select class="form-control @error('language_id') is-invalid @enderror"  name="language_id" >
                                    @foreach($language as $languages)
                                        <option value="{{$languages->id}}">{{$languages->lng_name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                       
                                @error('language_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="proficiency" class="col-md-4 col-form-label text-md-right">{{ __('Proficiency') }}</label>

                            <div class="col-md-6">
                             
                            <select class="form-control @error('proficiency') is-invalid @enderror"  name="proficiency" >
                                    
                                        <option value="" disabled selected>Select Proficiency</option>
                                                       <option value='1'>1</option>
                                                        <option value='2'>2</option> 
                                                        <option value='3'>3</option>
                                                        <option value='4'>4</option> 
                                                        <option value='5'>5</option>
                                 
                             </select>
                       
                                @error('proficiency')
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
                                <input type="button" onclick="history.go(-1);" value="Back" class="btn btn-primary">
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
