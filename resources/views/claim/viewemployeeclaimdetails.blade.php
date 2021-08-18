@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Claim' => route('view-employeeclaim'),
    
    'Claim Details' => '#',

]])

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <script>
      function printDiv() 
      {
      
        var divToPrint=document.getElementById('DivIdToPrint');
      
        var newWin=window.open('','Print-Window');
      
        newWin.document.open();
      
        newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
      
        newWin.document.close();
      
        setTimeout(function(){newWin.close();},10);
      
      }
    </script>

    <div class="page-wrapper">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    @endif
    <h3><input type='button' id='btn' value='Print' onclick='printDiv();'></h3>
    <div id='DivIdToPrint'>       

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Employee Details') }}</div>

                <form method="POST" action="{{ route('update-employeetada', $entitlement->id) }}">
                        @csrf
                            <div class="card-body">
                            

                         <div class="form-group row">
                            <label for="emp_name" class="col-md-3 col-form-label text-md-right size">{{ __('Employee Name/कर्मचारी का नाम') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="emp_name" type="text" class=" form-control " name="emp_name" value="{{ $entitlement->emp_firstname }}" required autocomplete="emp_name" readonly>

                             
                            </div>
                          
                            <label for="emp_dept" class="col-md-3 col-form-label text-md-right size">{{ __('Employee Department/कर्मचारी का विभाग') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="emp_dept" type="text" class="form-control name="emp_dept" value="{{ $entitlement->directorate }}"  required autocomplete="emp_dept" readonly>

                         
                            </div>
                        </div>
                            <div class="form-group row">
                            <label for="cas_no" class="col-md-3 col-form-label text-md-right size">{{ __('CAS No/CAS संख्या') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="cas_no" type="text" class="form-control" name="cas_no" value="{{ $entitlement->emp_code }}" required autocomplete="cas_no" readonly>

                            </div>
                      
                            <label for="phone_no" class="col-md-3 col-form-label text-md-right size">{{ __('Phone No/फोन नंबर') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="phone_no" type="text" class="form-control" name="phone_no" value="{{ $entitlement->emp_mobile }}" required autocomplete="phone_no" readonly>

                         
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_designation" class="col-md-3 col-form-label text-md-right size">{{ __('Employee Designation/कर्मचारी का पदनाम') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="emp_designation" type="text" class="form-control" name="emp_designation" value="{{ $entitlement->name }}" required autocomplete="emp_designation" readonly>

                            </div>
                      
                            <label for="basic_pay" class="col-md-3 col-form-label text-md-right size">{{ __('Bank Account/बैंक खाता नम्बर') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="basic_pay" type="text" class="form-control" name="basic_pay" value="{{ $entitlement->bank_account_no }}" required autocomplete="basic_pay" readonly>

                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="ta_da_advance" class="col-md-3 col-form-label text-md-right size">{{ __(' Bill Type/बिल प्रकार') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="ta_da_advance" type="text" class="ta_da_advance form-control" name="ta_da_advance" value="{{ $entitlement->landline_no }}" required autocomplete="ta_da_advance" readonly>

                              
                            </div>
                          
                            <label for="hall_ordinary_da" class="col-md-3 col-form-label text-md-right size">{{ __('Amount/रकम') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="hall_ordinary_da" type="text" class="form-control" name="hall_ordinary_da" value="{{ $entitlement->landline_amount }}" required autocomplete="hall_ordinary_da" readonly>

                           
                            </div>
                        </div>
                            <div class="form-group row">
                            <label for="travel_by" class="col-md-3 col-form-label text-md-right size">{{ __('Service Tax/सेवा कर') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                             
                              
                             <input id="travel_by" type="text" class="form-control" name="travel_by" value="{{ $entitlement->landline_service_tax }}" required autocomplete="travel_by" readonly>

                                
                            </div>
                      
                            <label for="ta_entitlement_id" class="col-md-3 col-form-label text-md-right size">{{ __('Total Amount/कुल राशि') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                               
                            <input id="ta_entitlement_id" type="text" class="form-control" name="ta_entitlement_id" value="{{ $entitlement->landline_total }}" required autocomplete="ta_entitlement_id" readonly>

                              
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

</form>

</div>

    @include('footerimport')
@endsection
