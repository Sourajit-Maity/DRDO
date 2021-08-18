@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
   
    'SERVICE DETAILS' => route('view-servicedetails'),

]])
@section('plugins.Datatables', true)
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>SERVICE DETAILS</h2>
            </div>
            <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-servicedetails') }}"><i class="fas fa-plus-square"></i></a>
            </div>
            
        </div>
            <div class="table-responsive">
           
        
               
                <table id="myTable" class="table table-bordered table-striped {{ count($type) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        
                        <th>Employee Name<p>(कर्मचारी का नाम)</p></th>
                        <th>Department<p>(विभाग)</p></th>
                        <th>Period From Date <p>(तारीख से अवधि)</p> </th>
                        <th>Period To Date<p>(तारीख की अवधि)</p></th>
                        <th>Post Held<p>(के पास यह पद है)</p></th>
                        <th>Pay<p>(वेतन)</p></th>
                        <th>Additions Pay<p>(अतिरिक्त भुगतान)</p></th>
                        <th>Details<p>(विवरण)</p></th>
                        <th>Actions<p>(कार्रवाई)</p></th>
                        <th>HR Approval<p>(मानव संसाधन अनुमोदन)</p></th>
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($type) > 0)
                        @foreach ($type as $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <!-- <td></td> -->
                                
                                <td>{{ $user->emp_nick_name }}</td>
                                <td>{{ $user->dept }}</td>
                                <td>{{ $user->period_from }}</td>
                                <td>{{ $user->period_to }}</td>
                                <td>{{ $user->post_held }}</td>
                                <td>{{ $user->pay }}</td>
                                <td>{{ $user->additions_pay }}</td>
                                <td>{{ $user->details }}</td>
  
                             <td><button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal{{$user->id}}"><i class="far fa-trash-alt"></i></button></td>

                                <div class="container">
                                    <div class="modal fade" id="myModal{{$user->id}}" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" style="text-indent: 0;">&times;</button>
                                                    <h4 class="modal-title">Service Details </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Sure about delete this</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{route('delete-servicedetails',['id'=>$user->id])}}" class="btn btn-xs btn-info"><i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </td>
                                <td>
                                                            @if(Auth::user()->role=='2')
                                                          
                                                            @if($user->is_approved==0)
                                                                <form id="approve-leave-{{$user->id}}" action="{{route('servicedetails-hr-approve',$user->id)}}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" onclick="return confirm('Are you sure want to approve this?')" class="btn btn-sm btn-success" name="approve" value="1">Approve</button>
                                                                </form>
                                                                <form id="reject-leave-{{$user->id}}" action="{{route('servicedetails-hr-approve',$user->id)}}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" onclick="return confirm('Are you sure want to reject this?')" class="btn btn-sm btn-danger" name="approve" value="2">Reject</button>
                                                                </form>
                                                            @elseif($user->is_approved==1)

                                                                <form action="{{route('servicedetails-hr-approve',$user->id)}}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to reject this?')" type="submit" name="approve" value="2">Reject</button>
                                                                </form>
                                                            @else
                                                                <form action="{{route('servicedetails-hr-approve',$user->id)}}" method="POST">
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
 

