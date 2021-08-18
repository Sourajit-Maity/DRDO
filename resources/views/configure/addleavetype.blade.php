@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Leave' => '#',
    'Configure' => '#',
    'Leave Type' => route('view-leave-type'),
    'Add Leave Type' => route('add-leave-type'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Leave Type') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('submit_leave_type') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name/नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exclude_in_reports_if_no_entitlement" class="col-md-4 col-form-label text-md-right">{{ __('Is entitlement situational/पात्रता स्थितिजन्य है') }}</label>

                            <div class="col-md-6">
                                <input id="exclude_in_reports_if_no_entitlement" type="checkbox" class="form-control" name="exclude_in_reports_if_no_entitlement" value="{{ old('exclude_in_reports_if_no_entitlement') }}">

                            </div>
                        </div>
     
                    
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Submit') }}
                                </button>
                                <a href="{{ route('view-leave-type') }}" class="btn btn-danger">Back</a>                             </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('footerimport')
@endsection
