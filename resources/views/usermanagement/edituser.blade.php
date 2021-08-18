@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'User Management' => route('view-user'),
    'Edit User' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('EDIT USER') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('update-user', $users->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right size">{{ __('Display Name/प्रदर्शित होने वाला नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $users->name }}" required autocomplete="name" autofocus>
                                <input id="emp_id" type="hidden" class="form-control @error('emp_id') is-invalid @enderror" name="emp_id" value="{{ $users->emp_id }}" required autocomplete="emp_id"> 

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $users->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                           <label for="operational_company_id" class="col-md-4 col-form-label text-md-right size">{{ __('Company/कंपनी') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            
                                <select id="operational_company_id" name="operational_company_id" class="form-control @error('operational_company_id') is-invalid @enderror" readonly>
                                @foreach($empcompany as $empcompanys)
                                        <option value="{{$empcompanys->operational_company}}">{{$empcompanys->company_name}}</option>
                                    @endforeach
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
                            
                                <select id="role" name="role" class="form-control">
                                @foreach($emprole as $emproles)
                                        <option value="{{$emproles->designation_id}}">{{$emproles->role_name}}</option>
                                    @endforeach  
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

                      
                       

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Save') }}
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


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __(' User Password Update') }}</div>

                <div class="card-body">
        <form method="POST" action="{{ route('update-pass', $users->id) }}">
                        @csrf

                        @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                         @endforeach 
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right size">Current Password/वर्तमान पासवर्ड</label><span style="color:red"> *</span>
  
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right size">New Password/नया पासवर्ड</label><span style="color:red"> *</span>
  
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right size">New Confirm Password/नया पासवर्ड की पुष्टि करें</label><span style="color:red"> *</span>
    
                            <div class="col-md-6">
                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                            </div>
                        </div>
   
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    Update Password
                                </button>
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
