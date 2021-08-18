@extends('adminlte::page')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    
    'Admin' => '#',
    'Warning' => '#',
    'Add Warning' => '#',

]])
<div id="app">
        @include('layouts.flash-message')


        @yield('content')
    </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Warning') }}</div>

                <div class="card-body">
                <form  action="{{ route('warning-generate') }}" method="POST" enctype="multipart/form-data">
                   
                        @csrf

                        <div class="form-group row">
                            <label for="warning_header" class="col-md-4 col-form-label text-md-right">{{ __('Warning Header/चेतावनी हैडर') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                               
                            <input id="warning_header" type="text" class="form-control @error('warning_header') is-invalid @enderror" name="warning_header"   required autocomplete="warning_header">

                                @error('warning_header')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
 
                        <div class="form-group row">
                            <label for="emp_id" class="col-md-4 col-form-label text-md-right">{{ __('Employee/कर्मचारी') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                
                                <select  name="emp_id" id="emp_id" class="form-control @error('emp_id') is-invalid @enderror" name="emp_id"  required autocomplete="emp_id">
                                <option value="" disabled selected>Select Employee</option>
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
                            <label for="reason" class="col-md-4 col-form-label text-md-right">{{ __('Reason/कारण') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                               
                            <textarea id="reason" class="form-control @error('reason') is-invalid @enderror" name="reason"  required autocomplete="reason" rows="4" cols="50"></textarea>
                                
                                @error('reason')
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
