@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
  
    'Employee' => route('view-employee'),
    'Add Family Member' => '#',

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

<form  action="{{ route('submit-employee-family-info', $family->id) }}" method="POST" enctype="multipart/form-data">

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
                    
                    <th>Member Name <p>(सदस्य का नाम)</p></th>
                    <th>DOB<p>(जन्म तारीख)</p></th>
                    <th>Contact No<p>(संपर्क नंबर)</p></th>
                    <th>Relationship<p>(रिश्ता)</p></th>
                    <th>Maritial Status<p>(वैवाहिक स्थिति)</p></th>
                    <th>Aadhar No<p>(आधार नंबर)</p></th>
                    <th>Actions<p>(कार्रवाई)</p></th>
                    </tr>
                    <tr> 

                    <td><input type="text" name="moreFields[0][member_name]" placeholder="Enter Name" class="form-control" /></td>  

                    <td><input type="date" name="moreFields[0][dob]" placeholder="Enter DOB" class="form-control" /></td>  
                    <td><input type="text" name="moreFields[0][contact_no]" placeholder="Enter Contact Number" class="form-control only-numeric" maxlength="12"/>
                    <input type="hidden" name="moreFields[0][emp_id]" value="{{ $family->id }}" class="form-control" readonly/>
                    </td>  
                    
                    <td>
                    </select> <select name="moreFields[0][relation]" class="form-control" >
                            <option value="" disable selected>Select Relation </option>
                            <option value='Father'>Father</option>
                            <option value='Mother'>Mother</option> 
                            <option value='Spouse'>Spouse</option>
                            <option value='Son'>Son</option>
                            <option value='Daughter'>Daughter</option> 
				   </select>
                    </td>  
                    <td>
                    </select> <select name="moreFields[0][maritial_status]" class="form-control" >
                            <option value="" disable selected>Select Maritial Status </option>
                            <option value='Married'>Married</option>
                            <option value='Unmarried'>Unmarried</option> 
                            <option value='Divorcee'>Divorcee</option>
                     
				   </select>
                    </td> 
                   
                    <td><input type="text" name="moreFields[0][addhar_no]" placeholder="Enter Aadhar No" class="form-control only-numeric" maxlength="12"/></td>  
                   

                    
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
  $("#dynamicAddRemove").append(' <tr><td><input type="text" name="moreFields['+i+'][member_name]" placeholder="Enter Name" class="form-control" /></td><td><input type="date" name="moreFields['+i+'][dob]" placeholder="Enter DOB" class="form-control" /></td><td><input type="text" name="moreFields['+i+'][contact_no]" placeholder="Enter Contact Number" class="form-control"/><input type="hidden" name="moreFields['+i+'][emp_id]" value="{{ $family->id }}" class="form-control" readonly/></td><td></select> <select name="moreFields['+i+'][relation]" class="form-control" ><option value="" disable selected>Select Relation </option><option value="Father">Father</option><option value="Mother">Mother</option><option value="Spouse">Spouse</option><option value="Son">Son</option><option value="Daughter">Daughter</option></select></td><td></select> <select name="moreFields['+i+'][maritial_status]" class="form-control"><option value="" disable selected>Select Maritial Status </option><option value="Married">Married</option><option value="Unmarried">Unmarried</option><option value="Divorcee">Divorcee</option></select></td><td><input type="text" name="moreFields['+i+'][addhar_no]" placeholder="Enter Aadhar No" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr> ');
  events();
});
$(document).on('click', '.remove-tr', function(){  
  $(this).parents('tr').remove();
});  
</script>
@include('footerimport')
@endsection
