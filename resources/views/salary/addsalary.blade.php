@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
  
    'View Salary ' => route('view-all-salary'),
    'Add Salary ' => route('add-salary'),

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
<form action="{{ url('submit_salary') }}" method="POST">
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
<th> Employee Name<p>(कर्मचारी का नाम)</p></th>
<th>Month<p>(महीना)</p></th>
<th>Ctc Per Month<p>(सीटीसी प्रति माह)</p></th>
<th>Bank<p>(बैंक)</p></th>
<th>Paid Amount<p>(भुगतान राशि)</p></th>
<th>Due Amount<p>(देय राशि)</p></th>
<th>Salary Status<p>(वेतन स्थिति)</p></th>
<th>Remarks<p>(टिप्पणियों)</p></th>
<th>Actions<p>(कार्रवाई)</p></th>
</tr>
<tr> 
<td>
<select name="moreFields[0][emp_id]" class="emp_id field-style field-split25 align-left  form-control" >
        <option value="" disable selected>Select Employee</option>
          @foreach($employee as $user)
            <option value="{{$user->id}}">{{$user->emp_nick_name}}</option>
          @endforeach 
				</select> 
</td> 
<td><input type="month" name="moreFields[0][salary_for_month]" placeholder="Enter Month" class="form-control" /></td>  
<td><input type="text" name="moreFields[0][ctc_per_month]" placeholder="Enter Ctc" class="ctc_per_month form-control" readonly/>
<input type="hidden" name="moreFields[0][salary_issuer_id]" value="{{ Auth::user()->id }}" class="form-control" readonly/>
</td>  


<td>
<select name="moreFields[0][payment_bank]" class="payment_bank field-style field-split25 align-left  form-control" >
				<option value="" disable selected>Select Bank </option>
          @foreach($bank as $banks)
             <option value="{{$banks->id}}">{{$banks->bank_name}}</option>
          @endforeach 
				
				</select> 
        </td>  
</td>
<td><input type="text" name="moreFields[0][paid_amount]" placeholder="Enter Pay Amount" class="pay_amt form-control" />
<input type="hidden" name="moreFields[0][payment_date]" value="{!! \Carbon\Carbon::today()!!}" class="form-control" readonly/>
</td>  


<td><input type="text" name="moreFields[0][due]" placeholder="Enter Due Amount" class="due_amt form-control" readonly/></td>  
<td><input type="checkbox" name="moreFields[0][salary_status]" placeholder="Enter Status" class="form-control" /></td> 
<td><input type="text" name="moreFields[0][remarks]" placeholder="Enter Remarks" class="form-control" /></td> 

  
  
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
  $("#dynamicAddRemove").append('<tr><td><select name="moreFields['+i+'][emp_id]" class="emp_id field-style field-split25 align-left  form-control" ><option value="" disable selected>Select Employee</option>@foreach($employee as $user)<option value="{{$user->id}}">{{$user->emp_nick_name}}</option>@endforeach</select></td><td><input type="month" name="moreFields['+i+'][salary_for_month]" placeholder="Enter Month" class="form-control" /></td><td><input type="text" name="moreFields['+i+'][ctc_per_month]" placeholder="Enter Ctc" class="ctc_per_month form-control" readonly/><input type="hidden" name="moreFields['+i+'][salary_issuer_id]" value="{{ Auth::user()->id }}" class="form-control" readonly/></td><td><select name="moreFields['+i+'][payment_bank]" class="payment_bank field-style field-split25 align-left  form-control" ><option value="" disable selected>Select Bank </option>@foreach($bank as $banks)<option value="{{$banks->id}}">{{$banks->bank_name}}</option>@endforeach</select></td></td><td><input type="text" name="moreFields['+i+'][paid_amount]" placeholder="Enter Pay Amount" class="pay_amt form-control" /><input type="hidden" name="moreFields['+i+'][payment_date]" value="{!! \Carbon\Carbon::today()!!}" class="form-control" readonly/></td><td><input type="text" name="moreFields['+i+'][due]" placeholder="Enter Due Amount" class="due_amt form-control" readonly/></td><td><input type="checkbox" name="moreFields['+i+'][salary_status]" placeholder="Enter Status" class="form-control" /></td><td><input type="text" name="moreFields['+i+'][remarks]" placeholder="Enter Remarks" class="form-control" /></td> <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
  events();
});
$(document).on('click', '.remove-tr', function(){  
  $(this).parents('tr').remove();
});  
</script>
@include('footerimport')
@endsection
