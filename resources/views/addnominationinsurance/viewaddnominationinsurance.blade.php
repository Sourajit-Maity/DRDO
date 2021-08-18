@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
 
    'Nomination' => route('view-addnominationinsurance'),

]])
@section('plugins.Datatables', true)
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>Nomination</h2>
            </div>
           
            <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-addnominationinsurance') }}"><i class="fas fa-plus-square"></i></a>
            </div>
        </div>
            <div class="table-responsive">
           
        
               
                <table id="myTable" class="table table-bordered table-striped {{ count($report) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        
                        
                        <th>Employee Name <p>(कर्मचारी का नाम)</p></th>
                       
                        <th>Member Name<p>(सदस्य का नाम)</p></th>
                        <th>Member Address<p>(सदस्य का पता)</p></th>
                        <th>Relationship<p>(रिश्ता)</p></th>
                        
                        <th>Age<p>(उम्र)</p></th>
                        <th>Amount Share Gratuity<p>(राशि शेयर ग्रेच्युटी)</p></th>
                        
                        <th>Contingencies<p>(आकस्मिक व्यय)</p></th>
                        <th>Name/Address(Other)<p>(नाम/पता (अन्य))</p></th>
                        <th>Amount Share(Other)<p>(राशि शेयर (अन्य))</p></th>
                        <th>Action<p>(कार्रवाई)</p></th>
                        <th>HR Approval<p>(मानव संसाधन अनुमोदन)</p></th>
                       
                        
                       
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($report) > 0)
                        @foreach ($report as $reports)
                            <tr data-entry-id="{{ $reports->id }}">
                                
                                
                                <td>{{ $reports->emp_nick_name }}</td>
                                
                                <td>{{ $reports->member_name }}</td>
                                <td>{{ $reports->member_address }}</td>
                                <td>{{ $reports->relation }}</td>
                                <td>{{ $reports->age }}</td>
                                
                                <td>{{ $reports->amount_share }}</td>
                                <td>{{ $reports->contingencies }}</td>
                                <td>{{ $reports->other_details }}</td>
                                <td>{{ $reports->amount_share_other }}</td>
  
                                <td> <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal{{$reports->id}}"><i class="far fa-trash-alt"></i></button></td>

                                <div class="container">
                                    <div class="modal fade" id="myModal{{$reports->id}}" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" style="text-indent: 0;">&times;</button>
                                                    <h4 class="modal-title">Nomination </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Sure about delete this</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{route('delete-addnominationinsurance',['id'=>$reports->id])}}" class="btn btn-xs btn-info"><i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </td>
                             <td>
                                                            @if(Auth::user()->role=='2')
                                                          
                                                            @if($reports->is_approved==0)
                                                                <form id="approve-leave-{{$reports->id}}" action="{{route('nominationinsurance-hr-approve',$reports->id)}}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" onclick="return confirm('Are you sure want to approve this?')" class="btn btn-sm btn-success" name="approve" value="1">Approve</button>
                                                                </form>
                                                                <form id="reject-leave-{{$reports->id}}" action="{{route('nominationinsurance-hr-approve',$reports->id)}}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" onclick="return confirm('Are you sure want to reject this?')" class="btn btn-sm btn-danger" name="approve" value="2">Reject</button>
                                                                </form>
                                                            @elseif($reports->is_approved==1)

                                                                <form action="{{route('nominationinsurance-hr-approve',$reports->id)}}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to reject this?')" type="submit" name="approve" value="2">Reject</button>
                                                                </form>
                                                            @else
                                                                <form action="{{route('nominationinsurance-hr-approve',$reports->id)}}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-success" onclick="return confirm('Are you sure want to approve this?')" type="submit" name="approve" value="1">Approve</button>
                                                                </form>
                                                            @endif

                                                                @else
                                                               
                                                                @if($reports->is_approved==0)
                                                                    <span class="badge badge-pill badge-warning">Pending</span>
                                                                @elseif($reports->is_approved==1)
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