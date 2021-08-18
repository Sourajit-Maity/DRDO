@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Job' => '#',
    'Country' => route('view-country'),
    'Add Country' => route('add-country'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD Country') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('submit_country') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="country_name" class="col-md-4 col-form-label text-md-right">{{ __('Country Name') }}</label>

                            <div class="col-md-6">
                                <input id="country_name" type="text" class="form-control @error('country_name') is-invalid @enderror" name="country_name" value="{{ old('country_name') }}" required autocomplete="country_name">

                                @error('country_name')
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
