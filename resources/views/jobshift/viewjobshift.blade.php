@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'View Jobshift ' => route('view-jobshift'),
]])
@section('plugins.Datatables', true)
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>Job Shift</h2>
            </div>
            <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-jobshift') }}"><i class="fas fa-plus-square"></i></a>
            </div>
            
        </div>
            <div class="table-responsive">
           
        
               
                <table id="myTable" class="table table-bordered table-striped {{ count($type) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        
                        <th> Serial No.</th>
                        <th>Job Id</th>
                        <th>CRM</th>
                        <th>Words</th>
                        <th>Shifted From</th>
                        <th>Shifted To</th>
                        <th> Shifted Date</th>
                        <th>Delivery Date</th>
                        <th>payable/Non-Payable</th>
                        
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($type) > 0)
                        @foreach ($type as $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <!-- <td></td> -->
                                
                                <td>{{ $user->serial_no }}</td>
                                <td>{{ $user->job_id }}</td>
                                <td>{{ $user->crm }}</td>
                                <td>{{ $user->words }}</td>
                                <td>{{ $user->emp_nick_name }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->shifted_date }}</td>
                                <td>{{ $user->delivery_date }}</td>
                                
                                @if($user->payable =='0') 
								<td>Non Payable</td>
                           
                                @else  
                                <td> Payable</td>  
                                @endif
                                     

                                
                             <td> 

                                  
                                       <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal{{$user->id}}"><i class="far fa-trash-alt"></i></button></td>

                                <div class="container">
                                    <div class="modal fade" id="myModal{{$user->id}}" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" style="text-indent: 0;">&times;</button>
                                                    <h4 class="modal-title">Jobshift </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Sure about delete this</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{route('deletejobshift',['id'=>$user->id])}}" class="btn btn-xs btn-info"><i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div></td>
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
  
