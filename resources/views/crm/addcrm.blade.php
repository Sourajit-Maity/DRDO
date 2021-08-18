@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Travel By' => route('view-crm'),
    'Add Travel By' => route('add-crm'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD Travel By') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('submit_crm') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="crm" class="col-md-4 col-form-label text-md-right">{{ __('Travel By') }}</label>

                            <div class="col-md-6">
                                <input id="crm" type="text" class="form-control @error('crm') is-invalid @enderror" name="crm" value="{{ old('crm') }}" required autocomplete="crm">

                                @error('crm')
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
