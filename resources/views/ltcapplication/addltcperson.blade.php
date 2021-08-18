@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
  
    'View LTC Member' => '#',
    'Add LTC Member' => '#',

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
<script type="text/javascript">
$(document).ready(function(){
  events();
});
function events(){
  $(".emp_id").change(function(){
        var val = $(this).val();
        var that = $(this);
        jQuery.ajax({ 
            url : '/getsalary/' +val,
            type : "GET",
            dataType : "json",
            success:function(data)
            {
                that.parents('tr').find('.ctc_per_month').val(data[0].ctc_per_month);
            }
        });
        
    });

    $(".pay_amt").focusout(function(){
      var ctc = $(".ctc_per_month").val();
      var pay_amt=$(".pay_amt").val();
      var due_amt = parseFloat(ctc) - parseFloat(pay_amt);
      if(pay_amt>ctc){
        $(this).val("");
        $(this).parents('tr').find('.due_amt').val("");
        alert("Payable amount should be less than CTC.");
      }else{
        $(this).parents('tr').find('.due_amt').val(due_amt);
      }
      
      
    });
}
  
</script>

<div class="container">
<div class="card mt-3">
<div class="card-header"></div>
<div class="card-body">


<form  action="{{ route('submit-ltc-member', $ltcapply->id) }}" method="POST" enctype="multipart/form-data">
                  

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

<th>Member Name<p>(सदस्य का नाम)</p></th>
<th>Action<p>(कार्य)</p></th>
</tr>
<tr>


<td>
<select id='person_name' name="moreFields[0][person_name]" class="field-style field-split25 align-left  form-control" >
        <option value="" disable selected>Select Family Member</option>
          @foreach($member as $members)
            <option value="{{$members->id}}">{{$members->member_name}}</option>
          @endforeach 
				</select> 
        <input type="hidden" name="moreFields[0][emp_id]" value="{{ Auth::user()->emp_id }}" class="form-control" readonly/>
        <input type="hidden" name="moreFields[0][ltc_application_id]" value="{{ $ltcapply->id }}" class="form-control" readonly/>

</td> 
   
</tr>  
</table> 
<button type="submit" class="btn btn-success">Save</button>
<a href="{{ route('view-leave-travel-apply') }}" class="btn btn-danger">Back</a>                             </div>

</form>
</div>
</div>
</div>
<script type="text/javascript">
var i = 0;
$("#add-btn").click(function(){
  ++i;
  $("#dynamicAddRemove").append('<tr><td><select id="person_name" name="moreFields['+i+'][person_name]" class="field-style field-split25 align-left  form-control" ><option value="" disable selected>Select Family Member</option>@foreach($member as $members)<option value="{{$members->id}}">{{$members->member_name}}</option>@endforeach</select><input type="hidden" name="moreFields['+i+'][emp_id]" value="{{ Auth::user()->emp_id }}" class="form-control" readonly/><input type="hidden" name="moreFields['+i+'][ltc_application_id]" value="{{ $ltcapply->id }}" class="form-control" readonly/></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr> ');
   events();
});
$(document).on('click', '.remove-tr', function(){  
  $(this).parents('tr').remove();
});  
</script>
@include('footerimport')
@endsection
