@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
   
    'My Salary' => route('my-salary'),

]])
@section('plugins.Datatables', true)
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>My Salary</h2>
            </div>
            
            
        </div>
            <div class="table-responsive">
           
        
               
                <table id="myTable" class="table table-bordered table-striped {{ count($salary) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        <th>Employee Name<p>(कर्मचारी का नाम)</p></th>
                        <th>Salary Issuer Name<p>(वेतन जारीकर्ता का नाम)</p></th>
                        <th>Paid Amount<p>(भुगतान राशि)</p></th>
                        <th>Payment Date<p>(भुगतान तारीख)</p></th>
                        <th>Salary For Month<p>(महीने के लिए वेतन)</p></th>
                        <th>Salary Status<p>(वेतन स्थिति)</p></th>
                        <th>Remarks<p>(टिप्पणियों)</p></th>
                        
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($salary) > 0)
                        @foreach ($salary as $user)
                            <tr data-entry-id="{{ $user->id }}">
                                <!-- <td></td> -->
                                <td>{{ $user->emp_nick_name }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->paid_amount }}</td>
                                
                                <td>{!! \Carbon\Carbon::parse($user->payment_date)->format('d M Y') !!}</td>

                                <td>{{ $user->salary_for_month }}</td>
                                @if($user->salary_status =='1') 
								<td>Paid</td>
                          
                                @else  
                               <td>Non Paid</td>  
                               @endif
                                <td>{{ $user->remarks }}</td>
                                

                                
                            
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