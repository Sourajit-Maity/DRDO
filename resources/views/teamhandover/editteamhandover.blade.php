@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Team Handover' => route('view-teamhandover'),
    'Edit Team Handover' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Team Handover') }}</div>
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('update-teamhandover', $type->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="emp_id" class="col-md-4 col-form-label text-md-right">{{ __('Employee') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                
                                <select  name="emp_id" id="emp_id" class="form-control @error('emp_id') is-invalid @enderror" name="emp_id"  required autocomplete="emp_id">

                                @if($type->emp_id != null) 
                                @foreach($oldemployee as $oldemployees)
                                        <option value="{{$oldemployees->emp}}">{{$oldemployees->nick_name}}</option>
                                    @endforeach
                                    @else  
                                    <option value="" disabled selected>Select Employee</option>
                                        
                                @endif

                                
                                    @foreach($employee as $reportings)
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
                            <label for="handover_emp_id" class="col-md-4 col-form-label text-md-right">{{ __('Handover To Employee') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                
                                <select  name="handover_emp_id" id="handover_emp_id" class="form-control @error('handover_emp_id') is-invalid @enderror" name="handover_emp_id"  required autocomplete="handover_emp_id">
                                @if($type->handover_emp_id != null) 
                                @foreach($olduser as $oldusers)
                                        <option value="{{$oldusers->handover_id}}">{{$oldusers->user_name}}</option>
                                    @endforeach
                                    @else  
                                    <option value="" disabled selected>Select Handover To Employee Name</option>
                                @endif
                                
                                    @foreach($employee as $reportings)
                                        <option value="{{$reportings->id}}">{{$reportings->emp_nick_name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('handover_emp_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="handover_reason" class="col-md-4 col-form-label text-md-right">{{ __('Handover Reason') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            <textarea type="text" name="handover_reason" class="form-control @error('handover_reason') is-invalid @enderror" value="{{ $type->handover_reason }}"></textarea>
                            <input id="handover_reason" type="hidden" class="form-control @error('handover_reason') is-invalid @enderror" name="handover_reason" value="{{ $type->handover_reason }}" required autocomplete="handover_reason">
                                @error('handover_reason')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="handover_from_date" class="col-md-4 col-form-label text-md-right">{{ __('Handover Form Date') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="handover_from_date" type="date" class="form-control @error('handover_from_date') is-invalid @enderror" name="handover_from_date" value="{{ $type->handover_from_date }}" required autocomplete="handover_from_date">

                                @error('handover_from_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="handover_to_date" class="col-md-4 col-form-label text-md-right">{{ __('Handover To Date') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="handover_to_date" type="date" class="form-control @error('handover_to_date') is-invalid @enderror" name="handover_to_date" value="{{ $type->handover_to_date }}" required autocomplete="handover_to_date">

                                @error('handover_to_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
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
