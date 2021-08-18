@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'User Management' => route('view-user'),
    'Add User' => route('add-user'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD USER') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('submit_user') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right size">{{ __('Display Name/प्रदर्शित होने वाला नाम') }}</label><span style="color:red"> *</span>

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
                            <label for="email" class="col-md-4 col-form-label text-md-right size">{{ __('E-Mail Address/ईमेल पता') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_code" class="col-md-4 col-form-label text-md-right size">{{ __('Employee Code/कर्मचारी आयडी') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="emp_code" type="text" placeholder= "CAS-" class="form-control @error('emp_code') is-invalid @enderror" name="emp_code" value="{{ old('emp_code') }}" required autocomplete="emp_code" minlength=4 maxlength=4 autofocus>

                                @error('emp_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                           <label for="operational_company_id" class="col-md-4 col-form-label text-md-right size">{{ __('Company/कंपनी') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            
                                <select id="operational_company_id" readonly name="operational_company_id" class="form-control @error('operational_company_id') is-invalid @enderror">
                                    @foreach ($company as $key => $value)
                               
                                      <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach 
                                </select>

                                @error('operational_company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                       
                        <div class="form-group row">
                           <label for="role" class="col-md-4 col-form-label text-md-right size">{{ __('Designation/पदनाम ') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            
                                <select id="role" name="role" class="form-control @error('role') is-invalid @enderror">
                                    <option value="" disabled selected>Select Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right size">{{ __('Password/पासवर्ड') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right size">{{ __('Confirm Password/पासवर्ड की पुष्टि कीजिये') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Register') }}
                                </button>
                                <a href="{{ route('view-user') }}" class="btn btn-danger">Back</a>                             </div>

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
