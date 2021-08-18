@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Company Master' => route('view-company'),

]])
@section('plugins.Datatables', true)
 

		<div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
           <div class="form-group col-md-6">
                <h2>Company</h2>
                
            </div>
            
			<div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-company') }}"><i class="fas fa-plus-square"></i></a>
            </div>
        </div>
            <div class="table-responsive">
			<div class="table-responsive">

            <table id="myTable"  class="table table-bordered  table-striped {{ count($company) > 0 ? 'datatable' : '' }} pointer">
					<thead>
					<tr>
					
                       <th>Organization Name<p>(संगठन का नाम)</p></th>
                       <th>PAN No.<p>(पैन नंबर)</p></th>
					   <th>Registration No<p>(पंजीकरण क्रमांक)</p></th>					   
                        <th>Actions<p>(कार्रवाई)</p></th>

					</tr>
					</thead>

					<tbody>
					@if (count($company) > 0)
						@foreach ($company as $key => $value)
							<tr data-entry-id="{{ $value->id }}" data-order="{{$value->id}}" text-align="center">

							
								<td>{{ $value->c_name }}</td>
                                <td>{{ $value->tax_id }}</td>
								<td>{{ $value->registration_number }}</td>
								
							                   
                                <td> <a href="{{ route('edit-company',[$value->id]) }}" class="btn btn-xs btn-info">
                                       <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i><i class="fas fa-edit"></i></a>  
									   <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal{{$value->id}}"><i class="far fa-trash-alt"></i></button></td>

									<div class="container">
										<div class="modal fade" id="myModal{{$value->id}}" role="dialog">
											<div class="modal-dialog modal-sm">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" style="text-indent: 0;">&times;</button>
														<h4 class="modal-title">Company </h4>
													</div>
													<div class="modal-body">
														<p>Are You Sure this Comapny Does Not have any Employee!</p>
													</div>
													<div class="modal-footer">
													<button type="button" class="btn btn-xs btn-success" data-dismiss="modal">Close</button>
														<a href="{{route('deletecompany',['id'=>$value->id])}}" class="btn btn-xs btn-info"><i class="fa fa-trash fa-lg" aria-hidden="true"></i>
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


