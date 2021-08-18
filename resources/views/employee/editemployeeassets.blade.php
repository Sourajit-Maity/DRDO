@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    
    'Admin' => '#',
    'Employee' => route('view-employee'),
    'Edit Employee Assets' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Assets') }}</div>

                <div class="card-body">
                <form  action="{{ route('update-employee-assets', $asset->id) }}" method="POST" enctype="multipart/form-data">
                   
                        @csrf
                
                        <div class="form-group row">
                            <label for="property_name" class="col-md-4 col-form-label text-md-right">{{ __('Assets Name/संपत्ति का नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            <input id="emp_id" type="hidden" class="form-control @error('emp_id') is-invalid @enderror" name="emp_id" value="{{ $asset->emp_id }}" required autocomplete="emp_id" autofocus>
                            <select class="form-control @error('property_name') is-invalid @enderror"  name="property_name" value="{{ $asset->property_name }}" required>
                            @foreach($oldskill as $oldskills)
                                        <option value="{{$oldskills->property_id}}">{{$oldskills->assets_nme}}</option>
                                    @endforeach 
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
                         
                            <select class="form-control @error('property_details') is-invalid @enderror" value="{{ $asset->property_details }}" name="property_details" required>
                            @foreach($oldskill as $oldskills)
                                        <option value="{{$oldskills->details_id}}">{{$oldskills->assets_detail}}</option>
                                    @endforeach 
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
                                <input id="giving_date" type="date" class="form-control @error('giving_date') is-invalid @enderror" name="giving_date" value="{{ $asset->giving_date }}" required autocomplete="giving_date" autofocus>

                                @error('giving_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="return_date" class="col-md-4 col-form-label text-md-right">{{ __('Return Date/वापसी दिनांक') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="return_date" type="date" class="form-control @error('return_date') is-invalid @enderror" name="return_date" value="{{ $asset->return_date }}" required autocomplete="return_date">

                                @error('return_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="return_property_conditions" class="col-md-4 col-form-label text-md-right">{{ __('Return Assets Conditions/वापसी संपत्ति शर्तें') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="return_property_conditions" type="text" class="form-control @error('return_property_conditions') is-invalid @enderror" name="return_property_conditions" value="{{ $asset->return_property_conditions }}" required autocomplete="return_property_conditions">

                                @error('return_property_conditions')
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
