@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Warning' => '#',
    'Employee Warning' => route('add-warning'),

]])
@section('plugins.Datatables', true)
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6"> 
                <h2>Employee Warning</h2>
            </div>
            <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-warning') }}"><i class="fas fa-plus-square"></i></a>
            </div>
            
        </div>
            <div class="table-responsive">
           
        
               
                <table id="myTable" class="table table-bordered table-striped {{ count($warning) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        
                        
                        <th>Employee Name <p>(कर्मचारी का नाम)</p></th>
                        <th>Warning Given Name <p>(चेतावनी दिया गया नाम)</p></th>
                        <th>Warning Header <p>(चेतावनी हैडर)</p></th>  
                        <th>Reason <p>(कारण)</p></th>
                        <th>Date <p>(तारीख)</p></th>
     
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($warning) > 0)
                        @foreach ($warning as $reports)
                            <tr data-entry-id="{{ $reports->id }}">
                                
                                
                                <td>{{ $reports->warning_emp_name }}</td>
                                <td>{{ $reports->issuer_name }}</td>
                                <td>{{ $reports->warning_header }}</td>
                                <td>{{ $reports->reason }}</td>
                                <td>{!! \Carbon\Carbon::parse($reports->date)->format('d M Y')  !!}</td>
                         
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
  
