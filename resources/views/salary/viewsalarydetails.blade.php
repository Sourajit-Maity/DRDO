@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Salary Details' => route('view-salary-details'),

]])
@section('plugins.Datatables', true)
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>Salary Details</h2>
            </div>
            <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('view-all-salary') }}">View Employee Salary<i class="fas fa-plus-square"></i></a>
            </div>
            
        </div>
            <div class="table-responsive">
           
        
               
                <table id="myTable" class="table table-bordered table-striped {{ count($salarydetails) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        
                        <th> Employee Image<p>(कर्मचारी का छवि)</p></th>
                        <th> Employee Name<p>(कर्मचारी का नाम)</p></th>
                        <th>Committed Amount<p>(प्रतिबद्ध राशि)</p></th>
                        <th>Ctc Per Month<p>(सीटीसी प्रति माह)</p></th>
                        <th> ESI No.<p>(ईएसआई नंबर)</p></th>
                        <th>PF UAN No.<p>(पीएफ यूएएन नंबर)</p></th>
                        <th>PF No.<p>(पीएफ नंबर)</p></th>
                        <th>CTC Per Annum<p>(सीटीसी प्रति वर्ष)</p></th>
                        <th>Pay Roll Organization<p>(वेतन रोल संगठन)</p></th>
                        <th>Pf Effective Date<p>(पीएफ प्रभावी तारीख)</p></th>
                        
                        <th>Actions<p>(कार्रवाई)</p></th>
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($salarydetails) > 0)
                        @foreach ($salarydetails as $type)
                            <tr data-entry-id="{{ $type->id }}">
                                <!-- <td></td> -->
                                @if($type->emp_img =='0') 
							<td><img src="assets/images/dummy.png" width="100" class="img-circle img-left"></td>
								@else  
								<td><img src="{{url('assets/images')}}/{{$type->emp_img}}" width="100" class="img-circle img-left"></td>
								@endif 
                                <td>{{ $type->emp_nick_name }}</td>
                                <td>{{ $type->committed_amount }}</td>
                                <td>{{ $type->ctc_per_month }}</td>
                                <td>{{ $type->esi_number }}</td>
                                <td>{{ $type->pf_uan_no }}</td>
                                <td>{{ $type->pf_no }}</td>
                                <td>{{ $type->ctc_per_annum }}</td>
                                <td>{{ $type->payroll_org }}</td>
                                <td>{{ $type->pf_effective_date }}</td>

                                
                             <td> <a href="{{ route('edit-assets',[$type->id]) }}" class="btn btn-xs btn-info">
                                    <i class="fas fa-edit"></i></a>
                                    <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#salary{{$type->id}}"><i class="fas fa-plus-square"></i></button>
                                  
                                       <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal{{$type->id}}"><i class="far fa-trash-alt"></i></button></td>

                                       <div class="modal fade" id="salary{{$type->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top " style="width:50%" role="document">
      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="exampleModalLongTitle" id="exampleModalLongTitle">Employee Salary</h5>
        </div>
        <div class="modal-body">
            <form action="{{route('store-salary-details',['id'=>$type->id])}}" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="panel-body">
                @csrf
                <div class="form-group">
                        <div class="col-sm-12">
                        <label for="">Actual Amount</label>
                        <input type="text" name="ctc_per_month" class="form-control @error('ctc_per_month') is-invalid @enderror" id="ctc_per_month" value="{{ $type->ctc_per_month }}" placeholder="" readonly>
                        @error('ctc_per_month')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                </div>
                <div class="form-group">
                        <div class="col-sm-12">
                        <label for="">Paid Amount</label>
                        <input type="text" name="paid_amount" class="form-control @error('paid_amount') is-invalid @enderror" id="paid_amount" placeholder="Enter Amount" required>
                        @error('paid_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                </div>
                <div class="form-group">
                        <div class="col-sm-12">
                        <label for="">Due Amount</label>
                        <input type="text" name="due" class="form-control @error('due') is-invalid @enderror" id="due" placeholder="Enter Amount" required>
                        @error('due')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                </div>
                <div class="form-group">

                            <div class="col-sm-12">
                            <label for="">Payment Bank</label>
                                <select  name="payment_bank" id="payment_bank" class="form-control @error('payment_bank') is-invalid @enderror" name="payment_bank"  required autocomplete="payment_bank">
                                <option value="" disabled selected>Select Payment Bank</option>
                                    @foreach($banks as $bank)
                                        <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                    @endforeach                                            
                                                     
                             </select>
                                @error('payment_bank')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                        <label for="">Salary For Month</label>
                            <input type="month" name="salary_for_month"  class="form-control @error('salary_for_month') is-invalid @enderror only-numeric" id="salary_for_month" placeholder="Enter Month Name" required>
                            @error('salary_for_month')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                        <label for="">Salary Status</label>
                        <select  name="salary_status" id="salary_status" class="form-control @error('salary_status') is-invalid @enderror" name="salary_status"  required autocomplete="salary_status">
                            <option value="" disabled selected>Select Status</option>
                                    <option value="0">Non Paid</option>
                                    <option value="1">Paid</option>
                                                                                                    
                             </select>
                             @error('salary_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                       
                </div>
                <div class="form-group">
                        <div class="col-sm-12">
                        <label for="">Remarks</label>
                        <textarea name="remarks" id="remarks" cols="10" rows="3" class="form-control @error('remarks') is-invalid @enderror" required></textarea>
                        @error('remarks')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Submit</button>
        </div>
    </form>
      </div>
    </div>
    </div>
                                <div class="container">
                                    <div class="modal fade" id="myModal{{$type->id}}" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" style="text-indent: 0;">&times;</button>
                                                    <h4 class="modal-title">Assets </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Sure about delete this</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{route('deleteassets',['id'=>$type->id])}}" class="btn btn-xs btn-info"><i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div></td>
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
