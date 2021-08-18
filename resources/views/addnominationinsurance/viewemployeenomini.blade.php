@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Nomination Certificate' => route('view-employee-nomini'),

]])
@section('plugins.Datatables', true)
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>Nomination Certificate</h2>
            </div>
            <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-employee-nomini') }}"><i class="fas fa-plus-square"></i></a>
            </div>
            
        </div>
            <div class="table-responsive">
           
        
               
                <table id="myTable" class="table table-bordered table-striped {{ count($report) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        
                        <th> Employee Name<p>(कर्मचारी का नाम)</p></th>
                        <th>Gpf Pran No<p>(जीपीएफ/प्रान खाता संख्या)</p></th>
                        
                        <th>Actions<p>(कार्रवाई)</p></th>
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($report) > 0)
                        @foreach ($report as $user)
                            <tr data-entry-id="{{ $user->id }}">
                            
                            <td>{{ $user->emp_nick_name }}</td>
                                <td>{{ $user->gpf_pran_no }}</td>
                                <td>
                                                            @if(Auth::user()->role=='2')
                                                          
                                                            @if($user->is_approved==0)
                                                                <form id="approve-leave-{{$user->id}}" action="{{route('employeenomini-admin-approve',$user->id)}}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" onclick="return confirm('Are you sure want to approve this?')" class="btn btn-sm btn-success" name="approve" value="1">Approve</button>
                                                                </form>
                                                                <form id="reject-leave-{{$user->id}}" action="{{route('employeenomini-admin-approve',$user->id)}}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" onclick="return confirm('Are you sure want to reject this?')" class="btn btn-sm btn-danger" name="approve" value="2">Reject</button>
                                                                </form>
                                                            @elseif($user->is_approved==1)

                                                                <form action="{{route('employeenomini-admin-approve',$user->id)}}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to reject this?')" type="submit" name="approve" value="2">Reject</button>
                                                                </form>
                                                            @else
                                                                <form action="{{route('employeenomini-admin-approve',$user->id)}}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-success" onclick="return confirm('Are you sure want to approve this?')" type="submit" name="approve" value="1">Approve</button>
                                                                </form>
                                                            @endif

                                                                @else
                                                               
                                                                @if($user->is_approved==0)
                                                                    <span class="badge badge-pill badge-warning">Pending</span>
                                                                @elseif($user->is_approved==1)
                                                                    <span class="badge badge-pill badge-success">Approved</span>
                                                                @else
                                                                    <span class="badge badge-pill badge-danger">Rejected</span>
                                                                @endif
                                                            @endif
                                                </td>

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
    <style>
th,th p {text-align: center !important;}
</style>
