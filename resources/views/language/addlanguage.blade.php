@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Job' => '#',
    'Language' => route('view-language'),
    'Add Language' => route('add-language'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD Language') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('submit_language') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="lng_name" class="col-md-4 col-form-label text-md-right">{{ __('Language Name/भाषा का नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="lng_name" type="text" class="form-control @error('lng_name') is-invalid @enderror" name="lng_name" value="{{ old('lng_name') }}" required autocomplete="lng_name">

                                @error('lng_name')
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
                                <a href="{{ route('view-language') }}" class="btn btn-danger">Back</a>                             </div>
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
