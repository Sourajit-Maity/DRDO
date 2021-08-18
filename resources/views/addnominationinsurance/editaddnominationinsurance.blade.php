@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Advance Type' => route('view-advancetype'),
    'Edit Advance Type' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Advance Type') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('update-advancetype', $type->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="advance_loan_type_name" class="col-md-4 col-form-label text-md-right">{{ __('Advance Type Name') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="advance_loan_type_name" type="text" class="form-control @error('advance_loan_type_name') is-invalid @enderror" name="advance_loan_type_name"  value="{{ $type->advance_loan_type_name }}" required autocomplete="advance_loan_type_name">

                                @error('advance_loan_type_name')
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
                                <input type="button" onclick="history.go(-1);" value="Back" class="btn btn-primary">
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
