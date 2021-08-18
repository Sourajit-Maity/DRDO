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
                <h2>Education Documents</h2>
            </div>
            <div class="form-group col-md-12"; align="right">
            @foreach ($edudoc as $edu)
                <iframe src="{{url('assets/edudoc')}}/{{$edu->edu_doc}}#page=2" width=”100%” height=”100%”>
            @endforeach
            </div>

           
            
        </div>
           
        </div>
    </div>
    @include('footerimport')
    @include('datatable')
    @endsection
  
