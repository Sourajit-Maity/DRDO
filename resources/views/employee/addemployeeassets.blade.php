@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    
    'Admin' => '#',
    'Employee' => route('view-employee'),
    'Add Employee Assets' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add Assets') }} 
               
                </div>
 
                <div class="card-body">
                <form  action="{{ route('submit_employee_assets', $assets->id) }}" method="POST" enctype="multipart/form-data">
                   
                        @csrf
              
                        <div class="form-group row">
                            <label for="property_name" class="col-md-4 col-form-label text-md-right">{{ __('Assets Name/संपत्ति का नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                         
                            <select class="form-control @error('property_name') is-invalid @enderror"  name="property_name" required>
                            <option value="" disabled selected>Property Name</option>
                                    @foreach($empassets as $empasset)
                                        <option value="{{$empasset->id}}">{{$empasset->assets_name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                       
                                @error('property_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="property_details" class="col-md-4 col-form-label text-md-right">{{ __('Assets Details/संपत्ति विवरण') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                         
                            <select class="form-control @error('property_details') is-invalid @enderror"  name="property_details" required>
                            <option value="" disabled selected>Property Details</option>
                                    @foreach($empassets as $empasset)
                                        <option value="{{$empasset->id}}">{{$empasset->assets_details}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                       
                                @error('property_details')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label for="giving_date" class="col-md-4 col-form-label text-md-right">{{ __('Giving Date/तारीख देना') }}</label><span style="color:red"> *</span>

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
                            <label for="return_date" class="col-md-4 col-form-label text-md-right">{{ __('Return Date/वापसी दिनांक') }}</label>

                            <div class="col-md-6">
                                <input id="return_date" type="date" class="form-control @error('return_date') is-invalid @enderror" name="return_date" value="{{ old('return_date') }}"  autocomplete="return_date">

                               
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
