@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'State' => route('view-state'),
    'Edit State' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit State') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('update-state', $type->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="state_name" class="col-md-4 col-form-label text-md-right">{{ __('State Name/राज्य का नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="state_name" type="text" class="form-control @error('state_name') is-invalid @enderror" name="state_name"  value="{{ $type->state_name }}" required autocomplete="state_name">

                                @error('state_name')
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
                                <a href="{{ route('view-state') }}" class="btn btn-danger">Back</a>                             </div>
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
