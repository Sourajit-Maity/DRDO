@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'User Designation' => route('view-role'),

]])
@section('plugins.Datatables', true)
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>Designation</h2>
            </div>
            <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-role') }}"><i class="fas fa-plus-square"></i></a>
            </div>
            
        </div>
            <div class="table-responsive">
           
        
               
                <table id="myTable" class="table table-bordered table-striped {{ count($role) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        <th>Designation<p>(पदनाम)</p></th>
                        
                        
                        <th>Actions<p>(कार्रवाई)</p></th>
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($role) > 0)
                        @foreach ($role as $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <!-- <td></td> -->
                                <td>{{ $user->name }}</td>
                                

                                
                             <td> <a href="{{ route('edit-role',[$user->id]) }}" class="btn btn-xs btn-info">
                                    <i class="fas fa-edit"></i></a>

                                  
                                       <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal{{$user->id}}"><i class="far fa-trash-alt"></i></button></td>

                                <div class="container">
                                    <div class="modal fade" id="myModal{{$user->id}}" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" style="text-indent: 0;">&times;</button>
                                                    <h4 class="modal-title">Role </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Sure about delete this</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{route('deleterole',['id'=>$user->id])}}" class="btn btn-xs btn-info"><i class="fa fa-trash fa-lg" aria-hidden="true"></i>
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
  
