@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Banks' => route('view-banks'),
    'Edit Banks' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Bank') }}</div>
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="card-body">
                    <form method="PUT" action="{{ route('update-banks', $type->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="bank_name" class="col-md-4 col-form-label text-md-right">{{ __('Bank Name/बैंक का नाम') }}</label>

                            <div class="col-md-6">
                                <input id="bank_name" type="text" class="form-control @error('bank_name') is-invalid @enderror" name="bank_name" value="{{ $type->bank_name }}" required autocomplete="bank_name">

                                @error('bank_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bank_ifsc_no" class="col-md-4 col-form-label text-md-right">{{ __('Bank IFSC No./बैंक IFSC नंबर') }}</label>

                            <div class="col-md-6">
                                <input id="bank_ifsc_no" type="text" class="form-control @error('bank_ifsc_no') is-invalid @enderror" name="bank_ifsc_no" value="{{ $type->bank_ifsc_no }}" required autocomplete="bank_ifsc_no">

                                @error('bank_ifsc_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="branch_name" class="col-md-4 col-form-label text-md-right">{{ __('Branch Name/शाखा का नाम') }}</label>

                            <div class="col-md-6">
                                <input id="branch_name" type="text" class="form-control @error('branch_name') is-invalid @enderror" name="branch_name" value="{{ $type->branch_name }}" required autocomplete="branch_name">

                                @error('branch_name')
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
                                <a href="{{ route('view-banks') }}" class="btn btn-danger">Back</a>                             </div>
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
