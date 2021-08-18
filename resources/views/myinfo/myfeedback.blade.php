@extends('adminlte::page')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'My Evaluation' => '#',
    'Feedback' => '#',
    
 
]]) 
<div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    
           
            
        </div>


<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header"></div>
                <div class="card-body">

                <div class="card-body">

                <div class="panel panel-default">
                <div class="panel-body">
                <div class="row">
                <div class="form-group col-md-6">
                <h2>Feedbacks</h2>
                </div>

                
                </div>
                <div class="table-responsive">



                <table id="myTable" class="table table-bordered table-striped {{ count($feedback) > 0 ? 'datatable' : '' }} pointer">
                <thead>
                <tr>
                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                    
                    <th>Feedback Category<p>(प्रतिक्रिया श्रेणी)</p></th>
                    <th>Feedback Type<p>(प्रतिक्रिया प्रकार)</p></th>
                    <th>Feedback Comment<p>(प्रतिक्रिया टिप्पणी)</p> </th>
                    <th>Feedback Given <p>(प्रतिक्रिया दी गई द्वारा )</p></th>
                    

                </tr>
                </thead>

                <tbody>
                @if (count($feedback) > 0)
                    @foreach ($feedback as $feedbacks)
                    
                        <tr data-entry-id="{{ $feedbacks->id }}">
                            <!-- <td></td> -->
                            
                            <td>{{ $feedbacks->feedback }}</td>
                            <td>{{ $feedbacks->feedback_type }}</td>
                            <th>{{ $feedbacks->feedback_comment }}</th>
                            
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
<style>
th,th p {text-align: center !important;}
</style>