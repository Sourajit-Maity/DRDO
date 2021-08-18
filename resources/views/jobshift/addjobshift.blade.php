@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
  
    'View Jobshift ' => route('view-jobshift'),
    'Add Jobshift ' => route('add-jobshift'),

]])

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
th,td{
  min-width:200px !important;
}
</style>

<div class="container">
<div class="card mt-3">
<div class="card-header"></div>
<div class="card-body">
<form action="{{ url('submit_jobshift') }}" method="POST">
@csrf
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
@if (Session::has('success'))
<div class="alert alert-success text-center">
<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
<p>{{ Session::get('success') }}</p>
</div>
@endif
<div class="text-right">
  <button type="button" name="add" id="add-btn" class="btn btn-success">Add More</button>
</div>
<table class="table table-bordered table-responsive" id="dynamicAddRemove">  
<tr>
<th>Serial No</th>
<th>Job Id</th>
<th>CRM</th>
<th>Words</th>
<th>Shifted From</th>
<th>Shifted To</th>
<th>Shifted Date</th>
<th>Delivery Date</th>
<th>Payble</th>
<th>Action</th>
</tr>
<tr>  
<td><input type="text" name="moreFields[0][serial_no]" placeholder="Enter serial no" class="form-control" /></td>  
<td><input type="text" name="moreFields[0][job_id]" placeholder="Enter job id" class="form-control" /></td>  
<td>
<select id='crm_id' name="moreFields[0][crm_id]" class="field-style field-split25 align-left  form-control" >
        <option value="" disable selected>Select CRM</option>
          @foreach($crm as $crms)
            <option value="{{$crms->id}}">{{$crms->crm}}</option>
          @endforeach 
				</select> 
</td> 
<td><input type="text" name="moreFields[0][words]" placeholder="Enter words" class="form-control" /></td>  
<td>
<select id='shifted_from' name="moreFields[0][shifted_from]" class="field-style field-split25 align-left  form-control" >
				<option value="" disable selected>Select Shifted From</option>
          @foreach($employee as $reportings)
             <option value="{{$reportings->id}}">{{$reportings->emp_nick_name}}</option>
          @endforeach 
				
				</select> 
        </td>  
<td>
<select id='shifted_to' name="moreFields[0][shifted_to]" class="field-style field-split25 align-left  form-control">
        <option value="" disable selected>Select Shifted To</option>
          @foreach($employee as $reportings)
            <option value="{{$reportings->id}}">{{$reportings->emp_nick_name}}</option>
          @endforeach 
				
				</select>
</td> 
<td><input type="date" name="moreFields[0][shifted_date]" placeholder="Enter shifted date" class="form-control" /></td>  
<td><input type="date" name="moreFields[0][delivery_date]" placeholder="Enter delivery date" class="form-control" /></td> 

 
<td>
<select id='payable' name="moreFields[0][payable]" class="field-style field-split25 align-left form-control" >
        <option value="" disable selected>Select Payable/Non-payable</option>
					<option value="1">Payable</option>
					<option value="0">Non-payable</option>
				
				</select> 
</td>  
  
<!-- <td><button type="button" name="add" id="add-btn" class="btn btn-success">Add More</button></td>   -->
</tr>  
</table> 
<button type="submit" class="btn btn-success">Save</button>
</form>
</div>
</div>
</div>
<script type="text/javascript">
var i = 0;
$("#add-btn").click(function(){
++i;
$("#dynamicAddRemove").append('<tr><td><input type="text" name="moreFields['+i+'][serial_no]" placeholder="Enter serial no" class="form-control" /></td><td><input type="text" name="moreFields['+i+'][job_id]" placeholder="Enter job id" class="form-control" /></td><td> <select id="crm_id" name="moreFields['+i+'][crm_id]" class="field-style field-split25 align-left form-control"><option value="" disable selected>Select CRM</option> @foreach($crm as $crms)<option value="{{$crms->id}}">{{$crms->crm}}</option> @endforeach </select></td><td><input type="text" name="moreFields['+i+'][words]" placeholder="Enter words" class="form-control" /></td><td> <select id="shifted_from" name="moreFields['+i+'][shifted_from]" class="field-style field-split25 align-left form-control"><option value="" disable selected>Select Shifted From</option> @foreach($employee as $reportings)<option value="{{$reportings->id}}">{{$reportings->emp_nick_name}}</option> @endforeach </select></td><td> <select id="shifted_to" name="moreFields['+i+'][shifted_to]" class="field-style field-split25 align-left form-control"><option value="" disable selected>Select Shifted To</option> @foreach($employee as $reportings)<option value="{{$reportings->id}}">{{$reportings->emp_nick_name}}</option> @endforeach </select></td><td><input type="date" name="moreFields['+i+'][shifted_date]" placeholder="Enter shifted date" class="form-control" /></td><td><input type="date" name="moreFields['+i+'][delivery_date]" placeholder="Enter delivery date" class="form-control" /></td><td> <select id="payable" name="moreFields['+i+'][payable]" class="field-style field-split25 align-left form-control"><option value="" disable selected>Select Payable/Non-payable</option><option value="1">Payable</option><option value="0">Non-payable</option> </select></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
});
$(document).on('click', '.remove-tr', function(){  
$(this).parents('tr').remove();
});  
</script>
@include('footerimport')
@endsection
