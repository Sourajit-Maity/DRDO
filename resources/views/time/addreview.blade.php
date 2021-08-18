@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Time Tracker' => '#',
    
    'Add Review' => route('add-attandance-review'),

]])
<div id="app">
        @include('layouts.flash-message')


        @yield('content')
    </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD Review') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('submit_attandance_review') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="review" class="col-md-4 col-form-label text-md-right">{{ __('Review') }}</label>

                            <div class="col-md-6">
                                <input id="review" type="text" class="form-control @error('review') is-invalid @enderror" name="review" value="{{ old('review') }}" required autocomplete="review">

                                @error('review')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
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
