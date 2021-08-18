@extends('adminlte::page')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    
    'Remuneration' => '#',
    
 
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
<div class="card-header">{{ __('Employee Id') }} - {{ $remuneration->emp_code }}</div>
<div class="card-body">
<form action="#" method="POST">
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

<table class="table table-bordered table-responsive" id="dynamicAddRemove">  
<tr>
  <th>Committed Amount<p>(प्रतिबद्ध राशि)</p></th>
   <th>Ctc Per Month<p>(सीटीसी प्रति माह)</p></th>
    <th> ESI No.<p>(ईएसआई नंबर)</p></th>
    <th>PF UAN No.<p>(पीएफ यूएएन नंबर)</p></th>
    <th>PF No.<p>(पीएफ नंबर)</p></th>
    <th>CTC Per Annum<p>(सीटीसी प्रति वर्ष)</p></th>
    <th>Pay Roll Organization<p>(वेतन रोल संगठन)</p></th>
    <th>Pf Effective Date<p>(पीएफ प्रभावी तारीख)</p></th>
</tr>
<tr>  


<td><input type="text" name="moreFields[0][committed_amount]" value="{{ $remuneration->committed_amount }}" class="form-control" readonly /> </td>
<td><input type="text" name="moreFields[0][ctc_per_month]" value="{{ $remuneration->ctc_per_month }}" class="form-control"  readonly/></td> 

<td><input type="text" name="moreFields[0][esi_number]" value="{{ $remuneration->esi_number }}" class="form-control" readonly /></td>  
<td><input type="text" name="moreFields[0][pf_uan_no]" value="{{ $remuneration->pf_uan_no }}" class="form-control" readonly/></td> 
 
 <td><input type="text" name="moreFields[0][pf_no]" value="{{ $remuneration->pf_no }}" class="form-control" readonly /></td> 

<td><input type="text" name="moreFields[0][ctc_per_annum]" value="{{ $remuneration->ctc_per_annum }}"class="form-control" readonly/></td>  
<td><input type="text" name="moreFields[0][payroll_org]" value="{{ $remuneration->payroll_org }}"  class="form-control" readonly/></td> 
<td><input type="text" name="moreFields[0][pf_effective_date]" value="{{ $remuneration->pf_effective_date }}" class="form-control" readonly/></td> 

 

  
<!-- <td><button type="button" name="add" id="add-btn" class="btn btn-success">Add More</button></td>   -->
</tr>  
</table> 

</form>
</div>
</div>
</div>

@include('footerimport')
@endsection