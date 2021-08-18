@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Time Tracker' => '#',
    
    'View Review' => route('view-attandance-review'),

]])
@section('plugins.Datatables', true)
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>Time Tracker Review</h2>
            </div>
            
            
        </div>
            <div class="table-responsive">
           
        
               
                <table id="myTable" class="table table-bordered table-striped {{ count($review) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        
                        <th> Employee Name</th>
                        
                        <th>Review</th>
                        <th>Review given At</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($review) > 0)
                        @foreach ($review as $value)
                            <tr data-entry-id="{{ $value->id }}">
                                <!-- <td></td> -->
                                <td>{{ $value->emp_nick_name }}</td>
                                <td>{{ $value->review }}</td>
                                <td>{{ $value->created_at }}</td>

                                
                            
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">No entries in table</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    @include('footerimport')
    @include('datatable')
    @endsection
  
