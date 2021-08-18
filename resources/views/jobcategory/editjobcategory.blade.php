@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Job Category ' => route('view-jobcategory'),
    'Edit Job Category ' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Job Category ') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('update-jobcategory', $type->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="job_category" class="col-md-4 col-form-label text-md-right">{{ __('Job Category  Name') }}</label>

                            <div class="col-md-6">
                                <input id="job_category" type="text" class="form-control @error('job_category') is-invalid @enderror" name="job_category"  value="{{ $type->job_category }}" required autocomplete="job_category">

                                @error('job_category')
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
