@extends('adminlte::page')

@section('content')
    <div class="row">
       
        <div class="form-group col-md-6">
                <h2>Edit Configuration</h2>
            </div>
            
       
  
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Warning!</strong> Please check input field code<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('configurations.update',$configuration->id) }}" method="PUT">
        @csrf
        @method('PUT')
   
         
            <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" value="{{ $configuration->title }}" class="form-control" placeholder="Title">
                </div>
            </div> -->
            <<div class="form-group col-md-12">
                   
                    <input type="text" class="form-control" name="description" value="{{ $configuration->description     }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
    
        <div class="form-group col-md-6">
                <a class="btn btn-primary" href="{{ route('configurations.index') }}"> Back</a>
            </div>
   
    </form>
@endsection