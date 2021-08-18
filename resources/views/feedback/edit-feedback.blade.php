@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Feedback' => 'all-feedback',
    'Edit Feedback' => '#',
    

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Feedback') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('update-feedback', $feedback->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="feedback" class="col-md-4 col-form-label text-md-right">{{ __('Feedback/प्रतिपुष्टि') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="feedback" type="text" class="form-control @error('feedback') is-invalid @enderror" name="feedback"  value="{{ $feedback->feedback }}" required autocomplete="feedback">

                                @error('feedback')
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
                                <a href="{{ route('all-feedback') }}" class="btn btn-danger">Back</a>                             </div>
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
