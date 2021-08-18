@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'My Actrivity' => '#',
    'Daily Report' => route('view-daily-report'),

]])
@section('plugins.Datatables', true)
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>Daily Report</h2>
            </div>
           
            <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-daily-report') }}"><i class="fas fa-plus-square"></i></a>
            </div>
        </div>
            <div class="table-responsive">
           
        
               
                <table id="myTable" class="table table-bordered table-striped {{ count($report) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        
                        
                        <th>Employee Name</th>
                        <th>Date</th>
                        
                        <th>Time</th>
                        <th> Job Type</th>
                        
                        <th> Job Category</th>
                        <th>CRM</th>
                        <th> Total Words</th>
                        
                        <th> Job Id</th>
                        
                       
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($report) > 0)
                        @foreach ($report as $reports)
                            <tr data-entry-id="{{ $reports->id }}">
                                <!-- <td></td> -->
                                
                                <td>{{ $reports->emp_nick_name }}</td>
                                <td>{!! \Carbon\Carbon::parse($reports->report_date)->format('d M Y H:i') !!}</td>
                                <td>{!! \Carbon\Carbon::parse($reports->report_time)->format('H:i') !!}</td>

                                <td>{{ $reports->job_type }}</td>
                                <td>{{ $reports->job_category }}</td>
                                <td>{{ $reports->crm }}</td>
                                <td>{{ $reports->words }}</td>
                                <td>{{ $reports->job_id }}</td>
                               

                                
                         
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
  
