@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Leave' => '#',
    'Entitlement' => route('view-leave-entitlement'),
    'Edit Entitlement' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('EDIT Entitlement') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('update-leave-entitlement', $leaveentitlement->id) }}">
                        @csrf

                  
               
                        <div class="form-group row" >
                            <label for="company_id" class="col-md-4 col-form-label text-md-right">{{ __('Company/कंपनी का नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            <select  name="company_id" id="company_id" class="form-control" value="{{ $leaveentitlement->company_id }}" autocomplete="company_id" >
                            @if($leaveentitlement->company_id != null) 
                                @foreach($entitlementcompany as $entitlementcompanys)
                                        <option value="{{$entitlementcompanys->company}}">{{$entitlementcompanys->company_name}}</option>
                                    @endforeach
                                    @else  
                                    <option value="" disabled selected> Select Company</option>
                                        
                                @endif
                           
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
                            <label for="leave_type_id" class="col-md-4 col-form-label text-md-right">{{ __('Leave Type/छुट्टी का प्रकार') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            <select  name="leave_type_id" id="leave_type_id" class="form-control @error('leave_type_id') is-invalid @enderror"  value="{{ $leaveentitlement->leave_type_id }}" required autocomplete="leave_type_id">
                            @if($leaveentitlement->leave_type_id != null) 
                                @foreach($entitlementtype as $entitlementtypes)
                                        <option value="{{$entitlementtypes->leave_type}}">{{$entitlementtypes->leave_name}}</option>
                                    @endforeach
                                    @else  
                                    <option value="" disabled selected>Select Leave Type</option>
                                        
                                @endif
                           
                                 
                                    @foreach($leavetype as $leavetypes)
                                        <option value="{{$leavetypes->id}}">{{$leavetypes->name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('leave_type_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="period" class="col-md-4 col-form-label text-md-right">{{ __('Leave Period/अवकाश अवधि') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            <select  name="period" id="period" class="form-control @error('period') is-invalid @enderror" name="period" value="{{ $leaveentitlement->period }}" required autocomplete="period" readonly>
                           
                                    @foreach($leaveperiod as $leaveperiods)
                                        <option value="{{$leaveperiods->id}}">{!! \Carbon\Carbon::parse($leaveperiods->leave_period_start_date)->format('d M Y') !!} -- {!! \Carbon\Carbon::parse($leaveperiods->leave_period_start_date)->addDays(364)
                                        ->format('d M Y') !!}</option>
                                    @endforeach                                            
                                                     
                            </select>
                                @error('period')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_of_days" class="col-md-4 col-form-label text-md-right">{{ __('Entitlement Days/पात्रता') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="no_of_days" type="text" class="form-control @error('no_of_days') is-invalid @enderror only-numeric" name="no_of_days" value="{{ $leaveentitlement->no_of_days }}" required autocomplete="no_of_days" autofocus>

                                @error('no_of_days')
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
                                <a href="{{ route('view-leave-entitlement') }}" class="btn btn-danger">Back</a>                             </div>
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



