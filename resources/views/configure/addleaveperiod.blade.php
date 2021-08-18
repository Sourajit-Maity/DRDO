@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Leave' => '#',
    'Configure' => '#',
    'Leave Period' => route('view-leave-type'),
    'Add Leave Period' => route('add-leave-period'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Leave Period') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('submit_leave_period') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="leave_period_start_date" class="col-md-4 col-form-label text-md-right size">{{ __('Start Date/आरंभ करने की तारीख') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="leave_period_start_date" type="date" class="form-control @error('leave_period_start_date') is-invalid @enderror" name="leave_period_start_date" value="{{ old('leave_period_start_date') }}" required autocomplete="leave_period_start_date " autofocus>

                                @error('leave_period_start_date')
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
                                <a href="{{ route('view-leave-period') }}" class="btn btn-danger">Back</a>                             
                                </div>
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
