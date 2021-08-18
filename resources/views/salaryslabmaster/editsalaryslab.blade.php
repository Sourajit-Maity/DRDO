@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Salary Slab' => route('view-salary-slab'),
    'Edit Salary Slab' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Salary Slab') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('update-salary-slab', $type->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="salary_slab" class="col-md-4 col-form-label text-md-right">{{ __('Salary Slab/वेतन स्लैब का नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="salary_slab" type="text" class="form-control @error('salary_slab') is-invalid @enderror" name="salary_slab"  value="{{ $type->salary_slab }}" required autocomplete="salary_slab">

                                @error('salary_slab')
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
                                <a href="{{ route('view-salary-slab') }}" class="btn btn-danger">Back</a>                             </div>
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
