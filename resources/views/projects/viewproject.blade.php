@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Projects' => '#',
    'View-Projects' => route('view-project'),

]])
@section('plugins.Datatables', true)
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>Projects</h2>
            </div>
            <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-project') }}"><i class="fas fa-plus-square"></i></a>
            </div>
            
        </div>
            <div class="table-responsive">
           
        
               
                <table id="myTable" class="table table-bordered table-striped {{ count($projects) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        
                        
                        <th>Projects Name</th>
                        <th>Admin Name</th>
                        <th> Company</th>
                        <th> Location</th>
                     
                       
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($projects) > 0)
                        @foreach ($projects as $project)
                            <tr data-entry-id="{{ $project->id }}">
                                <!-- <td></td> -->
                                
                                <td>{{ $project->project_name }}</td>
                                <td>{{ $project->emp_nick_name }}</td>
                                <td>{{ $project->c_name }}</td>
                                <td>{{ $project->l_name }}</td>
                               
                         
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
  
