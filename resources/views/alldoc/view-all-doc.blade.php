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
                <h2>All Documents</h2>
            </div>
            <div class="form-group col-md-4"; align="right">
                <a class="btn btn-success" href="{{ route('view-pan-doc') }}">Pan Card Certificate<i class="fas fa-eye"></i></a>
            </div>

            <div class="form-group col-md-4"; align="right">
                <a class="btn btn-success" href="{{ route('view-blood-doc') }}">Blood Certificate<i class="fas fa-eye"></i></a>
            </div>

            <div class="form-group col-md-4"; align="right">
                <a class="btn btn-success" href="{{ route('view-promotion-doc') }}">Promotion Certificate<i class="fas fa-eye"></i></a>
            </div>
            
        </div>

        <div class="form-group col-md-12">
               
            </div>
            <div class="form-group col-md-4"; align="right">
                <a class="btn btn-success" href="{{ route('view-edu-doc-certificate') }}">Education Certificate<i class="fas fa-eye"></i></a>
            </div>

           
            
        </div>
           
        </div>
    </div>
    @include('footerimport')
    @include('datatable')
    @endsection
  
