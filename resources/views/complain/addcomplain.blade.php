@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Complain' => '#',
   
    'Apply Complain' => route('add-complain'),

]])

<style>
.img_dv{display:none;}
</style>

<script>
$(document).ready(function(){
   

    $("#designation").change(function(){
        $(".img_dv").hide('');
        var val = $(this).val();
        $("#complain_against_id").html('');
        var op='<option>Choose</option>';
        $("#complain_against_id").append(op);
        jQuery.ajax({ 
            url : '/getcomplainuser/' +val,
            type : "GET",
            dataType : "json",
            success:function(data)
            {
                
                for(var i=0;i<data.length;i++){
                    op='<option value="'+data[i].id+'">'+data[i].emp_nick_name+'</option>';
                    $("#complain_against_id").append(op);
                }
            }
        });
        
    });

    $("#complain_against_id").change(function(){
        var val = $(this).val();
        $(".img_dv").hide('');
        jQuery.ajax({ 
            url : '/getcomplainuserimage/' +val,
            type : "GET",
            dataType : "json",
            success:function(data)
            {
                $(".img_dv").show('');
                if(data[0].emp_img!=0){
                    $("#emp_img").attr("src","assets/images/"+data[0].emp_img)
                }
                else{
                    $("#emp_img").attr("src","assets/images/dummy.png")
                }
                
                
            }
        });
        
    });
});
</script>
<div id="app">
        @include('layouts.flash-message')


        @yield('content')
    </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Apply Complain') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('submit_complain') }}">
                        @csrf

                        <div class="form-group row">
                        <label for="designation" class="col-md-4 col-form-label text-md-right">{{ __('Designation/पद') }}<span style="color:red"> *</span></label>

                        <div class="col-md-6">
                                
                                <select  name="designation" id="designation" class="form-control @error('designation') is-invalid @enderror" name="designation"  required autocomplete="designation">
                                <option value="" disabled selected>Select Designation</option>
                                    @foreach($designation as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
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
                        <label for="complain_against_id" class="col-md-4 col-form-label text-md-right">{{ __('Employee Name/कर्मचारी का नाम') }}<span style="color:red"> *</span></label>

                        <div class="col-md-6">
                                
                                <select  name="complain_against_id" id="complain_against_id" class="form-control @error('complain_against_id') is-invalid @enderror" name="complain_against_id"  required autocomplete="complain_against_id">
                                <option value="" disabled selected>Select Person</option>
                                                                               
                                                     
                             </select>
                                @error('complain_against_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row img_dv">
                            <div class="col-md-4 pull-left">&nbsp;</div>

                            <div class="col-md-6 pull-left">
                                    <img id="emp_img" src="" style="width:200px;"/>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="form-group row">
                            <label for="complain" class="col-md-4 col-form-label text-md-right">{{ __('Complain/शिकायत') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                                
                                <textarea id="complain" class="form-control @error('complain') is-invalid @enderror" name="complain"  required autocomplete="complain" rows="4" cols="50"></textarea>
                                
                                
                                @error('complain')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="notes" class="col-md-4 col-form-label text-md-right">{{ __('Notes/टिप्पणियाँ') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                                <input id="notes" type="text" class="form-control @error('notes') is-invalid @enderror" name="notes" value="{{ old('notes') }}" required autocomplete="notes">

                                @error('notes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Send') }}
                                </button>
                                <a href="{{ route('view-complain') }}" class="btn btn-danger">Back</a>                             </div>
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
