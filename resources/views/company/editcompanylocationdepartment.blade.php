@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Company Master' => route('view-company'),
    'Company Location' => route('view-company-location'),
    'View Subunit' => route('view-company-location-subunit'),
    'Edit Subunit' => '#',

]])

<script>
$(document).ready(function(){

    $.getJSON('/assets/countryList.json', function(json) {
        console.log(json);
        var op='<option>Choose</option>';
        for(var i=0;i<json.length;i++){
            op+='<option value="'+json[i].dial_code+'">'+json[i].dial_code+' - '+json[i].name+'</option>';
        }
        $("#country_code").html(op);
    });
   

});
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('EDIT Subunit') }}</div>
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <div class="card-body">
                    <form method="PUT" action="{{ route('update-company-location-subunit', $subunit->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="d_name" class="col-md-4 col-form-label text-md-right size">{{ __('Subunit/सबयूनिट') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="d_name" type="text" class="form-control @error('d_name') is-invalid @enderror" name="d_name" value="{{ $subunit->d_name }}" required autocomplete="d_name" autofocus>

                                @error('d_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="operational_company_location_id" class="col-md-4 col-form-label text-md-right size">{{ __('Location/परिचालन स्थान') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                             
                                
                                @if($subunit->operational_company_location_id != null) 
                                @foreach($editlocation as $editlocations)
                                <input id="operational_company_location_id" type="text" class="form-control"  value="{{$editlocations->company_name}}" required autocomplete="operational_company_location_id" autofocus readonly>
                            <input id="operational_company_location_id" type="hidden" class="form-control @error('operational_company_location_id') is-invalid @enderror" name="operational_company_location_id" value="{{$editlocations->company_id}}" readonly required autocomplete="operational_company_location_id" autofocus>
                           
                                        
                                    @endforeach
                                   
                                @endif
                                
                                                                            
                                                     
                             </select>
                                @error('operational_company_location_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right size">{{ __('Type/प्रकार') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                            <select  name="type" id="type" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ $subunit->type }}" required autocomplete="type">
                            @if($subunit->type != null) 
                                @foreach($edittype as $edittypes)
                                        <option value="{{$edittypes->type_id}}">{{$edittypes->type_id}}</option>
                                    @endforeach
                                    @else  
                                    <option value="" disabled selected>Select Location</option>
                                        
                                @endif
                                                       
                                                       <option value='Department'>Department</option>
                                                        <option value='Projects'>Projects</option> 
                                                        <option value='Others'>Others</option>                                             
                                                     
                                                    </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right size">{{ __('Phone No./फोन नंबर') }}<span style="color:red"> *</span></label>

                            <div class="col-md-2">
                                <select id="country_code" type="text" class="form-control @error('country_code') is-invalid @enderror only-numeric" name="country_code" value="{{ $subunit->country_code }}" >
                                
                                </select>
                            </div>
                            <div class="col-md-2">
                            <input id="area_code" type="text" class="form-control @error('area_code') is-invalid @enderror only-numeric" name="area_code" value="{{ $subunit->area_code }}"   autocomplete="area_code"  autofocus>
                            </div>
                            <div class="col-md-2">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror only-numeric" name="phone" value="{{ $subunit->phone }}" required autocomplete="phone" maxlength="12" autofocus>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                
                        </div>
                        <div class="form-group row">
                            <label for="fax" class="col-md-4 col-form-label text-md-right size">{{ __('Fax/फैक्स') }}</label>

                            <div class="col-md-6">
                                <input id="fax" type="text" class="form-control only-numeric" name="fax" value="{{ $subunit->fax }}" autocomplete="fax" maxlength="10" autofocus>

                            </div>
                        </div>
                     
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Save') }}
                                </button>
                                <input type="button" onclick="history.go(-1);" value="Back" class="btn btn-danger">
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
