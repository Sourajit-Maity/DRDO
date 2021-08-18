@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'TA-DA' => route('view-employeetada'),

]])
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
@section('plugins.Datatables', true)
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>TA-DA Details</h2>
            </div>
            <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-employeetada') }}"><i class="fas fa-plus-square"></i></a>
            </div>
            
        </div>
            <div class="table-responsive">
           
        
               
                <table id="myTable" class="table table-bordered table-striped {{ count($entitlement) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <th> Employee Name<p>(कर्मचारी का नाम)</p></th>
                        <th> TA-DA Advance Rs<p>(रुपये के लिए टीए-डीए अग्रिम')</p></th>
                        
                        <th>Travel By<p>(इसके द्वारा यात्रा)</p></th>
                        <th>Location<p>(स्थान)</p></th>
                        <th>Date<p>(तारीख)</p></th>
                        <th>Days<p>(दिन)</p></th>
                        <th>Action<p>(कार्य)</p></th>
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($entitlement) > 0)
                        @foreach ($entitlement as $value)
                            <tr data-entry-id="{{ $value->id }}">
                                <!-- <td></td> -->
                                
                                <td>{{ $value->emp_name }}</td>
                                <td>{{ $value->ta_da_advance }}</td>
                                <td>{{ $value->crm }}</td>
                                <td>{{ $value->location_from }}-{{ $value->location_to }}</td>
                                <td>{{ $value->date_from }}-{{ $value->date_to }}</td>
                                <td>{{ $value->days }}</td>
                               
                              
                                    <td> 
                                    <!-- <a href="{{ route('edit-employeetada',[$value->id]) }}" class="btn btn-xs btn-info">
                                       <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i><i class="fas fa-edit"></i></a> -->
									   <a href="{{ route('view-employeetada-details',[$value->id]) }}" class="btn btn-xs btn-success">
                                       <i class="far fa-eye"></i></a>   
									   <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal{{$value->id}}"><i class="far fa-trash-alt"></i></button></td>

									<div class="container">
										<div class="modal fade" id="myModal{{$value->id}}" role="dialog">
											<div class="modal-dialog modal-sm">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" style="text-indent: 0;">&times;</button>
														<h4 class="modal-title">TA/DA</h4>
													</div>
													<div class="modal-body">
														<p>Sure about delete this</p>
													</div>
													<div class="modal-footer">
													<button type="button" class="btn btn-xs btn-success" data-dismiss="modal">Close</button>

														<a href="{{route('delete-employeetada',['id'=>$value->id])}}" class="btn btn-xs btn-info"><i class="fa fa-trash fa-lg" aria-hidden="true"></i>
															Delete</a>
													</div>                           
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
