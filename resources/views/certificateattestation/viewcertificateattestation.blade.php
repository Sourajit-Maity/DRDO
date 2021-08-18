@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
   
    'CERTIFICATE ATTESTATION' => route('view-certificateattestation'),

]])
@section('plugins.Datatables', true)
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>CERTIFICATE ATTESTATION</h2>
            </div>
            <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-certificateattestation') }}"><i class="fas fa-plus-square"></i></a>
            </div>
            
        </div>
            <div class="table-responsive">
           
        
               
                <table id="myTable" class="table table-bordered table-striped {{ count($type) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        
                        <th> Employee Name<p>(कर्मचारी का नाम)</p></th>
                        <th> Medical Exam No<p>(चिकित्सा परीक्षा संख्या)</p></th>
                        <th> Medical Exam Date<p>(चिकित्सा परीक्षा तिथि)</p></th>
                        <th> Character No<p>(चरित्र संख्या)</p></th>
                        <th> Allegiance No<p>(निष्ठा संख्या)</p></th>
                        <th> Secrecy No<p>(गोपनीयता संख्या)</p></th>
                        <th> Confirmation No<p>(पुष्टिकरण क्रमांक)</p></th>
                        <th> Confirmation Details<p>(पुष्टिकरण विवरण)</p></th>
                        <th>Actions<p>(कार्य)</p></th>
                        <th>HR Approval<p>(मानव संसाधन अनुमोदन)</p></th>
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($type) > 0)
                        @foreach ($type as $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <!-- <td></td> -->
                                
                                <td>{{ $user->emp_nick_name }}</td>
                                <td>{{ $user->medical_exam_no }}</td>
                                <td>{{ $user->medical_exam_date }}</td>
                                <td>{{ $user->character_no }}</td>
                                <td>{{ $user->allegiance_no }}</td>
                                <td>{{ $user->secrecy_no }}</td>
                                <td>{{ $user->confirmation_no }}</td>
                                <td>{{ $user->confirmation_details }}</td>
  
                             <td>
                             
                             <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal{{$user->id}}"><i class="far fa-trash-alt"></i></button></td>

                                <div class="container">
                                    <div class="modal fade" id="myModal{{$user->id}}" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" style="text-indent: 0;">&times;</button>
                                                    <h4 class="modal-title">Certificate </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Sure about delete this</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{route('delete-certificateattestation',['id'=>$user->id])}}" class="btn btn-xs btn-info"><i class="fa fa-trash fa-lg" aria-hidden="true"></i>
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
                                                                <form id="approve-leave-{{$user->id}}" action="{{route('certificateattestation-hr-approve',$user->id)}}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" onclick="return confirm('Are you sure want to approve this?')" class="btn btn-sm btn-success" name="approve" value="1">Approve</button>
                                                                </form>
                                                                <form id="reject-leave-{{$user->id}}" action="{{route('certificateattestation-hr-approve',$user->id)}}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" onclick="return confirm('Are you sure want to reject this?')" class="btn btn-sm btn-danger" name="approve" value="2">Reject</button>
                                                                </form>
                                                            @elseif($user->is_approved==1)

                                                                <form action="{{route('certificateattestation-hr-approve',$user->id)}}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to reject this?')" type="submit" name="approve" value="2">Reject</button>
                                                                </form>
                                                            @else
                                                                <form action="{{route('certificateattestation-hr-approve',$user->id)}}" method="POST">
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
  
