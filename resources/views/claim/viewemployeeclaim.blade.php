@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Claim ' => route('view-employeeclaim'),

]])
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
@section('plugins.Datatables', true)
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>Claim Details</h2>
            </div>
            <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-employeeclaim') }}"><i class="fas fa-plus-square"></i></a>
            </div>
            
        </div>
            <div class="table-responsive">
           
        
               
                <table id="myTable" class="table table-bordered table-striped {{ count($entitlement) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <th> Employee Name<p>(कर्मचारी का नाम)</p></th> 
                        <th> Bill Type<p>(बिल प्रकार)</p></th> 
                        <th> Amount Rs<p>(रकम)</p></th>
                        
                        <th>Service Tax<p>(सेवा कर)</p></th>
                        <th>Total Amount<p>(कुल राशि)</p></th>
                        <th>Bank Account<p>(बैंक खाता नम्बर)</p></th>
                        <th>Action<p>(कार्य)</p></th>
                        <th>Approval<p>(मानव संसाधन अनुमोदन)</p></th>
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($entitlement) > 0)
                        @foreach ($entitlement as $value)
                            <tr data-entry-id="{{ $value->id }}">
                                <!-- <td></td> -->
                                
                                <td>{{ $value->emp_firstname }}</td>
                                <td>{{ $value->landline_no }}</td>
                                <td>{{ $value->landline_amount }}</td>
                                <td>{{ $value->landline_service_tax }}</td>
                                <td>{{ $value->landline_total }}</td>
                                <td>{{ $value->bank_account_no }}</td>
                               
                              
                                    <td> 
                                    <!-- <a href="{{ route('edit-employeetada',[$value->id]) }}" class="btn btn-xs btn-info">
                                       <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i><i class="fas fa-edit"></i></a> -->
									   <a href="{{ route('view-employeeclaim-details',[$value->id]) }}" class="btn btn-xs btn-success">
                                       <i class="far fa-eye"></i></a>   

									                          
																	</td>
                                  <td>
                      
                      @if(Auth::user()->role=='2')
                         
                          @if($value->approved_by==0)
                              <form id="{{$value->id}}" action="{{route('employeeclaim-dir-approve',$value->id)}}" method="POST">
                                  @csrf
                                  {{--<button type="button" onclick="approveLeave({{$value->id}})" class="btn btn-sm btn-success" name="approve" value="1">Approve</button>--}}
                                  <button type="submit" onclick="return confirm('Are you sure want to approve?')" class="btn btn-sm btn-success" name="paid" value="1">Approve</button>
                              </form>
                              <form id="{{$value->id}}" action="{{route('employeeclaim-dir-approve',$value->id)}}" method="POST">
                                  @csrf
                                  {{--<button type="button" onclick="rejectLeave({{$value->id}})" class="btn btn-sm btn-danger" name="approve" value="2">Reject</button>--}}
                                  <button type="submit" onclick="return confirm('Are you sure want to reject?')" class="btn btn-sm btn-danger" name="paid" value="2">Reject</button>
                              </form>
                          @elseif($value->approved_by==1)

                              <form action="{{route('employeeclaim-dir-approve',$value->id)}}" method="POST">
                                  @csrf
                                  <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to reject?')" type="submit" name="paid" value="2">Reject</button>
                              </form>
                          @else
                              <form action="{{route('employeeclaim-dir-approve',$value->id)}}" method="POST">
                                  @csrf
                                  <button class="btn btn-sm btn-success" onclick="return confirm('Are you sure want to approve ?')" type="submit" name="paid" value="1">Approve</button>
                              </form>
                          @endif

                      @else
                          @if($entitlement->approved_by==0)
                              <span class="badge badge-pill badge-warning">Pending</span>
                          @elseif($entitlement->approved_by==1)
                              <span class="badge badge-pill badge-success">Approve</span>
                          @else
                              <span class="badge badge-pill badge-danger">Reject</span>
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
    <script>

        function reset_status(id){



            $.ajax
            ({
                url: '{{ url('is-active') }}/'+id+"/"+$('#chk_'+id).is(':checked'),
                type: 'GET',
                dataType: 'json',
                success: function(data)
                {

                     alert("updated");
                }
            });


        }
</script>
    @include('footerimport')
    @include('datatable')
    @endsection

    <style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
th,th p {text-align: center !important;}
</style> 
