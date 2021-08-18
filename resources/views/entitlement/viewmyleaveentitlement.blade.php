@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Leave' => '#',
    'Entitlement' => route('view-leave-entitlement'),
    'View My Leave Entitlement' => route('view-my-leave-entitlement'),

]])
@section('plugins.Datatables', true)
 

		<div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
           <div class="form-group col-md-6">
                <h2>My Leave Entitlement</h2>
                
            </div>
            
			<div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-leave-entitlement') }}"><i class="fas fa-plus-square"></i></a>
            </div>
        </div>
            <div class="table-responsive">
			<div class="table-responsive">

            <table id="myTable"  class="table table-bordered  table-striped {{ count($myleaveentitlement) > 0 ? 'datatable' : '' }} pointer">
					<thead>
					<tr>

                       <th>Entitlement Type<p>(पात्रता प्रकार)</p></th>
                       <th>Valid From<p>(से मान्य)</p></th>
					   <th>Valid To<p>(मान्य के लिए)</p></th>                     
					   <th>Days<p>(दिन)</p></th>
                        <th>Actions<p>(कार्रवाई)</p></th>

					</tr>
					</thead>

					<tbody>
					@if (count($myleaveentitlement) > 0)
						@foreach ($myleaveentitlement as $key => $value)
							<tr data-entry-id="{{ $value->id }}" data-order="{{$value->id}}">

							    
								<td>{{ $value->name }}</td>
								<td>{{ $value->from_date }}</td>
                                <td>{{ $value->to_date }}</td>
								<td>{{ $value->no_of_days }}</td>
                    
                                <td> <a href="{{ route('edit-leave-entitlement',[$value->id]) }}" class="btn btn-xs btn-info">
                                       <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i><i class="fas fa-edit"></i></a>  
									   <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal{{$value->id}}"><i class="far fa-trash-alt"></i></button></td>

									<div class="container">
										<div class="modal fade" id="myModal{{$value->id}}" role="dialog">
											<div class="modal-dialog modal-sm">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" style="text-indent: 0;">&times;</button>
														<h4 class="modal-title">Entitlement </h4>
													</div>
													<div class="modal-body">
														<p>Sure about delete this</p>
													</div>
													<div class="modal-footer">
														<a href="{{route('deleteleaveentitlement',['id'=>$value->id])}}" class="btn btn-xs btn-info"><i class="fa fa-trash fa-lg" aria-hidden="true"></i>
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
  

