@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Cadre Master' => route('view-jobtype'),
    'Add Cadre Master' => route('add-jobtype'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD Cadre') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('submit_jobtype') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="job_type" class="col-md-4 col-form-label text-md-right">{{ __('Cadre Name') }}</label>

                            <div class="col-md-6">
                                <input id="job_type" type="text" class="form-control @error('job_type') is-invalid @enderror" name="job_type" value="{{ old('job_type') }}" required autocomplete="job_type">

                                @error('job_type')
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
