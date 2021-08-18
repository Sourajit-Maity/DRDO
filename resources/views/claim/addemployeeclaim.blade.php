@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
  
    'View Claim ' => route('view-employeeclaim'),
    'Apply Claim ' => route('add-employeeclaim'),

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
<form action="{{ url('submit-employeeclaim') }}" method="POST">
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
<th> Bill Type<p>(बिल प्रकार)</p></th>
<th>Amount<p>(रकम)</p></th>
<th>Service Tax<p>(सेवा कर)</p></th>
<th>Total Amount<p>(कुल राशि)</p></th>
<th>Phone Number<p>(फोन नंबर)</p></th>
<th>Bank Account Number<p>(बैंक खाता नम्बर)</p></th>

<th>Actions<p>(कार्रवाई)</p></th>
</tr>
<tr> 
<td>
<select name="moreFields[0][landline_no]" class="field-style field-split25 align-left  form-control" >
				<option value="" disable selected>Select Bill Type </option>
       
             <option value="Landline">Landline</option>
             <option value="Mobile">Mobile</option>
             <option value="Internet">Internet</option>
       
				
				</select> 
        </td>  
</td>
<td><input type="text" name="moreFields[0][landline_amount]" placeholder="Enter Bill Amount" class="form-control" />
<input type="hidden" name="moreFields[0][emp_id]" value="{{ Auth::user()->emp_id }}" class="form-control" />
</td>  
<td><input type="text" name="moreFields[0][landline_service_tax]" placeholder="Enter Service Tax" class="form-control" />
<input type="hidden" name="moreFields[0][designation_id]" value="{{ Auth::user()->role }}" class="form-control" />

</td> 
<td><input type="text" name="moreFields[0][landline_total]" placeholder="Enter  Total Amount" class="form-control" />
<input type="hidden" name="moreFields[0][cas_id]" value="{{ $casid }}" class="form-control" />

</td>  
<td><input type="text" name="moreFields[0][telephone_no]" value="{{ $telephone }}" class="form-control" readonly/>
<input type="hidden" name="moreFields[0][directorate]" value="{{ $dept }}" class="form-control" />
</td>
<td><input type="text" name="moreFields[0][bank_account_no]" value="{{ $bank }}" class="form-control" readonly/></td>


 
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
  $("#dynamicAddRemove").append('<tr><td><select name="moreFields['+i+'][landline_no]" class="field-style field-split25 align-left  form-control" ><option value="" disable selected>Select Bill Type </option><option value="Landline">Landline</option><option value="Mobile">Mobile</option><option value="Internet">Internet</option></select></td></td><td><input type="text" name="moreFields['+i+'][landline_amount]" placeholder="Enter Bill Amount" class="form-control" /><input type="hidden" name="moreFields['+i+'][emp_id]" value="{{ Auth::user()->emp_id }}" class="form-control" /></td><td><input type="text" name="moreFields['+i+'][landline_service_tax]" placeholder="Enter Service Tax" class="form-control" /><input type="hidden" name="moreFields['+i+'][designation_id]" value="{{ Auth::user()->role }}" class="form-control" /></td><td><input type="text" name="moreFields['+i+'][landline_total]" placeholder="Enter  Total Amount" class="form-control" /><input type="hidden" name="moreFields['+i+'][cas_id]" value="{{ $casid }}" class="form-control" /></td><td><input type="text" name="moreFields['+i+'][telephone_no]" value="{{ $telephone }}" class="form-control" readonly/></td><input type="hidden" name="moreFields['+i+'][directorate]" value="{{ $dept }}" class="form-control" /><td><input type="text" name="moreFields['+i+'][bank_account_no]" value="{{ $bank }}" class="form-control" readonly/></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');  events();
});
$(document).on('click', '.remove-tr', function(){  
  $(this).parents('tr').remove();
});  
</script>
@include('footerimport')
@endsection
