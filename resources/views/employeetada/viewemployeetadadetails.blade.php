@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'TA-DA' => route('view-employeetada'),
    
    'TA-DA Details' => '#',

]])

<script>
$(document).ready(function(){

    $("#designation_id").change(function(){
        var val = $(this).val();
        $("#emp_id").html('');
        var op='<option>Choose</option>';
        $("#emp_id").append(op);
        jQuery.ajax({ 
            url : '/getemployee/' +val,
            type : "GET",
            dataType : "json",
            success:function(data)
            {
                
                for(var i=0;i<data.length;i++){
                    op='<option value="'+data[i].id+'">'+data[i].emp_nick_name+'</option>';
                    $("#emp_id").append(op);
                }
            }
        });
        
    });
    $("#emp_id").change(function(){
        var val = $(this).val();
        $("#employee_type").html('');
        var op='<option>Choose</option>';
        $("#employee_type").append(op);
        jQuery.ajax({ 
            url : '/getemployeetype/' +val,
            type : "GET",
            dataType : "json",
            success:function(data)
            {
                
                for(var i=0;i<data.length;i++){
                    op='<option value="'+data[i].id+'">'+data[i].emp_type_name+'</option>';
                    $("#employee_type").append(op);
                }
            }
        });
        
    });
    $(".emp_id").change(function(){
        var val = $(this).val();
        var that = $(this);
        jQuery.ajax({ 
            url : '/getemployeejoining/' +val,
            type : "GET",
            dataType : "json",
            success:function(data)
            {
                that.parents('div').find('.date_of_joining').val(data[0].joined_date);
            }
        });
        
    });

});
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
                                <input id="emp_name" type="text" class=" form-control @error('emp_name') is-invalid @enderror" name="emp_name" value="{{ $entitlement->emp_name }}" required autocomplete="emp_name" readonly>

                                @error('emp_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                            <label for="emp_dept" class="col-md-3 col-form-label text-md-right size">{{ __('Employee Department/कर्मचारी का विभाग') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="emp_dept" type="text" class="form-control @error('emp_dept') is-invalid @enderror" name="emp_dept" value="{{ $entitlement->emp_dept }}"  required autocomplete="emp_dept" readonly>

                                @error('emp_dept')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group row">
                            <label for="cas_no" class="col-md-3 col-form-label text-md-right size">{{ __('CAS No/CAS संख्या') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="cas_no" type="text" class="form-control @error('cas_no') is-invalid @enderror" name="cas_no" value="{{ $entitlement->cas_no }}" required autocomplete="cas_no" readonly>

                                @error('cas_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      
                            <label for="phone_no" class="col-md-3 col-form-label text-md-right size">{{ __('Phone No/फोन नंबर') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ $entitlement->phone_no }}" required autocomplete="phone_no" readonly>

                                @error('phone_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emp_designation" class="col-md-3 col-form-label text-md-right size">{{ __('Employee Designation/कर्मचारी का पदनाम') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="emp_designation" type="text" class="form-control @error('emp_designation') is-invalid @enderror" name="emp_designation" value="{{ $entitlement->emp_designation }}" required autocomplete="emp_designation" readonly>

                                @error('emp_designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      
                            <label for="emp_gpf" class="col-md-3 col-form-label text-md-right size">{{ __('Employee GPF No/कर्मचारी का जीपीएफ संख्या') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="emp_gpf" type="text" class="form-control @error('emp_gpf') is-invalid @enderror" name="emp_gpf" value="{{ $entitlement->emp_gpf }}" required autocomplete="emp_gpf" readonly>

                                @error('emp_gpf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="basic_pay" class="col-md-3 col-form-label text-md-right size">{{ __('Basic Pay/मूल वेतन') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="basic_pay" type="text" class="form-control @error('basic_pay') is-invalid @enderror" name="basic_pay" value="{{ $entitlement->basic_pay }}" required autocomplete="basic_pay" readonly>

                                @error('basic_pay')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      
                            <label for="grade_pay" class="col-md-3 col-form-label text-md-right size">{{ __('Grade Pay/ग्रेड पे') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="grade_pay" type="text" class="form-control @error('grade_pay') is-invalid @enderror" name="grade_pay" value="{{ $entitlement->grade_pay }}" required autocomplete="grade_pay" readonly>

                                @error('grade_pay')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="authority_move" class="col-md-3 col-form-label text-md-right size">{{ __('Authority to Move/स्थानांतरित करने का अधिकार') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="authority_move" type="text" class="form-control @error('authority_move') is-invalid @enderror" name="authority_move" value="{{ $entitlement->authority_move }}" required autocomplete="authority_move" readonly>

                                @error('authority_move')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      
                            <label for="temp_move" class="col-md-3 col-form-label text-md-right size">{{ __('Temporary Duty Move to/अस्थायी ड्यूटी यहां ले जाएं') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="temp_move" type="text" class="form-control @error('temp_move') is-invalid @enderror" name="temp_move" value="{{ $entitlement->temp_move }}" required autocomplete="temp_move" readonly>

                                @error('temp_move')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
       

    </div>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Apply TA/DA') }}</div>

                            <div class="card-body">

                         <div class="form-group row">
                            <label for="ta_da_advance" class="col-md-3 col-form-label text-md-right size">{{ __('TA/DA Advance for Rs/रुपये के लिए टीए-डीए अग्रिम') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="ta_da_advance" type="text" class="ta_da_advance form-control @error('ta_da_advance') is-invalid @enderror" name="ta_da_advance" value="{{ $entitlement->ta_da_advance }}" required autocomplete="ta_da_advance" readonly>

                                @error('ta_da_advance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                            <label for="hall_ordinary_da" class="col-md-3 col-form-label text-md-right size">{{ __('Hall/Ordinary DA/हॉल/साधारण डीए') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="hall_ordinary_da" type="text" class="form-control @error('hall_ordinary_da') is-invalid @enderror" name="hall_ordinary_da" value="{{ $entitlement->hall_ordinary_da }}" required autocomplete="hall_ordinary_da" readonly>

                                @error('hall_ordinary_da')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group row">
                            <label for="travel_by" class="col-md-3 col-form-label text-md-right size">{{ __('Travel By/इसके द्वारा यात्रा') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                             
                              
                             <input id="travel_by" type="text" class="form-control @error('travel_by') is-invalid @enderror" name="travel_by" value="{{ $entitlement->crm }}" required autocomplete="travel_by" readonly>

                                @error('travel_by')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      
                            <label for="ta_entitlement_id" class="col-md-3 col-form-label text-md-right size">{{ __('Class of Entitlement/पात्रता की श्रेणी') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                               
                            <input id="ta_entitlement_id" type="text" class="form-control @error('ta_entitlement_id') is-invalid @enderror" name="ta_entitlement_id" value="{{ $entitlement->entitlement_name }}" required autocomplete="ta_entitlement_id" readonly>

                                @error('ta_entitlement_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                    <label for="location_from" class="col-md-3 col-form-label text-md-right size">{{ __('Location from/स्थान से') }}<span style="color:red"> *</span></label>
                                    <div class="col-md-3">
                                        <input type="text" placeholder="location from" name="location_from" class="form-control @error('location_from') is-invalid @enderror" value="{{ $entitlement->location_from }}" readonly>
                                    </div>
                                    <label for="location_to" class="col-md-3 col-form-label text-md-right">{{ __('Location To/के लिए स्थान') }}<span style="color:red"> *</span></label>

                                    <div class="col-md-3">
                                        <input type="text" name="location_to" placeholder="location to" class="form-control @error('location_to') is-invalid @enderror" value="{{ $entitlement->location_to }}" readonly>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="date_from" class="col-md-3 col-form-label text-md-right size">{{ __('Date from/तारीख से') }}<span style="color:red"> *</span></label>
                                    <div class="col-md-3">
                                        <input type="date" min="{{date('Y-m-d')}}" name="date_from" class="form-control @error('date_from') is-invalid @enderror" id="FromDate" value="{{ $entitlement->date_from }}" readonly>
                                    </div>
                                    <label for="date_to" class="col-md-3 col-form-label text-md-right size">{{ __('Date To/की तारीख') }}<span style="color:red"> *</span></label>

                                    <div class="col-md-3">
                                        <input type="date" name="date_to" class="form-control @error('date_to') is-invalid @enderror" id="ToDate" value="{{ $entitlement->date_to }}" readonly>
                                    </div>
                                </div>
                                
                                
                           <div class="form-group row">
                            <label for="days" class="col-md-3 col-form-label text-md-right size">{{ __('Days/दिन') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                            <input type="text" name="days" class="form-control @error('days') is-invalid @enderror only-numeric" id="TotalDays" value="{{ $entitlement->days }}" readonly>
                                @error('days')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <label for="reason" class="col-md-3 col-form-label text-md-right size">{{ __('Reason/कारण') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                            <input type="text" name="reason" class="form-control @error('reason') is-invalid @enderror" id="reason" value="{{ $entitlement->reason }}" readonly>

                                @error('reason')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __(' HOD/DIR') }}</div>

                <div class="card-body">

                <div class="form-group row">
                            <label for="hod_name" class="col-md-3 col-form-label text-md-right size">{{ __('Hod Name/विभागाध्यक्ष') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="hod_name" type="text" class="hod_name form-control @error('hod_name') is-invalid @enderror" name="hod_name" value="{{ $entitlement->hod_name }}" required autocomplete="hod_name" readonly>

                                @error('hod_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                            <label for="hod_department" class="col-md-3 col-form-label text-md-right size">{{ __('Hod Department/विभाग के प्रमुख का पदनाम') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="hod_department" type="text" class="form-control @error('hod_department') is-invalid @enderror" name="hod_department" value="{{ $entitlement->hod_department }}" required autocomplete="hod_department" readonly>

                                @error('hod_department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-md-3">
                                <input id="hod_designation" type="hidden" class="form-control @error('hod_designation') is-invalid @enderror" name="hod_designation" value="{{ $entitlement->hod_designation }}" required autocomplete="hod_designation" readonly>

                                @error('hod_designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          

                            <div class="col-md-3">
                                <input id="dir_name" type="hidden" class="form-control @error('dir_name') is-invalid @enderror" name="dir_name" value="{{ $entitlement->dir_name }}" required autocomplete="dir_name" readonly>
                                <input id="dir_id" type="hidden" class="form-control @error('dir_id') is-invalid @enderror" name="dir_id" value="{{ $entitlement->dir_id }}" required autocomplete="dir_id" readonly>
                                <input id="hod_id" type="hidden" class="form-control @error('hod_id') is-invalid @enderror" name="hod_id" value="{{ $entitlement->hod_id }}" required autocomplete="hod_id" readonly>

                                @error('dir_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                              
                            <a href="{{ route('view-employeetada') }}" class="btn btn-danger">Back</a>                             </div>
                            </div>
                        </div>                   
      
  
</form>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __(' Approval') }}</div>

                <div class="card-body">

                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                           
                                        <th> Director Approval</th>
                                            <th> HOD Approval</th>
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
  
                                            <tr>
                                                
                                                
                                            
                                                <td>
                                                    @if(Auth::user()->role=='1')
                                                       
                                                        @if($entitlement->dir_aproval==0)
                                                            <form id="{{$entitlement->id}}" action="{{route('employeetada-dir-approve',$entitlement->id)}}" method="POST">
                                                                @csrf
                                                                {{--<button type="button" onclick="approveLeave({{$entitlement->id}})" class="btn btn-sm btn-success" name="approve" value="1">Approve</button>--}}
                                                                <button type="submit" onclick="return confirm('Are you sure want to approve for leave?')" class="btn btn-sm btn-success" name="paid" value="1">Approve</button>
                                                            </form>
                                                            <form id="{{$entitlement->id}}" action="{{route('employeetada-dir-approve',$entitlement->id)}}" method="POST">
                                                                @csrf
                                                                {{--<button type="button" onclick="rejectLeave({{$entitlement->id}})" class="btn btn-sm btn-danger" name="approve" value="2">Reject</button>--}}
                                                                <button type="submit" onclick="return confirm('Are you sure want to reject for leave?')" class="btn btn-sm btn-danger" name="paid" value="2">Reject</button>
                                                            </form>
                                                        @elseif($entitlement->dir_aproval==1)

                                                            <form action="{{route('employeetada-dir-approve',$entitlement->id)}}" method="POST">
                                                                @csrf
                                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to reject for leave?')" type="submit" name="paid" value="2">Reject</button>
                                                            </form>
                                                        @else
                                                            <form action="{{route('employeetada-dir-approve',$entitlement->id)}}" method="POST">
                                                                @csrf
                                                                <button class="btn btn-sm btn-success" onclick="return confirm('Are you sure want to approve for leave?')" type="submit" name="paid" value="1">Approve</button>
                                                            </form>
                                                        @endif

                                                    @else
                                                        @if($entitlement->dir_aproval==0)
                                                            <span class="badge badge-pill badge-warning">Pending</span>
                                                        @elseif($entitlement->dir_aproval==1)
                                                            <span class="badge badge-pill badge-success">Approve</span>
                                                        @else
                                                            <span class="badge badge-pill badge-danger">Reject</span>
                                                        @endif
                                                    @endif
                                                </td>

                                                        <td>
                                                            @if(Auth::user()->role=='2')
                                                          
                                                            @if($entitlement->hod_aproval==0)
                                                                <form id="approve-leave-{{$entitlement->id}}" action="{{route('employeetada-admin-approve',$entitlement->id)}}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" onclick="return confirm('Are you sure want to approve leave?')" class="btn btn-sm btn-success" name="approve" value="1">Approve</button>
                                                                </form>
                                                                <form id="reject-leave-{{$entitlement->id}}" action="{{route('employeetada-admin-approve',$entitlement->id)}}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" onclick="return confirm('Are you sure want to reject leave?')" class="btn btn-sm btn-danger" name="approve" value="2">Reject</button>
                                                                </form>
                                                            @elseif($entitlement->hod_aproval==1)

                                                                <form action="{{route('employeetada-admin-approve',$entitlement->id)}}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to reject leave?')" type="submit" name="approve" value="2">Reject</button>
                                                                </form>
                                                            @else
                                                                <form action="{{route('employeetada-admin-approve',$entitlement->id)}}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-success" onclick="return confirm('Are you sure want to approve leave?')" type="submit" name="approve" value="1">Approve</button>
                                                                </form>
                                                            @endif

                                                                @else
                                                                @if($entitlement->hod_aproval==0)
                                                                    <span class="badge badge-pill badge-warning">Pending</span>
                                                                @elseif($entitlement->hod_aproval==1)
                                                                    <span class="badge badge-pill badge-success">Approved</span>
                                                                @else
                                                                    <span class="badge badge-pill badge-danger">Rejected</span>
                                                                @endif
                                                            @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                       
                                    </table>
                                    
                                </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @include('footerimport')
@endsection

@section('js')
    <script>
        $("#ToDate").change(function () {
            var start = new Date($('#FromDate').val());
            var end = new Date($('#ToDate').val());

            var diff = new Date(end - start);
            var days=1;
            days = diff / 1000 / 60 / 60 / 24;

            // $('#TotalDays').val(days);
            if (days == NaN) {
                $('#TotalDays').val(0);
            } else {
                $('#TotalDays').val(days+1);
            }
        })

        $("#FromDate").change(function () {
            var start = new Date($('#FromDate').val());
            var end = new Date($('#ToDate').val());

            var diff = new Date(end - start);
            var days=1;
            days = diff / 1000 / 60 / 60 / 24;

            // $('#TotalDays').val(days);
            if (days == NaN) {
                $('#TotalDays').val(0);
            } else {
                $('#TotalDays').val(days+1);
            }
        })
    </script>
    @endsection