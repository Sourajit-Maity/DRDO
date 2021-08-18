@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Grade Type' => route('view-grade-master'),
    'Add Grade Type' => route('add-grade-master'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD Grade Type') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('submit-grade-master') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="grade_master" class="col-md-4 col-form-label text-md-right">{{ __('Grade Type/ग्रेड का प्रकार') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="grade_master" type="text" class="form-control @error('grade_master') is-invalid @enderror" name="grade_master" value="{{ old('grade_master') }}" required autocomplete="grade_master">

                                @error('grade_master')
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
                                <a href="{{ route('view-grade-master') }}" class="btn btn-danger">Back</a>                             </div>
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
