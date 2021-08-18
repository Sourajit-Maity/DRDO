@extends('adminlte::page')

<link rel="stylesheet" href="{{asset('css/app.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@section('content')
<style type="text/css">
    h2{
        text-align: center;
        font-size:22px;
        margin-bottom:50px;
    }
    body{
        background:#f2f2f2;
    }
    .section{
        margin-top:150px;
        padding:50px;
        background:#fff;
    }
</style>    
<body>
    <div class="container">
        <div class="col-md-8 section offset-md-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2>Laravel 8 file Upload example - NiceSnippets.com</h2>
                </div>
                <div class="panel-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('file.upload.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                       
 <div class="form-group row">
                            <label for="designation" class="col-md-4 col-form-label text-md-right">{{ __('Designation') }}</label>

                            <div class="col-md-6">
                             
                            <select  name="designation" id="designation" 
                    class="form-control @error('designation') is-invalid @enderror" 
                    value="{{ old('designation') }}" required autocomplete="designation">
                           <option value="" disabled selected>Select Designation</option>
                            @foreach ($roles as $key => $value)
                               
                                        <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach                                            
                                                     
                             </select>
                                @error('designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="job_role" class="col-md-4 col-form-label text-md-right">{{ __('Job Role') }}</label>

                            <div class="col-md-6">
                               
                            <select  name="job_role" id="job_role" class="form-control @error('job_role') is-invalid @enderror" name="job_role" value="{{ old('job_role') }}" required autocomplete="job_role">
                                 <option>--Select Job Role--</option>
                                                                            
                                                     
                             </select>
                                @error('job_role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('footerimport')
@endsection
<script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="designation"]').on('change',function(){
               var desigID = jQuery(this).val();
               if(desigID)
               {
                  jQuery.ajax({
                     url : 'add-employee/getrole/' +desigID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="job_role"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="job_role"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="job_role"]').empty();
               }
            });
    });
    </script>