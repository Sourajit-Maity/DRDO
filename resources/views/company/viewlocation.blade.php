@extends('adminlte::page')
@include('layouts.apps')
@section('content')

@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
	'Company Master' => route('view-company'),
    'View Company Location' => '#',

]])

@section('plugins.Datatables', true)
 

		<div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>Location</h2>
                
            </div>
            
			<div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-company-location') }}"><i class="fas fa-plus-square"></i></a>
            </div> 
        </div>
            <div class="table-responsive">
			<div class="table-responsive">

            <table id="myTable"  class="table table-bordered  table-striped {{ count($companylocation) > 0 ? 'datatable' : '' }} pointer">
					<thead>
					<tr>
                      
					   <th>Location<p>(स्थान)</p></th>
					   <th>State<p>(राज्य)</p></th>
					   <th>District<p>(जिला)</p></th>
                       <th>City<p>(नगर)</p></th>
					   <th>Address<p>(पता)</p></th>
                       <th>Pin Code<p>(पिन कोड)</p></th>
					   <th>Phone No<p>(फोन नंबर)</p></th>
                        
                        <th>Actions<p>(कार्रवाई)</p></th>

					</tr>
					</thead>

					<tbody>
					@if (count($companylocation) > 0)
						@foreach ($companylocation as $key => $value)
							<tr data-entry-id="{{ $value->id }}" data-order="{{$value->id}}">

							
								<td>{{ $value->l_name }}</td>
								<td>{{ $value->state_name }}</td>
								<td>{{ $value->district_name }}</td>
								<td>{{ $value->city }}</td>
								<td>{{ $value->address }}</td>
								<td>{{ $value->zip_code }}</td>
								<td>{{ $value->phone }}</td>
							                   
                                <td> <a href="{{ route('edit-company-location',[$value->id]) }}" class="btn btn-xs btn-info">
                                       <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i><i class="fas fa-edit"></i></a>  
									   <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal{{$value->id}}"><i class="far fa-trash-alt"></i></button></td>

									<div class="container">
										<div class="modal fade" id="myModal{{$value->id}}" role="dialog">
											<div class="modal-dialog modal-sm">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" style="text-indent: 0;">&times;</button>
														<h4 class="modal-title">Company Location</h4>
													</div>
													<div class="modal-body">
														<p>Sure about delete this</p>
													</div>
													<div class="modal-footer">
														<a href="{{route('deletecompany-location',['id'=>$value->id])}}" class="btn btn-xs btn-info"><i class="fa fa-trash fa-lg" aria-hidden="true"></i>
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
					</tbody>
				</table>
			</div>
		</div>
	</div>
    @include('footerimport')
    @include('datatable')

	@endsection
  

