@extends('adminlte::page')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'My Evaluation' => '#',
    'Attendance' => '#',
    
 
]]) 
<div class="panel panel-default">
        <div class="panel-body">
       

        <div id="app">
                @include('layouts.flash-message')


                @yield('content')
            </div>
<div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
            <div class="card-header"></div>
                <div class="card-body">

                <div class="card-body">

                <div class="panel panel-default">
                <div class="panel-body">
                <div class="row">
                <div class="form-group col-md-6">
                <h2>Attendance</h2>
                </div>

            
                </div>
                <div class="table-responsive">



                <table id="myTable" class="table table-bordered table-striped {{ count($attandance) > 0 ? 'datatable' : '' }} pointer">
                <thead>
                <tr>
                    <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                    
                    <th>Employee Id<p>(कर्मचारी का आयडी)</p></th>
                    <th>Date<p>(तारीख)</p></th>
                    <th>In Time<p>(समय)</p></th>
                    <th>Actual Out Time <p>(वास्तविक आउट टाइम)</p></th>
                    <th>Shift<p>(खिसक जाना)</p></th>
                    <th>Total Duration<p>(कुल अवधि)</p></th>
                    <th>Status<p>(स्थिति)</p></th>
                   
                </tr>
                </thead>

                <tbody>
                @if (count($attandance) > 0)
                    @foreach ($attandance as $feedbacks)
                    
                        <tr data-entry-id="{{ $feedbacks->id }}">
                            <!-- <td></td> -->
                            
                            <td>{{ $feedbacks->emp_code }}</td>
                            <td>{!! \Carbon\Carbon::parse($feedbacks->date)->format('d M Y') !!}</td>
                            <td>{{ $feedbacks->in_time }}</td>
                            @if($feedbacks->deleted_at == null) 
                            <td>{{ $feedbacks->out_time }}</td>
                            @else 
                            <td>{{ $feedbacks->deleted_at }}</td>
                            @endif
                            <td>{{ $feedbacks->shift_name }}</td>
                            <td>{!! \Carbon\Carbon::parse($feedbacks->created_at)->diffInHours($feedbacks->deleted_at) !!} hours</td>
           
                            <td>{{ $feedbacks->status }}</td>
                           
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