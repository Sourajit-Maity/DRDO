@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Excel' => '#',
    'Import Excel' => '#',
    'Export Excel' => '#',

]])
   
<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
             Import Export Excel
        </div>
        <div class="card-body">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import User Data</button>
                <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>
            </form>
        </div>
    </div>
</div>
@include('footerimport')
@endsection
