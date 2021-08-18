@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'My Activity' => '#',
    'Exam Score' => route('view-employeeexamscore'),

]])
@section('plugins.Datatables', true)
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>Exam Score</h2>
            </div>
            <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-employeeexamscore') }}"><i class="fas fa-plus-square"></i></a>
            </div>
            
        </div>
            <div class="table-responsive">
           
        
               
                <table id="myTable" class="table table-bordered table-striped {{ count($report) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        
                        
                        <th>Employee Name</th>
                        <th>Trainer Name</th>
                        <th>Training Date</th>
                        
                        <th>Training Time</th>
                        <th>Subject</th>
                        
                        <th>Topics</th>
                        <th>Duration From</th>
                        <th>Duration To</th>
                        <th>Exam score</th>
                        
                       
                        
                       
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($report) > 0)
                        @foreach ($report as $reports)
                            <tr data-entry-id="{{ $reports->id }}">
                                
                                
                                <td>{{ $reports->name }}</td>
                                <td>{{ $reports->emp_nick_name }}</td>
                                <td>{!! \Carbon\Carbon::parse($reports->exam_score_date)->format('d M Y') !!}</td>
                                <td>{!! \Carbon\Carbon::parse($reports->exam_score_time)->format('H:i') !!}</td>

                                <td>{{ $reports->subject }}</td>
                                <td>{{ $reports->topics }}</td>
                                <td>{!! \Carbon\Carbon::parse($reports->duration_from)->format('d M Y')  !!}</td>
                                <td>{!! \Carbon\Carbon::parse($reports->duration_to)->format('d M Y')  !!}</td>
                                <td>{{ $reports->exam_score }}</td>
                         
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
  
