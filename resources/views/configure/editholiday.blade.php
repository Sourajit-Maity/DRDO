@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Leave' => '#',
    'Configure' => '#',
    'Holiday' => route('view-holiday'),
    'Edit Holiday' => '#',

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('EDIT Holiday') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('update-holiday', $holiday->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description/विवरण') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $holiday->description }}" required autocomplete="description" autofocus>

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
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ $holiday->date }}" required autocomplete="date " autofocus>

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
                            <select  name="recurring" id="recurring" class="form-control @error('recurring') is-invalid @enderror" name="recurring" value="{{ $holiday->recurring }}" required autocomplete="recurring">
                                                   @if($holiday->recurring == 0)
                                                      <option value='0'>Full Day</option>
                                                    @else
                                                      <option value='1'>Half Day</option>
                                                    @endif
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
                                    {{ __('Save') }}
                                </button>
                                <a href="{{ route('view-holiday') }}" class="btn btn-danger">Back</a>                             </div>
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
