@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
  'Nomination' => route('view-addnominationinsurance'),
   
  'Add Nomination' => route('add-addnominationinsurance'),

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
th,th p {text-align: center !important;}
</style>

<div class="container">
<div class="card mt-3">
<div class="card-header"></div>
<div class="card-body">
<form action="{{ url('submit-addnominationinsurance') }}" method="POST">
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
<th>Nomination Type <p>(नामांकन प्रकार)</p></th>
<th>Member Name<p>(सदस्य का नाम)</p></th>
<th>Member Address<p>(सदस्य का पता)</p></th>
<th>Relationship<p>(रिश्ता)</p></th>
                        
<th>Age<p>(उम्र)</p></th>
<th>Amount Share Gratuity<p>(राशि शेयर ग्रेच्युटी)</p></th>
                        
<th>Contingencies<p>(आकस्मिक व्यय)</p></th>
<th>Name/Address(Other)<p>(नाम/पता (अन्य))</p></th>
 <th>Amount Share(Other)<p>(राशि शेयर (अन्य))</p></th>

<th>Action<p>(कार्रवाई)</p></th>
</tr>
<tr>  

<td>
       <select id='nomination_type' name="moreFields[0][nomination_type]" class="field-style field-split25 align-left  form-control" >
           <option value="" disabled selected>Select Nomination Type</option>
           <option value="1">NOMINATION FOR DEATH –CUM-RETIREMENT GRATUITY</option>
           <option value="2">Group Insurance</option>
				</select> 
</td> 
<td>
       <select id='member_name' name="moreFields[0][member_name]" class="field-style field-split25 align-left  form-control" >
           <option value="" disabled selected>Select Member</option>
                 @foreach($employee as $user)
                  <option value="{{$user->id}}">{{$user->member_name}}</option>
                 @endforeach 
				</select> 
</td>
<td><input type="text" name="moreFields[0][member_address]" placeholder="Enter Address" class="form-control" /> 
<input type="hidden" name="moreFields[0][emp_id]" value="{{ Auth::user()->emp_id }}" class="form-control" /></td> 
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

 <td><input type="text" name="moreFields[0][age]" placeholder="Enter Age" maxlength="2" class="form-control only-numeric" /></td> 

<td><input type="text" name="moreFields[0][amount_share]" placeholder="Enter Amount of share to be paid to each" class="form-control only-numeric" /></td>  
<td><input type="text" name="moreFields[0][contingencies]" placeholder="Enter contingencies" class="form-control" /></td> 
<td><input type="text" name="moreFields[0][other_details]" placeholder="Enter  Details" class="form-control" /></td> 
<td><input type="text" name="moreFields[0][amount_share_other]" placeholder="Enter Other Amount Share Details" class="form-control only-numeric" /></td>  

 

  
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
$("#dynamicAddRemove").append('<tr><td><select id="nomination_type" name="moreFields['+i+'][nomination_type]" class="field-style field-split25 align-left  form-control" ><option value="" disabled selected>Select Nomination Type</option><option value="1">NOMINATION FOR DEATH –CUM-RETIREMENT GRATUITY</option><option value="2">Group Insurance</option></select></td><td><select id="member_name" name="moreFields['+i+'][member_name]" class="field-style field-split25 align-left  form-control" ><option value="" disabled selected>Select Member</option>@foreach($employee as $user)<option value="{{$user->id}}">{{$user->member_name}}</option>@endforeach</select></td><td><input type="text" name="moreFields['+i+'][member_address]" placeholder="Enter Address" class="form-control" /><input type="hidden" name="moreFields['+i+'][emp_id]" value="{{ Auth::user()->emp_id }}" class="form-control" /></td><td></select> <select name="moreFields['+i+'][relation]" class="form-control" ><option value="" disable selected>Select Relation </option><option value="Father">Father</option><option value="Mother">Mother</option><option value="Spouse">Spouse</option><option value="Son">Son</option><option value="Daughter">Daughter</option></select></td><td><input type="text" name="moreFields['+i+'][age]" placeholder="Enter Age" class="form-control" /></td><td><input type="text" name="moreFields['+i+'][amount_share]" placeholder="Enter Amount of share to be paid to each" class="form-control" /></td><td><input type="text" name="moreFields['+i+'][contingencies]" placeholder="Enter contingencies" class="form-control" /></td><td><input type="text" name="moreFields['+i+'][other_details]" placeholder="Enter  Details" class="form-control" /></td><td><input type="text" name="moreFields['+i+'][amount_share_other]" placeholder="Enter Other Amount Share Details" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');});
$(document).on('click', '.remove-tr', function(){  
$(this).parents('tr').remove();
});  
</script>
@include('footerimport')
@endsection
