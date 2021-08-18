@extends('adminlte::page')
@inlude('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
   
    'Nomination Certificate' => route('view-employee-nomini'),
    'ADD Nomination Certificate' => route('add-employee-nomini'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('ADD Nomination Certificate') }}</div>

                <div class="card-body">
                <form method="POST" action="{{ route('update-employee-nomini') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                       
                            <label for="gpf_pran_no" class="col-md-4 col-form-label text-md-right size">{{ __('GPF/PRAN ACCOUNT NO./जीपीएफ/प्रान खाता संख्या') }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                          
                                <input id="gpf_pran_no" type="text" class="form-control @error('gpf_pran_no') is-invalid @enderror" name="gpf_pran_no" placeholder="Enter Gpf No." required autocomplete="gpf_pran_no" autofocus>
                                @error('gpf_pran_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="gpf_pran_doc" class="col-md-4 col-form-label text-md-right size">{{ __('NOMINATION FOR DCR/GRATUITY/FAMILY PENSION/डीसीआर/ग्रेच्युटी/पारिवारिक पेंशन के लिए नामांकन') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                             
                            
                                <input type="file" name="gpf_pran_doc" class="form-control">
                                @error('gpf_pran_doc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dcr_doc" class="col-md-4 col-form-label text-md-right size">{{ __('ORIGINAL NOMINEES/ALTERNATE NOMINEES FOR GPF/PRAN/जीपीएफ/प्राण के लिए मूल नामिती/वैकल्पिक नामिती') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                             
                            
                                <input type="file" name="dcr_doc" class="form-control">
                                @error('dcr_doc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="family_declaration_doc" class="col-md-4 col-form-label text-md-right size">{{ __('FAMILY DECLARATION FORM/परिवार घोषणा फॉर्म') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                             
                            
                                <input type="file" name="family_declaration_doc" class="form-control">
                                @error('family_declaration_doc')
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
                                <a href="{{ route('view-employee-nomini') }}" class="btn btn-danger">Back</a>                             </div>
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
