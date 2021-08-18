@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Company Master' => route('view-company'),
    'Edit Company' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('EDIT Company') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('update-company', $company->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="c_name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name//कंपनी का नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="c_name" type="text" class="form-control @error('c_name') is-invalid @enderror" name="c_name" value="{{ $company->c_name }}" required autocomplete="c_name" autofocus>

                                @error('c_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="res_company_name" class="col-md-4 col-form-label text-md-right">{{ __('Company Abbreviation//कंपनी का संक्षिप्त नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="res_company_name" type="text" class="form-control @error('res_company_name') is-invalid @enderror" name="res_company_name" value="{{ $company->res_company_name }}" required autocomplete="res_company_name" placeholder="(1-4 Characters)" autofocus>

                                @error('res_company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tax_id" class="col-md-4 col-form-label text-md-right">{{ __('PAN No./पैन नंबर') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="tax_id" type="text" class="form-control @error('tax_id') is-invalid @enderror" name="tax_id" value="{{ $company->tax_id }}" required autocomplete="tax_id" maxlength="10" autofocus>

                                @error('tax_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="registration_number" class="col-md-4 col-form-label text-md-right">{{ __('Registration No/पंजीकरण क्रमांक') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="registration_number" type="text" class="form-control @error('registration_number') is-invalid @enderror" name="registration_number" value="{{ $company->registration_number }}" required autocomplete="registration_number"  maxlength="12" autofocus>

                                @error('registration_number')
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
                                <a href="{{ route('view-company') }}" class="btn btn-danger">Back</a>                             
                                </div>
                               
                               
                            </div> 
                        </div>
                        <div class="form-group row">
                            <label for="operational_company_location_id" class="col-md-4 col-form-label text-md-right"><a href="{{route('add-company-location')}}"> {{ __('Add Location') }}  </a></label>
                            <label for="operational_company_location_id" class="col-md-4 col-form-label text-md-right"><a href="{{ route('view-location',[$company->id]) }}"> {{ __('View Location') }}  </a></label>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('footerimport')
@endsection
