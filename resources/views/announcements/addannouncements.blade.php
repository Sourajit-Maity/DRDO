@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Announcements' => route('view-announcements'),
    'Add Announcements' => route('add-announcements'),

]])
<script type="text/javascript">

$(document).ready(function(){

    $('#emp_id').select2();
    $('#company_id').select2();
    $('#location_id').select2();
    $('#designation_id').select2();


    $("#checkbox_company").click(function(){
        if($("#checkbox_company").is(':checked') ){
            $("#company_id > option").prop("selected","selected");
            $("#company_id").trigger("change");
        }else{
            $("#company_id > option").prop("selected","");
            $("#company_id").trigger("change");
        }
    });

    $("#checkbox_location").click(function(){
        if($("#checkbox_location").is(':checked') ){
            $("#location_id > option").prop("selected","selected");
            $("#location_id").trigger("change");
        }else{
            $("#location_id > option").prop("selected","");
            $("#location_id").trigger("change");
        }
    });

    $("#checkbox_designation").click(function(){
        if($("#checkbox_designation").is(':checked') ){
            $("#designation_id > option").prop("selected","selected");
            $("#designation_id").trigger("change");
        }else{
            $("#designation_id > option").prop("selected","");
            $("#designation_id").trigger("change");
        }
    });

    $("#checkbox_emp").click(function(){
        if($("#checkbox_emp").is(':checked') ){
            $("#emp_id > option").prop("selected","selected");
            $("#emp_id").trigger("change");
        }else{
            $("#emp_id > option").prop("selected","");
            $("#emp_id").trigger("change");
        }
    });

    var company_id;
    var location_id;
    var designation_id;

    $('#company_id').on('change',function(){
        company_id = $(this).val();
        
        if(company_id)
        {
            $.ajax({
                url : '/getlocationid/' +company_id,
                type : "GET",
                dataType : "json",
                success:function(data)
                {
                    // data = JSON.stringify(data);
                    console.log(data);
                    $('#location_id').empty();
                    for(var i=0;i<data.length;i++){
                        for(var j=0;j<data[i].length;j++){
                            $('#location_id').append('<option value="'+ data[i][j].id +'">'+ data[i][j].l_name +'</option>');
                        }
                    }


                    // $.each(data, function(key,value){
                    //     $('#location_id').append('<option value="'+ key +'">'+ value +'</option>');
                    // });
                }
            });
        }
        else
        {
            $('#location_id').empty();
        }
    });

    $("#location_id").change(function(){
      
      location_id = $(this).val();
  
      
  });

   $("#designation_id").change(function(){
      
       designation_id = $(this).val();
       var op;
       $("#emp_id").html('');
        
       jQuery.ajax({ 
           url : '/getannouncementuser/'+location_id+'/'+designation_id,
           type : "GET",
           dataType : "json",
           success:function(data)
           {
                  
               for(var i=0;i<data.length;i++){

                for(var j=0;j<data[i].length;j++){          
                        $('#emp_id').append('<option value="'+ data[i][j].id +'">'+ data[i][j].emp_nick_name +' - '+ data[i][j].display_name +' - '+ data[i][j].c_name +'</option>');
                }
               }
           }
       });
       
   });

 
});
    </script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add Announcements') }}</div>
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('announcement') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="company_id" class="col-md-4 col-form-label text-md-right">{{ __('Company/कंपनी') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                             
                                <input type="checkbox" id="checkbox_company" >Select All
                                <select style="width:100% !important" name="company_id[]" id="company_id" class="form-control @error('company_id') is-invalid @enderror employee"   required autocomplete="company_id" multiple="multiple">

                                    @foreach ($company as $companys)
                                        <option value="{{ $companys->id }}">{{ $companys->c_name }}</option>
                                    @endforeach                                 
                                                      
                                </select>
                                @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location_id" class="col-md-4 col-form-label text-md-right">{{ __('Company Location/कंपनी का स्थान') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                            <input type="checkbox" id="checkbox_location" >Select All
                            <select style="width:100% !important" name="location_id[]" id="location_id" class="form-control @error('location_id') is-invalid @enderror employee"   required autocomplete="location_id" multiple="multiple">

                                 
                                                                            
                                                     
                             </select>
                                @error('location_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="designation_id" class="col-md-4 col-form-label text-md-right">{{ __('Designation/पदनाम') }}<span style="color:red"> *</span></label>

                        <div class="col-md-6">
                        <input type="checkbox" id="checkbox_designation" >Select All
                        <select style="width:100% !important" name="designation_id[]" id="designation_id" class="form-control @error('designation_id') is-invalid @enderror employee"   required autocomplete="designation_id" multiple="multiple">

                                 @foreach ($designation as $desig)
                                   <option value="{{$desig->id}}">{{$desig->display_name}}</option>
                                 @endforeach                                            
                                                     
                             </select>
                                @error('designation_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="emp_id" class="col-md-4 col-form-label text-md-right">{{ __('Employee Name/कर्मचारी का नाम') }}<span style="color:red"> *</span></label>

                        <div class="col-md-6">
                        <input type="checkbox" id="checkbox_emp" >Select All
                        <select style="width:100% !important" name="emp_id[]" id="emp_id" class="form-control @error('emp_id') is-invalid @enderror employee"   required autocomplete="emp_id" multiple="multiple">

                                                                               
                                                     
                             </select>
                                @error('emp_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text" class="col-md-4 col-form-label text-md-right">{{ __('Enter Your Announcement/अपनी घोषणा दर्ज करें') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                             
                            <textarea class="form-control @error('text') is-invalid @enderror" type="text" name="text" required></textarea>


                                @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="active_status" class="col-md-4 col-form-label text-md-right">{{ __('Status/स्थिति') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                            <select  name="active_status" id="active_status" class="form-control @error('active_status') is-invalid @enderror" name="active_status"  required autocomplete="active_status">
                            <option value="" disabled selected>Select Status</option>
                                    <option value="0">Deactive</option>
                                    <option value="1">Active</option>
                                                                                                    
                             </select>
                           
                                @error('active_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 
                       

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Submit') }}
                                </button>
                                <a href="{{ route('view-announcements') }}" class="btn btn-danger">Back</a>                             </div>
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
