@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Exam score' => '#',
   
    'Add Exam score' => route('add-employeeexamscore'),

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
<form action="{{ url('submit-employeeexamscore') }}" method="POST">
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
<th>Training given Person</th>
<th>Training Date</th>
<th>Training Time</th>
<th>Subject</th>
<th>Topics</th>
<th>Duration From</th>
<th>Duration To</th>
<th>Exam Score</th>

<th>Action</th>
</tr>
<tr>  

<td>
       <select id='training_given_by_id' name="moreFields[0][training_given_by_id]" class="field-style field-split25 align-left  form-control" >
           <option value="" disabled selected>Select Person</option>
                 @foreach($employee as $user)
                  <option value="{{$user->id}}">{{$user->emp_nick_name}}</option>
                 @endforeach 
				</select> 
</td> 
<td><input type="date" name="moreFields[0][exam_score_date]" placeholder="Enter Training Date" class="form-control" />
<input type="hidden" name="moreFields[0][emp_id]" value="{{ Auth::user()->emp_id }}" class="form-control" /></td> 

<td><input type="time" name="moreFields[0][exam_score_time]" placeholder="Enter Training Time" class="form-control" /></td>  

<td>
<select id='subject_id' name="moreFields[0][subject_id]" class="field-style field-split25 align-left  form-control" >
    <option value="" disabled selected>Select Subject</option>
    @foreach($subject as $subjects)
              <option value="{{$subjects->id}}">{{$subjects->subject}}</option>
       @endforeach 
				
	</select> 
        </td>  
 <td><input type="text" name="moreFields[0][topics]" placeholder="Enter Topics" class="form-control" /></td> 

<td><input type="date" name="moreFields[0][duration_from]" placeholder="Enter Duration from date" class="form-control" /></td>  
<td><input type="date" name="moreFields[0][duration_to]" placeholder="Enter duration to date" class="form-control" /></td> 
<td><input type="text" name="moreFields[0][exam_score]" placeholder="Enter Exam Score" class="form-control" /></td> 

 

  
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
$("#dynamicAddRemove").append('<tr><td><select id="training_given_by_id"name="moreFields['+i+'][training_given_by_id]" class="field-style field-split25 align-left  form-control" ><option value="" disabled selected>Select Person</option>@foreach($employee as $user)<option value="{{$user->id}}">{{$user->emp_nick_name}}</option>@endforeach</select></td><td><input type="date" name="moreFields['+i+'][exam_score_date]" placeholder="Enter Training Date" class="form-control"/><input type="hidden" name="moreFields['+i+'][emp_id]" value="{{ Auth::user()->emp_id }}" class="form-control"/></td><td><input type="time" name="moreFields['+i+'][exam_score_time]" placeholder="Enter Training Time" class="form-control"/></td><td><select id="subject_id" name="moreFields['+i+'][subject_id]" class="field-style field-split25 align-left  form-control"><option value="" disabled selected>Select Subject</option>@foreach($subject as $subjects)<option value="{{$subjects->id}}">{{$subjects->subject}}</option>@endforeach</select></td><td><input type="text" name="moreFields['+i+'][topics]" placeholder="Enter Topics" class="form-control"/></td><td><input type="date" name="moreFields['+i+'][duration_from]" placeholder="Enter Duration from date" class="form-control"/></td><td><input type="date" name="moreFields['+i+'][duration_to]" placeholder="Enter duration to date" class="form-control"/></td><td><input type="text" name="moreFields['+i+'][exam_score]" placeholder="Enter Exam Score" class="form-control"/></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');});
$(document).on('click', '.remove-tr', function(){  
$(this).parents('tr').remove();
});  
</script>
@include('footerimport')
@endsection
