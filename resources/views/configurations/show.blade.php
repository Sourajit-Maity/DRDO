@extends('adminlte::page')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Configuration</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('configurations.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <!-- <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                {{ $configuration->title }}
            </div>
        </div> -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $configuration->description }}
            </div>
        </div>
    </div>
@endsection