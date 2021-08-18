@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Company Master' => route('view-company'),
    'Company Location' => route('view-company-location-subunit'),

]])
@section('plugins.Datatables', true)
 

		<div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>Subunit</h2>
                
            </div>
            <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-company-location-subunit') }}"><i class="fas fa-plus-square"></i></a>
            </div>
            
        </div>
            <div class="table-responsive">
			<div class="table-responsive">

            <table id="myTable"  class="table table-bordered  table-striped {{ count($subunit) > 0 ? 'datatable' : '' }} pointer">
					<thead>
					<tr>
                       <th>Department<p>(विभाग)</p></th>
                      
                       <th>Type<p>(प्रकार)</p></th>
                       <th>Phone No<p>(फोन नंबर)</p></th>
                       <th>Fax<p>(फैक्स)</p></th>
                        
                        <th>Actions<p>(कार्रवाई)</p></th>

					</tr>
					</thead>

					<tbody>
					@if (count($subunit) > 0)
						@foreach ($subunit as $key => $value)
							<tr data-entry-id="{{ $value->id }}" data-order="{{$value->id}}">

                                <td>{{ $value->d_name }}</td>

								<td>{{ $value->type }}</td>
                                <td>{{ $value->phone }}</td>
                                <td>{{ $value->fax }}</td>
                              
                                <td> <a href="{{ route('edit-company-location-subunit',[$value->id]) }}" class="btn btn-xs btn-info">
                                       <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i><i class="fas fa-edit"></i></a>
                             <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal{{$value->id}}"><i class="far fa-trash-alt"></i></button></td>

                                <div class="container">
                                    <div class="modal fade" id="myModal{{$value->id}}" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" style="text-indent: 0;">&times;</button>
                                                    <h4 class="modal-title">Subunit </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Sure about delete this</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{route('deletecompany-location-subunit',['id'=>$value->id])}}" class="btn btn-xs btn-info"><i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
  

