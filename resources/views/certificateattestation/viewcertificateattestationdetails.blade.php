@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'CERTIFICATE ATTESTATION' => route('view-certificateattestation'),
    
    'CERTIFICATE ATTESTATION DETAILS' => '#',

]])



            

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Employee Name') }}-{{ $certificate->emp_id }}</div>

                <form method="POST" action="{{ route('update-employeetada', $certificate->id) }}">
                        @csrf
                            <div class="card-body">

                            <div class="form-group row">
                            <label for="medical_exam_no" class="col-md-3 col-form-label text-md-right size">{{ __('Medical Exam No/चिकित्सा परीक्षा क्रमांक') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="medical_exam_no" type="text" class="form-control @error('medical_exam_no') is-invalid @enderror" name="medical_exam_no" value="{{ $certificate->medical_exam_no }}" required autocomplete="medical_exam_no" readonly>

                                @error('medical_exam_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                            <label for="medical_exam_date" class="col-md-3 col-form-label text-md-right size">{{ __('Medical Exam Date/चिकित्सा परीक्षा तारीख') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="medical_exam_date" type="text" class="form-control @error('medical_exam_date') is-invalid @enderror" name="medical_exam_date" value="{{ $certificate->medical_exam_date }}" required autocomplete="medical_exam_date" readonly>

                                @error('medical_exam_date')
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
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <form method="POST" action="{{ route('update-employeetada', $certificate->id) }}">
                        @csrf
                            <div class="card-body">

                            <div class="form-group row">
                            <label for="character_no" class="col-md-3 col-form-label text-md-right size">{{ __('Character No/चरित्र क्रमांक') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="character_no" type="text" class="form-control @error('character_no') is-invalid @enderror" name="character_no" value="{{ $certificate->character_no }}" required autocomplete="character_no" readonly>

                                @error('medical_exam_no')
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

                <form method="POST" action="{{ route('update-employeetada', $certificate->id) }}">
                        @csrf
                            <div class="card-body">

                            <div class="form-group row">
                            <label for="allegiance_no" class="col-md-3 col-form-label text-md-right size">{{ __('Allegiance No/निष्ठा क्रमांक') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="allegiance_no" type="text" class="form-control @error('allegiance_no') is-invalid @enderror" name="allegiance_no" value="{{ $certificate->allegiance_no }}" required autocomplete="allegiance_no" readonly>

                                @error('allegiance_no')
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
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <form method="POST" action="{{ route('update-employeetada', $certificate->id) }}">
                        @csrf
                            <div class="card-body">

                            <div class="form-group row">
                            <label for="secrecy_no" class="col-md-3 col-form-label text-md-right size">{{ __('Secrecy No/गोपनीयता क्रमांक') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="secrecy_no" type="text" class="form-control @error('secrecy_no') is-invalid @enderror" name="secrecy_no" value="{{ $certificate->secrecy_no }}" required autocomplete="secrecy_no" readonly>

                                @error('secrecy_no')
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
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <form method="POST" action="{{ route('update-employeetada', $certificate->id) }}">
                        @csrf
                            <div class="card-body">

                            <div class="form-group row">
                            <label for="confirmation_no" class="col-md-3 col-form-label text-md-right size">{{ __('Confirmation No/सत्यापन क्रमांक') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="confirmation_no" type="text" class="form-control @error('confirmation_no') is-invalid @enderror" name="confirmation_no" value="{{ $certificate->confirmation_no }}" required autocomplete="confirmation_no" readonly>

                                @error('confirmation_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                            <label for="confirmation_details" class="col-md-3 col-form-label text-md-right size">{{ __('Confirmation Details/पुष्टिकरण विवरण') }}<span style="color:red"> *</span></label>

                            <div class="col-md-3">
                                <input id="confirmation_details" type="text" class="form-control @error('confirmation_details') is-invalid @enderror" name="confirmation_details" value="{{ $certificate->confirmation_details }}" required autocomplete="confirmation_details" readonly>

                                @error('confirmation_details')
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
                                           
                                        
                                            <th> HR Approval</th>
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
  
                                            <tr>
                                            <td>
                                                            @if(Auth::user()->role=='2')
                                                          
                                                            @if($certificate->is_approved==0)
                                                                <form id="approve-leave-{{$certificate->id}}" action="{{route('certificateattestation-hr-approve',$certificate->id)}}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" onclick="return confirm('Are you sure want to approve this?')" class="btn btn-sm btn-success" name="approve" value="1">Approve</button>
                                                                </form>
                                                                <form id="reject-leave-{{$certificate->id}}" action="{{route('certificateattestation-hr-approve',$certificate->id)}}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" onclick="return confirm('Are you sure want to reject this?')" class="btn btn-sm btn-danger" name="approve" value="2">Reject</button>
                                                                </form>
                                                            @elseif($certificate->is_approved==1)

                                                                <form action="{{route('certificateattestation-hr-approve',$certificate->id)}}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to reject this?')" type="submit" name="approve" value="2">Reject</button>
                                                                </form>
                                                            @else
                                                                <form action="{{route('certificateattestation-hr-approve',$certificate->id)}}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-success" onclick="return confirm('Are you sure want to approve this?')" type="submit" name="approve" value="1">Approve</button>
                                                                </form>
                                                            @endif

                                                                @else
                                                               
                                                                @if($certificate->is_approved==0)
                                                                    <span class="badge badge-pill badge-warning">Pending</span>
                                                                @elseif($certificate->is_approved==1)
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
   
    @endsection