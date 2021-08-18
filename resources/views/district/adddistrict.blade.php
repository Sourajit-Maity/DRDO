@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Job' => '#',
    'District' => route('view-district'),
    'Add District' => route('add-district'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD District') }}</div>

                <div class="card-body">
                    <form method="PUT" action="{{ route('submit_district') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="state_id" class="col-md-4 col-form-label text-md-right">{{ __('State/राज्य') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                             
                                <select  name="state_id" id="state_id" class="form-control @error('state_id') is-invalid @enderror" name="state_id"  required autocomplete="state_id">
                                 <option value="" disabled selected>Select State</option>
                                    @foreach($state as $states)
                                        <option value="{{$states->id}}">{{$states->state_name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('state_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="district_name" class="col-md-4 col-form-label text-md-right">{{ __('District Name/जिले का नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="district_name" type="text" class="form-control @error('district_name') is-invalid @enderror" name="district_name" value="{{ old('district_name') }}" required autocomplete="district_name">

                                @error('district_name')
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
                                <a href="{{ route('view-district') }}" class="btn btn-danger">
                                   Back</a>                           
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
