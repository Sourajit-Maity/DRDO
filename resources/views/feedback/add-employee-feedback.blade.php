@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'My Evaluation' => '#',
   
    'Give Feedback' => route('add-employee-feedback'),

]])
<div id="app">
        @include('layouts.flash-message')


        @yield('content')
    </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Give Feedback') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('submit_employee_feedback') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="feedback_to_id" class="col-md-4 col-form-label text-md-right">{{ __('Feedback Person/प्रतिक्रिया व्यक्ति') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                
                                <select  name="feedback_to_id" id="feedback_to_id" class="form-control @error('feedback_to_id') is-invalid @enderror" name="feedback_to_id"  required autocomplete="feedback_to_id">
                                <option value="" disabled selected>Select Person</option>
                                    @foreach($employee as $user)
                                        <option value="{{$user->id}}">{{$user->emp_nick_name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('feedback_to_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="feedback_category" class="col-md-4 col-form-label text-md-right">{{ __('Feedback Category/प्रतिक्रिया श्रेणी') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                             
                          
                            <select  name="feedback_category" id="feedback_category" class="form-control @error('feedback_category') is-invalid @enderror" name="feedback_category" value="{{ old('feedback_category') }}" required autocomplete="feedback_category">
                                 <option value="" disabled selected>Select Feedback Category</option>
                                    @foreach($feedbackcategory as $feedbackcategorys)
                                        <option value="{{$feedbackcategorys->id}}">{{$feedbackcategorys->feedback}}</option>
                                    @endforeach                                            
                                                     
                             </select>                          
                         
                                @error('feedback_category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="feedback_type" class="col-md-4 col-form-label text-md-right">{{ __('Feedback Type/प्रतिक्रिया प्रकार') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">   
                            <select  name="feedback_type" id="feedback_type" class="form-control @error('feedback_type') is-invalid @enderror" name="feedback_type" value="{{ old('feedback_type') }}" required autocomplete="feedback_type">
                                 <option value="" disabled selected>Select Feedback Type</option>
                                 <option value="POSITIVE">POSITIVE</option>
                                 <option value="NEGATIVE">NEGATIVE</option>
                                 <option value="OBSERVATION">OBSERVATION</option>
                                                                               
                                                     
                             </select>
                                @error('feedback_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                     
                       
                        <div class="form-group row">
                            <label for="feedback_comment" class="col-md-4 col-form-label text-md-right">{{ __('Feedback Comment/प्रतिक्रिया टिप्पणी') }}</label>

                            <div class="col-md-6">
                                
                                <textarea id="feedback_comment" class="form-control @error('feedback_comment') is-invalid @enderror"  name="feedback_comment"  required autocomplete="feedback_comment" rows="4" cols="50"></textarea>
                                
                                
                                @error('feedback_comment')
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
