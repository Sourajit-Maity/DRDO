@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Vaccine' => route('view-vaccine-employee'),
    'Add Vaccine' => route('add-vaccine-employee'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Vaccine Details') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('submit-vaccine-employee') }}" enctype="multipart/form-data">
                        @csrf

                       
                        <div class="form-group row">
                            <label for="vaccine_id" class="col-md-4 col-form-label text-md-right">{{ __('Vaccine /टीका') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            <select name="vaccine_id" id="vaccine_id" class="form-control @error('vaccine_id') is-invalid @enderror" required autocomplete="vaccine_id">
                                <option value="" disabledselected>Select Vaccine</option>
                                @foreach ($vaccine as $vac)
                                <option value="{{$vac->id}}">{{$vac->vaccine_name}}</option>
                                @endforeach
                            </select>

                                @error('vaccine_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dose_taken" class="col-md-4 col-form-label text-md-right">{{ __('Vaccine Dose/टीका') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            <select name="dose_taken" id="dose_taken" class="form-control @error('dose_taken') is-invalid @enderror" required autocomplete="dose_taken">
                                <option value="" disabledselected>Select Dose Type</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>

                                @error('dose_taken')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_taken" class="col-md-4 col-form-label text-md-right">{{ __('Vaccination Date/टीकाकरण तिथि') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="date_taken" type="date" class="form-control @error('date_taken') is-invalid @enderror" name="date_taken" required value="{{ old('date_taken') }}"  autocomplete="date_taken">

                                @error('date_taken')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="others_dose" class="col-md-4 col-form-label text-md-right">{{ __('Others/अन्य') }}</label>

                            <div class="col-md-6">
                                <input id="others_dose" type="text" class="form-control" name="others_dose" value="{{ old('others_dose') }}"  autocomplete="others_dose">

                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vaccine_certificate" class="col-md-4 col-form-label text-md-right">{{ __('Vaccine Certificate/अन्य') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="vaccine_certificate" type="file" class="form-control @error('vaccine_certificate') is-invalid @enderror" name="vaccine_certificate" required value="{{ old('vaccine_certificate') }}"  autocomplete="vaccine_certificate">

                                @error('vaccine_certificate')
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
                                <a href="{{ route('view-vaccine-employee') }}" class="btn btn-danger">Back</a>                             </div>
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
