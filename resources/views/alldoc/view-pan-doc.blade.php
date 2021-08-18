@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    
    'All Documents' => route('view-all-doc'),

]])
@section('plugins.Datatables', true)
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-12">
                <h2>Pan Documents</h2>
            </div>
            <div class="form-group col-md-12"; align="right">
            
                <iframe src="{{url('assets/pandoc')}}/{{$pandoc->pan_doc}}#page=2" width=”100%” height=”100%”>
           
            </div>

           
            
        </div>
           
        </div>
    </div>
    @include('footerimport')
    @include('datatable')
    @endsection
  
