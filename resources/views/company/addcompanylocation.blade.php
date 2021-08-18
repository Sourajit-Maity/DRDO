@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Company Master' => route('view-company'),
    'Company Location' => route('view-company-location'),
    'Add Location' => route('add-company-location'),

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
    $("#state").change(function(){
        var val = $(this).val();
        $("#district").html('');
        var op='<option>Choose</option>';
        $("#district").append(op);
        jQuery.ajax({ 
            url : '/getdistrict/' +val,
            type : "GET",
            dataType : "json",
            success:function(data)
            {
                
                for(var i=0;i<data.length;i++){
                    op='<option value="'+data[i].id+'">'+data[i].district_name+'</option>';
                    $("#district").append(op);
                }
            }
        });
        
    });

});
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Add Location') }}</div>
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <div class="card-body">
                    <form method="PUT" action="{{ route('submit_company_location') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="l_name" class="col-md-4 col-form-label text-md-right">{{ __('Location Name/स्थान का नाम') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="l_name" type="text" class="form-control @error('l_name') is-invalid @enderror" name="l_name" value="{{ old('l_name') }}" required autocomplete="l_name" autofocus>

                                @error('l_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="operational_company_id" class="col-md-4 col-form-label text-md-right">{{ __('Operational Company/परिचालन कंपनी') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                             
                                <select  name="operational_company_id" id="operational_company_id" class="form-control @error('operational_company_id') is-invalid @enderror" name="operational_company_id" value="{{ old('operational_company_id') }}" required autocomplete="operational_company_id">
                                 <option value="" disabled selected>Select Company</option>
                                    @foreach($company as $companys)
                                        <option value="{{$companys->id}}">{{$companys->c_name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('operational_company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State/राज्य') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                             
                                <select  name="state" id="state" class="form-control @error('state') is-invalid @enderror" name="state"  required autocomplete="state">
                                 <option value="" disabled selected>Select State</option>
                                    @foreach($state as $states)
                                        <option value="{{$states->id}}">{{$states->state_name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="district" class="col-md-4 col-form-label text-md-right">{{ __('District/जिला') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                             
                                <select  name="district" id="district" class="form-control @error('district') is-invalid @enderror" name="district"  required autocomplete="district">
                                 <option value="" disabled selected>Select District</option>
                                                                              
                                                     
                             </select>
                                @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
         
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City/नगर') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city " autofocus>

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address/पता') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address " autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="zip_code" class="col-md-4 col-form-label text-md-right">{{ __('Pin Code/पिन कोड') }}</label><span style="color:red"> *</span>

                            <div class="col-md-6">
                                <input id="zip_code" type="text" class="form-control @error('zip_code') is-invalid @enderror only-numeric" name="zip_code"  value="{{ old('zip_code') }}" required autocomplete="zip_code " maxlength="6" autofocus>

                                @error('zip_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number/फ़ोन नंबर') }}<span style="color:red"> *</span></label>

                            <div class="col-md-2">
                                <select id="country_code" type="text" class="form-control @error('country_code') is-invalid @enderror only-numeric" name="country_code" >
                                
                                </select>
                            </div>
                            <div class="col-md-2">
                            <input id="area_code" type="text" class="form-control @error('area_code') is-invalid @enderror only-numeric" name="area_code"   autocomplete="area_code"  autofocus>
                            </div>
                            <div class="col-md-2">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror only-numeric" name="phone"  required autocomplete="phone" maxlength="12" autofocus>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                
                        </div>

                        <div class="form-group row">
                            <label for="fax" class="col-md-4 col-form-label text-md-right">{{ __('Fax/फैक्स') }}</label>

                            <div class="col-md-6">
                                <input id="fax" type="text" class="form-control only-numeric" name="fax" value="{{ old('fax') }}"  autocomplete="fax" maxlength="10" autofocus>

                        </div>
                        </div>
                       
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Submit') }}
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
