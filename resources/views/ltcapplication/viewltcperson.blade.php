@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'View LTC Member' => '#',

]])

    <div id="main-wrapper">
    
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">LTC Member Details</h4>
                        <div class="ml-auto text-right">
                        <div class="form-group col-md-6"; align="right">
                        <a class="btn btn-success" href="{{ route('add-ltc-member') }}"><i class="fas fa-plus-square"></i>Member</a>
                        </div>
                            
                        </div>
                    </div>
                </div>
            </div>

           
                <div class="row">
                    
                
                    
            
       
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                               
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Employee Name</th>
                                            <th>Application Id</th>
                                            <th>Member Name</th>
                                            <th>Age</th>
                                            <th>Relationship</th>
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($leaves as $leave)
                                            <tr>
                                                <td>{{$loop -> index+1 }}</td>
                                                <td>{{$leave->emp_nick_name}}</td>
                                                <td>{{$leave->ltc_application_id}}</td>
                                                <td>{{$leave->person_name}}</td>
                                                <td>{{$leave->age}}</td>
                                                <td>{{$leave->relationship}}</td>
                                                
                                                
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                    {{ $leaves->links() }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('footerimport')
 
        </div>
    </div>

@endsection