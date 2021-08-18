@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    
    'SERVICE DETAILS' => route('view-servicedetails'),
    'ADD SERVICE DETAILS' => route('add-servicedetails'),

]])
<script>
$(document).ready(function(){

        $("#ToDate").change(function () {
            var start = new Date($('#FromDate').val());
            var end = new Date($('#ToDate').val());

            var diff = new Date(end - start);
            var days=1;
            days = diff / 1000 / 60 / 60 / 24;
            if(days<0){
              alert("Date To should be grater than Date From");
              $('#ToDate').val('');
              $('#TotalDays').val(0);
              return;
            }

            // $('#TotalDays').val(days);
            if (isNaN(days)) {
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

            if(days<0){
              alert("Date To should be grater than Date From");
              $('#FromDate').val('');
              $('#TotalDays').val(0);
              return;
            }

            // $('#TotalDays').val(days);
            if (isNaN(days)) {
                $('#TotalDays').val(0);
            } else {
                $('#TotalDays').val(days+1);
            }
        })
               
        
    });
    </script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('ADD SERVICE DETAILS') }}</div>
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <div class="card-body">
                <form method="POST" action="{{ route('submit-servicedetails') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                       
                            <label for="dept" class="col-md-4 col-form-label text-md-right">{{ __('Department/विभाग') }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                          
                                <input id="dept" type="text" class="form-control @error('dept') is-invalid @enderror" name="dept"  required autocomplete="dept" autofocus>
                                @error('dept')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                       
                            <label for="period_from" class="col-md-4 col-form-label text-md-right">{{ __('Period From Date/तारीख से अवधि') }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                          
                                <input id="FromDate" type="date" class="form-control @error('period_from') is-invalid @enderror" name="period_from"  required autocomplete="medical_exam_date" autofocus>
                                @error('period_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                     
                        <div class="form-group row">
                       
                       <label for="period_to" class="col-md-4 col-form-label text-md-right">{{ __('Period To Date/तारीख की अवधि') }}<span style="color:red"> *</span></label>

                       <div class="col-md-8">
                     
                           <input id="ToDate" type="date" class="form-control @error('period_to') is-invalid @enderror" name="period_to"  required autocomplete="period_to" autofocus>
                           @error('period_to')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>
                   <div class="form-group row">
                            <label for="days" class="col-md-4 col-form-label text-md-right size">{{ __('Days/दिन') }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                            <input type="text" name="days" class="form-control @error('days') is-invalid @enderror only-numeric" id="TotalDays" placeholder="Number of leave days" readonly>
                                @error('days')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row">
                       
                       <label for="post_held" class="col-md-4 col-form-label text-md-right">{{ __('Post Held/के पास यह पद है') }}<span style="color:red"> *</span></label>

                       <div class="col-md-8">
                     
                           <input id="post_held" type="text" class="form-control @error('post_held') is-invalid @enderror" name="post_held"  required autocomplete="post_held" autofocus>
                           @error('post_held')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>
               
                        <div class="form-group row">
                       
                       <label for="pay" class="col-md-4 col-form-label text-md-right">{{ __('Pay/वेतन') }}<span style="color:red"> *</span></label>

                       <div class="col-md-8">
                     
                           <input id="pay" type="text" class="form-control @error('pay') is-invalid @enderror only-numeric" name="pay"  required autocomplete="pay" autofocus>
                           @error('pay')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>
                  
                   <div class="form-group row">
                       
                       <label for="additions_pay" class="col-md-4 col-form-label text-md-right">{{ __('Additions Pay/अतिरिक्त भुगतान') }}<span style="color:red"> *</span></label>

                       <div class="col-md-8">
                     
                           <input id="additions_pay" type="text" class="form-control @error('additions_pay') is-invalid @enderror only-numeric" name="additions_pay"  required autocomplete="additions_pay" autofocus>
                           @error('additions_pay')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>
                   <div class="form-group row">
                       
                       <label for="details" class="col-md-4 col-form-label text-md-right">{{ __('Details/विवरण') }}<span style="color:red"> *</span></label>

                       <div class="col-md-8">
                     
                           <input id="details" type="text" class="form-control @error('details') is-invalid @enderror" name="details"  required autocomplete="details" autofocus>
                           @error('details')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>
                        <div class="form-group row">
                            <label for="upload_doc" class="col-md-4 col-form-label text-md-right">{{ __('Upload Certificate/प्रमाणपत्र अपलोड करें') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                             
                            
                                <input type="file" name="upload_doc" class="form-control">
                                @error('upload_doc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Save') }}
                                </button>
                                <a href="{{ route('view-servicedetails') }}" class="btn btn-danger">Back</a>                             </div>
                            </div>
                        </div>
                  
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('footerimport')
@endsection

