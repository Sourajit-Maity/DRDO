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
                            <label for="advance_loan_type_name" class="col-md-4 col-form-label text-md-right">{{ __('Advance Type/अग्रिम का प्रकार') }}</label><span style="color:red"> *</span>

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
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Save') }}
                                </button>
                                <a href="{{ route('view-advancetype') }}" class="btn btn-danger">Back</a>                             </div>
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
