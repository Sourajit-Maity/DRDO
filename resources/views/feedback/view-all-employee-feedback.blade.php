@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Feedback' => '#',
    

]])
@section('plugins.Datatables', true)
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>All Feedbacks</h2>
            </div>
           
            
        </div>
            <div class="table-responsive">
           
        
               
                <table id="myTable" class="table table-bordered table-striped {{ count($feedback) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        
                        
                    <th>Feedback Given Name<p>(प्रतिक्रिया दी गई द्वारा नाम)</p></th>
                        <th>Feedback To Name <p>(प्रतिक्रिया व्यक्ति नाम)</p></th>
                        <th>Feedback Category<p>(प्रतिक्रिया श्रेणी)</p></th>
                        <th>Feedback Type<p>(प्रतिक्रिया प्रकार)</p></th>
                        <th>Feedback Comment<p>(प्रतिक्रिया टिप्पणी)</p> </th>
                        <th>Feedback Given <p>(प्रतिक्रिया दी गई)</p></th>
                        
                       
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($feedback) > 0)
                    @foreach ($feedback as $feedbacks)
                    
                        <tr data-entry-id="{{ $feedbacks->id }}">
                            <!-- <td></td> -->
                            <td>{{ $feedbacks->name }}</td>
                            <td>{{ $feedbacks->emp_nick_name }}</td>
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
    @include('footerimport')
    @include('datatable')
    @endsection
    <style>
th,th p {text-align: center !important;}
</style>
