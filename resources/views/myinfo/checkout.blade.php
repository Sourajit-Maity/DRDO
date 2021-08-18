@extends('adminlte::page')
@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'My Evaluation' => '#',
    'Daily Attendance' => '#',
    
 
]]) 
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
                <h2>Daily Attendance</h2>
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
                    
                    <th>Shift<p>(खिसक जाना)</p></th>
                    <th>Total Duration<p>(कुल अवधि)</p></th>
                    <th>Status<p>(स्थिति)</p></th>
                    <th>Check Out<p>(चेक आउट)</p></th>
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
                            
                            <td>{{ $feedbacks->shift_name }}</td>
                           
                            <td>{!! \Carbon\Carbon::parse($feedbacks->created_at)->diffInHours(\Carbon\Carbon::now()) !!} hours</td>
                            <td>{{ $feedbacks->status }}</td>
                            <td> 
                                <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal{{$feedbacks->id}}"><i class="fas fa-sign-out-alt"></i></button></td>

                                    <div class="container">
                                        <div class="modal fade" id="myModal{{$feedbacks->id}}" role="dialog">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" style="text-indent: 0;">&times;</button>
                                                        <h4 class="modal-title">Check Out </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure to check Out!</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{route('checkoutattandance',['id'=>$feedbacks->id])}}" class="btn btn-xs btn-info"><i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                                            Check Out</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
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
