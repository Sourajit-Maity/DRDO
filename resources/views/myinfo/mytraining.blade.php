@extends('adminlte::page')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'My Activity' => '#',
    'Training' => '#',
    
 
]]) 

<div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
            <div class="card-header"></div>
                <div class="card-body">

                <div class="card-body">

                <div class="panel panel-default">
                <div class="panel-body">
                <div class="row">
                <div class="form-group col-md-6">
                <h2>My Training</h2>
                </div>
                <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-employeetraining') }}"><i class="fas fa-plus-square"></i></a>
            </div>
            
                </div>
                <div class="table-responsive">



                <table id="myTable" class="table table-bordered table-striped {{ count($training) > 0 ? 'datatable' : '' }} pointer">
                <thead>
                <tr>
                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                    
                    <th>Trainer Name</th>
                    <th>Training Date</th>
                    <th>Training Time</th>
                    <th>Subject</th>
                    <th>Topics</th>
                    <th>Duration From</th>
                    <th>Duration To</th>
                   
                </tr>
                </thead>

                <tbody>
                @if (count($training) > 0)
                    @foreach ($training as $value)
                    
                        <tr data-entry-id="{{ $value->id }}">
                            <!-- <td></td> -->
                            
                            <td>{{ $value->emp_nick_name }}</td>
                            <td>{!! \Carbon\Carbon::parse($value->training_date)->format('d M Y') !!}</td>
                            <td>{{ $value->training_time }}</td>
                           
                            <td>{{ $value->subject }}</td>
                           
                            <td>{{ $value->topics }}</td>
                            <td>{!! \Carbon\Carbon::parse($value->duration_from)->format('d M Y') !!}</td>
                            <td>{!! \Carbon\Carbon::parse($value->duration_to)->format('d M Y') !!}</td>
           
                           
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
            </div>
        </div>
    </div>
</div>

@include('footerimport')
@endsection
