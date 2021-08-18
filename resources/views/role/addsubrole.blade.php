@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'User Job Role' => route('view-sub-role'),
    'Add Job Role' => route('add-sub-role'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD Job Role') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('submit_role') }}">
                        @csrf
                        <div class="form-group row">
                           <label for="role_id " class="col-md-4 col-form-label text-md-right size">{{ __('Designation/पदनाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            
                                <select id="role_id " name="role_id" class="form-control">
                                    <option value="" disabled selected>Select Designation</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                        <div class="form-group row">
                            <label for="respname" class="col-md-4 col-form-label text-md-right size">{{ __('Job Role Name/कार्य भूमिका का नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="respname" type="text" class="form-control @error('respname') is-invalid @enderror" name="respname" value="{{ old('respname') }}" required autocomplete="respname" autofocus>

                                @error('respname')
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
                                <a href="{{ route('view-sub-role') }}" class="btn btn-danger">Back</a>                             </div>
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
