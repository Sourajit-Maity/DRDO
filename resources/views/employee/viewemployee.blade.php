@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
   
    'Employee' => route('view-employee'),

]])
@section('plugins.Datatables', true)
         

		<div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
           <div class="form-group col-md-6">
                <h2>Employee Details</h2>
                
            </div>
            
			
        </div>
            <div class="table-responsive">
			<div class="table-responsive">

            <table id="myTable"  class="table table-bordered  table-striped {{ count($employee) > 0 ? 'datatable' : '' }} pointer">
					<thead>
					<tr>
					   <th>Image<p>(कर्मचारी का छवि)</p></th>
                       <th>First Name<p>(कर्मचारी का पहला नाम)</p></th>
					   <th>Last Name<p>(कर्मचारी का अंतिम नाम)</p></th>
					   <th>Display Name<p>(कर्मचारी का प्रदर्शित होने वाला नाम)</p></th>
					   <th>Organization<p>(संगठन)</p></th>
                       <th>Address<p>(कर्मचारी का पता)</p></th>
					   <th>Email<p>(कर्मचारी का ईमेल)</p></th>                     
	
                        <th>Actions<p>(कार्रवाई)</p></th>

					</tr>
					</thead>

					<tbody>
					@if (count($employee) > 0)
						@foreach ($employee as $key => $value)
							<tr data-entry-id="{{ $value->id }}" data-order="{{$value->id}}">
							@if($value->emp_img =='0') 
							<td><img src="assets/images/dummy.png" width="100" class="img-circle img-left"></td>
								@else  
								<td><img src="{{url('assets/images')}}/{{$value->emp_img}}" width="100" class="img-circle img-left"></td>
								@endif 
							     
								  
							    <td>{{ $value->emp_firstname }} </td>
								<td>{{ $value->emp_lastname }}</td>
								<td>{{ $value->emp_nick_name }}</td>
								<td>{{ $value->c_name }}</td>
								<td>{{ $value->emp_street1 }},{{ $value->emp_street2 }}</td>
								<td>{{ $value->emp_work_email }}</td>
							
														                  
                                <td> <a href="{{ route('edit-employeetab',[$value->id]) }}" class="btn btn-xs btn-info">
                                       <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i><i class="fas fa-edit"></i></a>
								  
									   <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal{{$value->id}}"><i class="far fa-trash-alt"></i></button></td>

									<div class="container">
										<div class="modal fade" id="myModal{{$value->id}}" role="dialog">
											<div class="modal-dialog modal-sm">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" style="text-indent: 0;">&times;</button>
														<h4 class="modal-title">Employee</h4>
													</div>
													<div class="modal-body">
														<p>Sure about delete this</p>
													</div>
													<div class="modal-footer">
													<button type="button" class="btn btn-xs btn-success" data-dismiss="modal">Close</button>

														<a href="{{route('deleteemployee',['id'=>$value->id])}}" class="btn btn-xs btn-info"><i class="fa fa-trash fa-lg" aria-hidden="true"></i>
															Delete</a>
													</div>                           
																	</td>
						             @endforeach

							</tr>
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
