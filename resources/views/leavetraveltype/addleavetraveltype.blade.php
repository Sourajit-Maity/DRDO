@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Leave Configure' => '#',
    'Leave Travel Concession Type' => route('view-leave-travel-concession-type'),
    'Add Leave Travel Concession Type' => route('add-leave-travel-concession-type'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD Leave Travel Concession Type') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('submit-leave-travel-concession-type') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="leave_travel_concession" class="col-md-4 col-form-label text-md-right size">{{ __('Leave Travel Concession Type/अवकाश यात्रा रियायत प्रकार का नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="leave_travel_concession" type="text" class="form-control @error('leave_travel_concession') is-invalid @enderror" name="leave_travel_concession" value="{{ old('leave_travel_concession') }}" required autocomplete="leave_travel_concession">

                                @error('leave_travel_concession')
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
                                <a href="{{ route('view-leave-travel-concession-type') }}" class="btn btn-danger">Back</a>                             </div>
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
