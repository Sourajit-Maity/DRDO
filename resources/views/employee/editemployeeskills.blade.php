@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    
    'Admin' => '#',
    'Employee' => route('view-employee'),
    'Edit Skills' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Skills') }}</div>

                <div class="card-body">
                <form  action="{{ route('update-employee-skills', $skills->id) }}" method="POST" enctype="multipart/form-data">
                   
                        @csrf
                        <div class="form-group row">
                            <label for="skills" class="col-md-4 col-form-label text-md-right">{{ __('Skills/कौशल') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            <input id="emp_id" type="hidden" class="form-control @error('emp_id') is-invalid @enderror" name="emp_id" value="{{ $skills->emp_id }}" required autocomplete="emp_id" autofocus>
                            <select class="form-control @error('emp_skill_id') is-invalid @enderror"  name="emp_skill_id" >
                            @foreach($oldskill as $oldskills)
                                        <option value="{{$oldskills->skill_id}}">{{$oldskills->skill_name}}</option>
                                    @endforeach 
                                    @foreach($empskills as $skill)
                                        <option value="{{$skill->id}}">{{$skill->name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                       
                                @error('skills')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="skill_grade" class="col-md-4 col-form-label text-md-right">{{ __('Skill Grade/कौशल ग्रेड') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                             
                            <select class="form-control @error('skill_grade') is-invalid @enderror"  name="skill_grade" >
                                    
                            <option value="{{$skills->skill_grade}}">{{$skills->skill_grade}}</option>
                                                       <option value='1'>1</option>
                                                        <option value='2'>2</option> 
                                                        <option value='3'>3</option>
                                                        <option value='4'>4</option> 
                                                        <option value='5'>5</option>
                                 
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
