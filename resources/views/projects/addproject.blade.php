@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    
    'Admin' => '#',
    'Project' => '#',
    'Add Project' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Project') }}</div>

                <div class="card-body">
                <form  action="{{ route('submit_project') }}" method="POST" enctype="multipart/form-data">
                   
                        @csrf

                        <div class="form-group row">
                            <label for="project_name" class="col-md-4 col-form-label text-md-right">{{ __('Project Name') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                               
                            <input id="project_name" type="text" class="form-control @error('project_name') is-invalid @enderror" name="project_name"   required autocomplete="project_name">

                                @error('project_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company_id" class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                             
                          
                            <select  name="company_id" id="company_id" class="form-control @error('company_id') is-invalid @enderror" name="company_id" value="{{ old('company_id') }}" required autocomplete="company_id">
                                 <option value="" disabled selected>Select Company</option>
                                    @foreach($company as $companys)
                                        <option value="{{$companys->id}}">{{$companys->c_name}}</option>
                                    @endforeach                                            
                                                     
                             </select>                          
                         
                                @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="location_id" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">   
                            <select  name="location_id" id="location_id" class="form-control @error('location_id') is-invalid @enderror" name="location_id" value="{{ old('location_id') }}" required autocomplete="location_id">
                                 <option value="" disabled selected>Select Location</option>
                                    @foreach($location as $companys)
                                        <option value="{{$companys->id}}">{{$companys->l_name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('location_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                     
                       
                        <div class="form-group row">
                            <label for="emp_id" class="col-md-4 col-form-label text-md-right">{{ __('Admin') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                
                                <select  name="emp_id" id="emp_id" class="form-control @error('emp_id') is-invalid @enderror" name="emp_id"  required autocomplete="emp_id">
                                <option value="" disabled selected>Select Admin</option>
                                    @foreach($user as $reportings)
                                        <option value="{{$reportings->id}}">{{$reportings->emp_nick_name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('emp_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label for="planned_start_date" class="col-md-4 col-form-label text-md-right">{{ __('Planned Start Date') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                               
                            <input id="planned_start_date" type="date" class="form-control @error('planned_start_date') is-invalid @enderror" name="planned_start_date"   required autocomplete="planned_start_date">

                                @error('planned_start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="planned_end_date" class="col-md-4 col-form-label text-md-right">{{ __('Planned End Date') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                               
                            <input id="planned_end_date" type="date" class="form-control @error('planned_end_date') is-invalid @enderror" name="planned_end_date"   required autocomplete="planned_end_date">

                                @error('planned_end_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="actual_start_date" class="col-md-4 col-form-label text-md-right">{{ __('Actual Start Date') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                               
                            <input id="actual_start_date" type="date" class="form-control @error('actual_start_date') is-invalid @enderror" name="actual_start_date"   required autocomplete="actual_start_date">

                                @error('actual_start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="actual_end_date" class="col-md-4 col-form-label text-md-right">{{ __('Actual End Date') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                               
                            <input id="actual_end_date" type="date" class="form-control @error('actual_end_date') is-invalid @enderror" name="actual_end_date"   required autocomplete="actual_end_date">

                                @error('actual_end_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="project_description" class="col-md-4 col-form-label text-md-right">{{ __('Project Description') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                               
                            <input id="project_description" type="text" class="form-control @error('project_description') is-invalid @enderror" name="project_description"   required autocomplete="project_description">

                                @error('project_description')
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
