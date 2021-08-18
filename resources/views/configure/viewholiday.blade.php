@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Leave' => '#',
    'Configure' => '#',
    'Holiday' => route('view-holiday'),

]])
@section('plugins.Datatables', true)
 

		<div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
           <div class="form-group col-md-6">
                <h2>Holiday</h2>
                
            </div>
            
			<div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-holiday') }}"><i class="fas fa-plus-square"></i></a>
            </div>
        </div>
            <div class="table-responsive">
			<div class="table-responsive">

            <table id="myTable"  class="table table-bordered  table-striped {{ count($holiday) > 0 ? 'datatable' : '' }} pointer">
					<thead>
					<tr>
                       <th>Description<p>(विवरण)</p></th>
                       <th>Date<p>(तारीख)</p></th>
                      
					   <th>Recurring<p>(आवर्ती)</p></th>
                        <th>Actions<p>(कार्रवाई)</p></th>

					</tr>
					</thead>

					<tbody>
					@if (count($holiday) > 0)
						@foreach ($holiday as $key => $value)
							<tr data-entry-id="{{ $value->id }}" data-order="{{$value->id}}">

							
								<td>{{ $value->description }}</td>
                                <td>{{ $value->date }}</td>
															
								@if($value->recurring =='0') 
									<td>Full Day</td>
								@else  
									<td>Half Day</td>  
								@endif                    
                                <td> <a href="{{ route('edit-holiday',[$value->id]) }}" class="btn btn-xs btn-info">
                                       <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i><i class="fas fa-edit"></i></a>  
									   <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal{{$value->id}}"><i class="far fa-trash-alt"></i></button></td>

									<div class="container">
										<div class="modal fade" id="myModal{{$value->id}}" role="dialog">
											<div class="modal-dialog modal-sm">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" style="text-indent: 0;">&times;</button>
														<h4 class="modal-title">Holiday </h4>
													</div>
													<div class="modal-body">
														<p>Sure about delete this</p>
													</div>
													<div class="modal-footer">
														<a href="{{route('deleteholiday',['id'=>$value->id])}}" class="btn btn-xs btn-info"><i class="fa fa-trash fa-lg" aria-hidden="true"></i>
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
  

