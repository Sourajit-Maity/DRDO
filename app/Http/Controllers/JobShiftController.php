<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Models\CRM;
use App\Models\SubRole;
use App\Models\CompanyGenInfo;
use App\Models\JobShift;
use App\Models\Employee;
use App\Models\EmployeeType;
use App\Models\User; 
use App\Models\CompanyLocation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Datatables;
use Response,Config;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\File;
use Illuminate\Support\Facades\Notification;


class JobShiftController extends Controller
{
    public function addjobshift()
    {
        $employee = Employee::get(); 
        $crm = CRM::get();
        return view('jobshift.addjobshift',compact('employee','crm'));
    }


    public function submitjobshift(Request $request)
   {

    $request->validate([
        'moreFields.*.serial_no' => 'required',
        'moreFields.*.job_id' => 'required',
        'moreFields.*.crm_id' => 'required',
        'moreFields.*.words' => 'required',
        'moreFields.*.shifted_from' => 'required',
        'moreFields.*.shifted_to' => 'required',
        'moreFields.*.shifted_date' => 'required',
        'moreFields.*.delivery_date' => 'required',
        'moreFields.*.payable' => 'required',
    ]);
      
       // Log::debug("all".print_r($request->all(),true));
        //$jobshift= new JobShift();

        //$jobshift->serial_no= $request->get('serial_no');
       // $jobshift->job_id= $request->get('job_id');
       // $jobshift->crm_id= $request->get('crm_id');
       // $jobshift->words= $request->get('words');
        //$jobshift->shifted_from= $request->get('shifted_from');
       // $jobshift->shifted_to= $request->get('shifted_to');
       // $jobshift->shifted_date= $request->get('shifted_date');
        //$jobshift->delivery_date= $request->get('delivery_date');
        //$jobshift->payable= $request->get('payable');
    
        //$jobshift->save(); 
     

       //return Redirect::to('view-jobshift')->with('success','Jobshift added Successfully');

       
       
      
     
        foreach ($request->moreFields as $key => $value) {
            JobShift::create($value);
        }
     
        return Redirect::back()->with('success', 'Jobshift Created Successfully.');
    
 
         
 
        
  
   }


   public function viewjobshift(Request $request)
   {

    
        $type = JobShift::select('job_shift.id as id','words','shifted_to','shifted_from',
        'shifted_date','delivery_date','payable','azhrms_crm.crm',
        'serial_no','job_id','crm_id','azhrms_employee.emp_nick_name','users.name',)
         ->join('azhrms_employee', 'job_shift.shifted_from', '=', 'azhrms_employee.id')
         ->join('users', 'job_shift.shifted_to', '=', 'users.emp_id')
         ->join('azhrms_crm', 'job_shift.crm_id', '=', 'azhrms_crm.id')
         ->get();
            
        return view('jobshift.viewjobshift',compact('type',));
   } 

   public function deletejobshift(Request $request,$id)
    {

        JobShift::where('id',$id)->delete();
        
        return Redirect::back();
    }

}
