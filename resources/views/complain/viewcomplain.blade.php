@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    
    'Complain' => route('view-complain'),

]])
@section('plugins.Datatables', true)
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-12">
                <h2>Complain</h2>
            </div>
           
            
        </div>
            <div class="table-responsive">
           
        
               
                <table id="myTable" class="table table-bordered table-striped {{ count($complain) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        
                        
                        <th>User Name<p>(उपयोगकर्ता नाम)</p></th>
                        <th>Complain Against Name<p>(नाम के खिलाफ शिकायत)</p></th>
                        <th> Complain<p>(शिकायत)</p></th>
                        
                        <th> Complain Date<p>(शिकायत दी गई)</p></th>
                        
                       
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($complain) > 0)
                        @foreach ($complain as $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <!-- <td></td> -->
                                
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->emp_nick_name }}</td>
                                <td>{{ $user->complain }}</td>
                               
                                <td>{!! \Carbon\Carbon::parse($user->created_at)->format('d M Y H:i') !!}</td>

                                
                         
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
  
