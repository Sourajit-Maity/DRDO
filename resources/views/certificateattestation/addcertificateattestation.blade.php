@extends('adminlte::page')
@include('layouts.apps')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    
    'CERTIFICATE ATTESTATION' => route('view-certificateattestation'),
    'ADD CERTIFICATE ATTESTATION' => route('add-certificateattestation'),

]])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('ADD CERTIFICATE ATTESTATION') }}</div>
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <div class="card-body">
                <form method="POST" action="{{ route('submit-certificateattestation') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                       
                            <label for="medical_exam_no" class="col-md-4 col-form-label text-md-right">{{ __('Medical Exam No/चिकित्सा परीक्षा क्रमांक') }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                          
                                <input id="medical_exam_no" type="text" class="form-control @error('medical_exam_no') is-invalid @enderror only-numeric" name="medical_exam_no"  required autocomplete="medical_exam_no" autofocus>
                                @error('medical_exam_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                       
                            <label for="medical_exam_date" class="col-md-4 col-form-label text-md-right">{{ __('Medical Exam Date./चिकित्सा परीक्षा तारीख') }}<span style="color:red"> *</span></label>

                            <div class="col-md-8">
                          
                                <input id="medical_exam_date" type="date" class="form-control @error('medical_exam_date') is-invalid @enderror" name="medical_exam_date"  required autocomplete="medical_exam_date" autofocus>
                                @error('medical_exam_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="medical_exam_certificate" class="col-md-4 col-form-label text-md-right">{{ __('Medical Certificate/चिकित्सा परीक्षा प्रमाणपत्र') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                             
                            
                                <input type="file" style="width: 135%;" name="medical_exam_certificate" class="form-control @error('medical_exam_certificate') is-invalid @enderror">
                                @error('medical_exam_certificate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                       
                       <label for="character_no" class="col-md-4 col-form-label text-md-right">{{ __('Character No./चरित्र क्रमांक') }}<span style="color:red"> *</span></label>

                       <div class="col-md-8">
                     
                           <input id="character_no" type="text" class="form-control @error('character_no') is-invalid @enderror only-numeric" name="character_no"  required autocomplete="character_no" autofocus>
                           @error('character_no')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>
                        <div class="form-group row">
                            <label for="character_certificate" class="col-md-4 col-form-label text-md-right">{{ __('Character Certificate/चरित्र प्रमाण पत्र') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                             
                            
                                <input type="file" style="width: 135%;" name="character_certificate" class="form-control @error('character_certificate') is-invalid @enderror">
                                @error('character_certificate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                       
                       <label for="allegiance_no" class="col-md-4 col-form-label text-md-right">{{ __('Allegiance No./निष्ठा क्रमांक') }}<span style="color:red"> *</span></label>

                       <div class="col-md-8">
                     
                           <input id="allegiance_no"  type="text" class="form-control @error('allegiance_no') is-invalid @enderror only-numeric" name="allegiance_no"  required autocomplete="allegiance_no" autofocus>
                           @error('allegiance_no')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>
                        <div class="form-group row">
                            <label for="allegiance_certificate" class="col-md-4 col-form-label text-md-right">{{ __('Allegiance Certificate/निष्ठा प्रमाण पत्र') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                             
                            
                                <input type="file" style="width: 135%;" name="allegiance_certificate" class="form-control @error('allegiance_certificate') is-invalid @enderror">
                                @error('allegiance_certificate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                       
                       <label for="secrecy_no" class="col-md-4 col-form-label text-md-right">{{ __('Secrecy No./गोपनीयता क्रमांक') }}<span style="color:red"> *</span></label>

                       <div class="col-md-8">
                     
                           <input id="secrecy_no" type="text" class="form-control @error('secrecy_no') is-invalid @enderror only-numeric" name="secrecy_no"  required autocomplete="secrecy_no" autofocus>
                           @error('secrecy_no')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>
                   <div class="form-group row">
                            <label for="secrecy_certificate" class="col-md-4 col-form-label text-md-right">{{ __('Secrecy Certificate/गोपनीयता प्रमाणपत्र') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                             
                            
                                <input type="file" style="width: 135%;" name="secrecy_certificate" class="form-control @error('secrecy_certificate') is-invalid @enderror">
                                @error('secrecy_certificate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                   <div class="form-group row">
                       
                       <label for="confirmation_no" class="col-md-4 col-form-label text-md-right">{{ __('Confirmation No./सत्यापन क्रमांक') }}<span style="color:red"> *</span></label>

                       <div class="col-md-8">
                     
                           <input id="confirmation_no" type="text" class="form-control @error('confirmation_no') is-invalid @enderror only-numeric" name="confirmation_no"  required autocomplete="confirmation_no" autofocus>
                           @error('confirmation_no')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>
                   <div class="form-group row">
                       
                       <label for="confirmation_details" class="col-md-4 col-form-label text-md-right">{{ __(' Confirmation Details./पुष्टिकरण विवरण') }}<span style="color:red"> *</span></label>

                       <div class="col-md-8">
                     
                           <input id="confirmation_details" type="text" class="form-control @error('confirmation_details') is-invalid @enderror" name="confirmation_details"  required autocomplete="confirmation_details" autofocus>
                           @error('confirmation_details')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>
                        <div class="form-group row">
                            <label for="confirmation_certificate" class="col-md-4 col-form-label text-md-right">{{ __(' Confirmation Certificate/पुष्टिकरण प्रमाणपत्र') }}<span style="color:red"> *</span></label>

                            <div class="col-md-6">
                             
                            
                                <input type="file" style="width: 135%;" name="confirmation_certificate" class="form-control @error('confirmation_certificate') is-invalid @enderror">
                                @error('confirmation_certificate')
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
                                <a href="{{ route('view-certificateattestation') }}" class="btn btn-danger">Back</a>                             </div>
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
