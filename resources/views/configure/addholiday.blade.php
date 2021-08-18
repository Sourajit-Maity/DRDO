@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Leave' => '#',
    'Configure' => '#',
    'Holiday' => route('view-holiday'),
    'Add Holiday' => route('add-holiday'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Holiday') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('submit_holiday') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description/विवरण') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date/तारीख') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autocomplete="date " autofocus>

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="recurring" class="col-md-4 col-form-label text-md-right size">{{ __('Fullday/Halfday/पूरा दिन/आधा दिन') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            <select  name="recurring" id="recurring" class="form-control @error('recurring') is-invalid @enderror" name="recurring" value="{{ old('recurring') }}" required autocomplete="recurring">
                                                       <option value='0'>Full Day</option>
                                                        <option value='1'>Half Day</option>                                             
                                                     
                                                    </select>
                                @error('recurring')
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
                                <a href="{{ route('view-holiday') }}" class="btn btn-danger">Back</a>                            
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
