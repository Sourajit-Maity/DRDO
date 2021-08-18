@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Job' => '#',
    'Employment Type' => route('view-employee-type'),
    'Add Employment Type' => route('add-employee-type'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD Employee Type') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('submit_employee_type') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="emp_type_name" class="col-md-4 col-form-label text-md-right">{{ __('Employee Type Name') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="emp_type_name" type="text" class="form-control @error('emp_type_name') is-invalid @enderror" name="emp_type_name" value="{{ old('emp_type_name') }}" required autocomplete="emp_type_name">

                                @error('emp_type_name')
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
                                <a href="{{ route('view-employee-type') }}" class="btn btn-danger">Back</a>                             </div>
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
