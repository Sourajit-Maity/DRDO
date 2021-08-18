@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Daily Report' => '#',
   
    'Add Daily Report' => route('add-daily-report'),

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
<form action="{{ url('submit-daily-report') }}" method="POST">
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

<th>CRM</th>
<th>Job Type</th>
<th>Job Category</th>
<th>Words</th>
<th>Job Id</th>
<th>Job Description</th>
<th>Action</th>
</tr>
<tr>  

<td>
<select id='crm_id' name="moreFields[0][crm_id]" class="field-style field-split25 align-left  form-control" >
        <option value="" disable selected>Select CRM</option>
          @foreach($crm as $crms)
            <option value="{{$crms->id}}">{{$crms->crm}}</option>
          @endforeach 
				</select> 
</td> 
<td>
  <select id='job_type_id' name="moreFields[0][job_type_id]" class="field-style field-split25 align-left  form-control" >
     <option value="" disabled selected>Select Job Type</option>
                                    @foreach($jobtype as $jobtypes)
                                        <option value="{{$jobtypes->id}}">{{$jobtypes->job_type}}</option>
                                    @endforeach 
				
	</select> 
        </td>  
<td>
<select id='job_category_id' name="moreFields[0][job_category_id]" class="field-style field-split25 align-left  form-control">
<option value="" disabled selected>Select Job Category</option>
                                                                              
                    @foreach($jobcategory as $jobcategorys)
                     <option value="{{$jobcategorys->id}}">{{$jobcategorys->job_category}}</option>
                  @endforeach  
				
				</select>
</td> 
<td><input type="text" name="moreFields[0][words]" placeholder="Enter words" class="form-control" />
<input type="hidden" name="moreFields[0][report_time]" value="{!! \Carbon\Carbon::now()!!}" class="form-control"/>
</td>  

<td><input type="text" name="moreFields[0][job_id]" placeholder="Enter Job Id" class="form-control" />
<input type="hidden" name="moreFields[0][report_date]" value="{!! \Carbon\Carbon::today()!!}" class="form-control" />
</td>  
<td><input type="text" name="moreFields[0][job_description]" placeholder="Enter Job Description" class="form-control" />
<input type="hidden" name="moreFields[0][emp_id]" value="{{ Auth::user()->emp_id }}" class="form-control" />
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
  $("#dynamicAddRemove").append('<tr><td><select id="crm_id" name="moreFields['+i+'][crm_id]" class="field-style field-split25 align-left form-control"><option value="" disable selected>Select CRM</option>@foreach($crm as $crms)<option value="{{$crms->id}}">{{$crms->crm}}</option>@endforeach</select></td><td><select id="job_type_id" name="moreFields['+i+'][job_type_id]" class="field-style field-split25 align-left form-control"><option value="" disabled selected>Select Job Type</option>@foreach($jobtype as $jobtypes)<option value="{{$jobtypes->id}}">{{$jobtypes->job_type}}</option>@endforeach</select></td><td><select id="job_category_id" name="moreFields['+i+'][job_category_id]" class="field-style field-split25 align-left form-control"><option value="" disabled selected>Select Job Category</option>@foreach($jobcategory as $jobcategorys)<option value="{{$jobcategorys->id}}">{{$jobcategorys->job_category}}</option>@endforeach</select></td><td><input type="text" name="moreFields['+i+'][words]" placeholder="Enter words" class="form-control" /><input type="hidden" name="moreFields['+i+'][report_time]" value="{!! \Carbon\Carbon::now()!!}" class="form-control"/></td><td><input type="text" name="moreFields['+i+'][job_id]" placeholder="Enter Job Id" class="form-control" /><input type="hidden" name="moreFields['+i+'][report_date]" value="{!! \Carbon\Carbon::today()!!}" class="form-control" /></td><td><input type="text" name="moreFields['+i+'][job_description]" placeholder="Enter Job Description" class="form-control" /><input type="hidden" name="moreFields['+i+'][emp_id]" value="{{ Auth::user()->emp_id }}" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
});
  $(document).on('click', '.remove-tr', function(){  
  $(this).parents('tr').remove();
});  
</script>
@include('footerimport')
@endsection
