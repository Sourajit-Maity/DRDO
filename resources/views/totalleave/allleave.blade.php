@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'All Leaves' => '#',


]])
@section('plugins.Datatables', true)
 

		<div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
           <div class="form-group col-md-6">
                <h2>View All Leave </h2>
                
            </div>
            
			
        </div>
            <div class="table-responsive">
			<div class="table-responsive">

            <table id="myTable"  class="table table-bordered  table-striped {{ count($leaveentitlement) > 0 ? 'datatable' : '' }} pointer">
					<thead>
					<tr>
                         <th>Employee Name</th>
                        <th>Leave type</th>
                        <th>Date from</th>
                        <th>Date to</th>
                        <th>No. of days</th>
                        <th>Total Days</th>
                        <th>Remaining</th>
                        <th>Reason</th>
                       
					</tr>
					</thead>

					<tbody>
					@if (count($leaveentitlement) > 0)
						@foreach ($leaveentitlement as $key => $value)
							<tr data-entry-id="{{ $value->id }}" data-order="{{$value->id}}">

                            <td>{{$value->emp_nick_name}}</td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->date_from}}</td>
                            <td>{{$value->date_to}}</td>
                            <td>{{$value->days}}</td>
                            <td>{{$value->no_of_days}}</td>
                            <td>{{ $value->no_of_days - $value->days }}</td>
                            <td>{{$value->reason}}</td>
                   
                              
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
  

