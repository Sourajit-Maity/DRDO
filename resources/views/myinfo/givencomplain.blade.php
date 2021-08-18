@extends('adminlte::page')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'My Activity' => '#',
    'Complain' => 'given-complain',
    
 
]]) 
<div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    
           
            
        </div>


<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"></div>
                <div class="card-body">

                <div class="card-body">

                <div class="panel panel-default">
                <div class="panel-body">
                <div class="row">
                <div class="form-group col-md-6">
                <h2>Complain</h2>
                </div>
                <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-complain') }}"><i class="fas fa-plus-square"></i></a>
            </div>
                
                </div>
                <div class="table-responsive">



                <table id="myTable" class="table table-bordered table-striped {{ count($complain) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        
                        
                        <th>Complain Given Name<p>(शिकायत दिया गया नाम)</p></th>
                        <th>Complain To Name<p>(नाम से शिकायत करें)</p></th>
                        <th>Complain<p>(शिकायत)</p></th>
                        <th>Notes<p>(टिप्पणियाँ)</p></th> 
                        
                        <th>Complain Given <p>(शिकायत दी गई)</p></th>
                        
                       
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($complain) > 0)
                    @foreach ($complain as $feedbacks)
                    
                        <tr data-entry-id="{{ $feedbacks->id }}">
                            <!-- <td></td> -->
                            <td>{{ $feedbacks->name }}</td>
                            <td>{{ $feedbacks->emp_nick_name }}</td>
                            <td>{{ $feedbacks->complain }}</td>
                            <td>{{ $feedbacks->notes }}</td>
                            
                            <td>{!! \Carbon\Carbon::parse($feedbacks->created_at)->format('d M Y H:i') !!}</td>
                         

                        </tr>
                    
                        @endforeach
                @else
                        <tr>
                            <td colspan="7">No entries in table</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

                </div>
                </div>

                 </div>
            </div>
        </div>
    </div>
</div>

@include('footerimport')
@endsection
