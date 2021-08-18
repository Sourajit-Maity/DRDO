@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'TA/DA ENTITLEMENT' => route('view-tadaentitlement'),
    'Add TA/DA ENTITLEMENT' => route('add-tadaentitlement'),

]])

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD TA/DA ENTITLEMENT') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('submit-tadaentitlement') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="travel_by" class="col-md-4 col-form-label text-md-right size">{{ __('Travel By/इसके द्वारा यात्रा') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            <select  name="travel_by" id="travel_by" class="form-control @error('travel_by') is-invalid @enderror" name="travel_by"  required autocomplete="travel_by">
                                    <option value="" disabled selected>Select Travel By</option>
                                    
                                    @foreach($travel as $travels)
                                        <option value="{{$travels->id}}">{{$travels->crm}}</option>
                                    @endforeach
                                                                              
                                                     
                             </select>
                                @error('travel_by')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="entitlement_name" class="col-md-4 col-form-label text-md-right size">{{ __('Entitlement Name/पात्रता का नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="entitlement_name" type="text" class="form-control @error('entitlement_name') is-invalid @enderror" name="entitlement_name" value="{{ old('entitlement_name') }}" required autocomplete="entitlement_name" autofocus>

                                @error('entitlement_name')
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
                                <a href="{{ route('view-tadaentitlement') }}" class="btn btn-danger">Back</a>                             </div>
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

<script>
$(document).ready(function(){
    $("#travel_by").change(function(){
        console.log('val');
            var val = $(this).val();
            
            $("#entitlement_name").html('');
            var op='<option>Choose</option>';
            $("#entitlement_name").append(op);
            jQuery.ajax({ 
                url : '/getentitlementname/' +val,
                type : "GET",
                dataType : "json",
                success:function(data)
                {
                    
                    for(var i=0;i<data.length;i++){
                        op='<option value="'+data[i].id+'">'+data[i].entitlement_name+'</option>';
                        $("#entitlement_name").append(op);
                    }
                }
            });
            
        });
});
</script>
