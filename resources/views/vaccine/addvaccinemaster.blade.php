@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Vaccine' => route('view-vaccine-master'),
    'Add Vaccine' => route('add-vaccine-master'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Vaccine') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('submit-vaccine-master') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="vaccine_name" class="col-md-4 col-form-label text-md-right">{{ __('Vaccine/टीका') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="vaccine_name" type="text" class="form-control @error('vaccine_name') is-invalid @enderror" name="vaccine_name" value="{{ old('vaccine_name') }}" required autocomplete="vaccine_name">

                                @error('vaccine_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vaccine_dose" class="col-md-4 col-form-label text-md-right">{{ __('Vaccine Dose/टीका') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            <select name="vaccine_dose" id="vaccine_dose" class="form-control @error('vaccine_dose') is-invalid @enderror" required autocomplete="vaccine_dose">
                                <option value="" disabledselected>Select Dose Type</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>

                                @error('vaccine_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="others" class="col-md-4 col-form-label text-md-right">{{ __('Others/अन्य') }}</label>

                            <div class="col-md-6">
                                <input id="others" type="text" class="form-control" name="others" value="{{ old('others') }}"  autocomplete="others">

                                
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Submit') }}
                                </button>
                                <a href="{{ route('all-nationality') }}" class="btn btn-danger">Back</a>                             </div>
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
