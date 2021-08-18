@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
  
    'Employee' => route('view-employee'),
    'Add Education' => '#',

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

<script type="text/javascript">
$(document).ready(function(){
  events();
});

</script>

<div class="container">
<div class="card mt-3">
<div class="card-header"></div>
<div class="card-body">

<form  action="{{ route('submit_employee_education', $educationemp->id) }}" method="POST" enctype="multipart/form-data">

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
                    
                    <th>Degree Type <p>(उपाधि प्रकार)</p></th>
                    <th>Institute Name<p>(संस्थान का नाम)</p></th>
                    <th>Degree Name<p>(उपाधी का नाम)</p></th>
                    <th>Grade<p>(ग्रेड)</p></th>
                    <th>Passing Year<p>(बीतता साल)</p></th>
                    <th>Additional Notes<p>(अतिरिक्त टिप्पणी)</p></th>
                    <th>Actions<p>(कार्रवाई)</p></th>
                    </tr>
                    <tr> 

                    <td>
                     <select name="moreFields[0][emp_education_id]" class="form-control" >
                    <option value="" disabled selected>Degree Type</option>
                            @foreach($azheducation as $educations)
                                        <option value="{{$educations->id}}">{{$educations->name}}</option>
                                    @endforeach 
				             </select>
                    </td>
                    <td><input type="text" name="moreFields[0][ins_name]" placeholder="Enter Institute Name" class="form-control" /></td>  
                    <td><input type="text" name="moreFields[0][degree]" placeholder="Enter Degree" class="form-control"/>
                    <input type="hidden" name="moreFields[0][emp_id]" value="{{ $educationemp->id }}" class="form-control" readonly/>
                    </td>  
                    <td><input type="text" name="moreFields[0][grade]" placeholder="Enter Grade" class="form-control"/></td>
                    <td><input type="text" name="moreFields[0][year]" placeholder="Enter Passing Year" class="form-control only-numeric" maxlength="4"/></td>
                    <td><input type="text" name="moreFields[0][notes]" placeholder="Any Notes" class="form-control"/></td>

                   
                      
                   

                    
                    </tr>  
                    </table> 
                    <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Save') }}
                                </button>
                                <input type="button" onclick="history.go(-1);" value="Back" class="btn btn-danger">
                            </div>
                        </div>
                              
</form>
</div>
</div>
</div>
<script type="text/javascript">
var i = 0;
$("#add-btn").click(function(){
  ++i;
  $("#dynamicAddRemove").append('<tr><td><select name="moreFields['+i+'][emp_education_id]" class="form-control" ><option value="" disabled selected>Degree Type</option>@foreach($azheducation as $educations)<option value="{{$educations->id}}">{{$educations->name}}</option>@endforeach</select></td><td><input type="text" name="moreFields['+i+'][ins_name]" placeholder="Enter Institute Name" class="form-control" /></td><td><input type="text" name="moreFields['+i+'][degree]" placeholder="Enter Degree" class="form-control"/><input type="hidden" name="moreFields['+i+'][emp_id]" value="{{ $educationemp->id }}" class="form-control" readonly/></td><td><input type="text" name="moreFields['+i+'][grade]" placeholder="Enter Grade" class="form-control"/></td><td><input type="text" name="moreFields['+i+'][year]" placeholder="Enter Passing Year" class="form-control only-numeric" maxlength="4"/></td><td><input type="text" name="moreFields['+i+'][notes]" placeholder="Any Notes" class="form-control"/></td></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr> ');
   events();
});
$(document).on('click', '.remove-tr', function(){  
  $(this).parents('tr').remove();
});  
</script>
@include('footerimport')
@endsection
