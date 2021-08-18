<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Models\LeavePeriodHistory;
use App\Models\LeaveType;
use App\Models\WorkWeek;
use App\Models\EmployeeTaDaDetails;
use App\Models\CompanyGenInfo;
use App\Models\Employee;
use App\Models\CompanyLocationDepartment;
use App\Models\EmployeeType;
use App\Models\User; 
use App\Models\TaDaEntitlement;
use App\Models\Assets;
use App\Models\Workshift;
use App\Models\EmployeeFamilyDetails;
use App\Models\EmployeePromotion;
use App\Models\EmployeeSalary;
use App\Models\FamilyNominations;
use App\Models\EmployeeBankDetails; 
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
use App\Notifications\EmployeeTaDa;
use App\Notifications\AssetsReturnNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\EmployeeClaim;

class EmployeeClaimController extends Controller
{
    public function addemployeeclaim()

    {
        $currentuserid = Auth::user()->emp_id;

            $casid = Employee:: where('azhrms_employee.id',$currentuserid)->value('emp_code');
            $deptid = Employee:: where('azhrms_employee.id',$currentuserid)->value('operational_company_loc_dept_id');
            $dept = CompanyLocationDepartment:: where('azhrms_company_location_department.id',$deptid)->value('d_name');
            //Log::debug("casid".print_r($casid,true));
            $telephone = Employee:: where('azhrms_employee.id',$currentuserid)->value('emp_mobile');
            $bank = EmployeeBankDetails:: where('azhrms_employee_bank_details.emp_id',$currentuserid)->value('account_number');

        return view('claim.addemployeeclaim',compact('casid','bank','telephone','dept'));
    }

    public function submitemployeeclaim(Request $request)
    {
        $request->validate([
            'moreFields.*.designation_id' => 'required',
            'moreFields.*.emp_id' => 'required',
            'moreFields.*.cas_id' => 'required',
            'moreFields.*.telephone_no' => 'required',
            'moreFields.*.bank_account_no' => 'required',
            'moreFields.*.landline_no' => 'required',
            'moreFields.*.landline_amount' => 'required',
            'moreFields.*.landline_service_tax' => 'required',
            'moreFields.*.landline_total' => 'required',
        ]); 
          
    
            foreach ($request->moreFields as $key => $value) {
                EmployeeClaim::create($value);
            }
 
        return Redirect::to('view-employeeclaim')->with('success','Claim applied Successfully!');
    }

    public function viewemployeeclaim(Request $request)
   {

    
      // $entitlement = EmployeeTaDaDetails::get(); 

       $currentuserid = Auth::user()->emp_id;

    if(Auth::user()->role=='1' || Auth::user()->role=='2') 
    {
       $entitlement = EmployeeClaim::
       select('designation_id','azhrms_claim_details.emp_id','cas_id','directorate','telephone_no','bank_account_no','landline_no',
       'landline_amount','landline_service_tax','landline_total','approved_by','azhrms_employee.emp_code','azhrms_employee.emp_mobile',
       'azhrms_claim_details.id as id', 'azhrms_employee.emp_firstname')
      
       ->join('azhrms_employee','azhrms_claim_details.emp_id','=','azhrms_employee.id')
       //->join('azhrms_user_role','azhrms_claim_details.designation_id','=','azhrms_user_role.id')
       ->get();
       
       
     
       
    }
    else{
        $entitlement = EmployeeClaim::
        select('designation_id','azhrms_claim_details.emp_id','cas_id','directorate','telephone_no','bank_account_no','landline_no',
        'landline_amount','landline_service_tax','landline_total','approved_by','azhrms_employee.emp_code','azhrms_employee.emp_mobile',
        'azhrms_claim_details.id as id', 'azhrms_employee.emp_firstname')
        
        ->join('azhrms_employee','azhrms_claim_details.emp_id','=','azhrms_employee.id')->
        where('azhrms_claim_details.emp_id',$currentuserid)->get();
      
      
       
    }
      
       //Log::debug("entitlement".print_r($entitlement,true));
     
      return view('claim.viewemployeeclaim',compact('entitlement',));
   }
   public function viewemployeeclaimdetails($id,Request $request)
   {

    
    $entitlement =  EmployeeClaim::
    select('designation_id','azhrms_claim_details.emp_id','cas_id','directorate','telephone_no','bank_account_no','landline_no',
    'landline_amount','landline_service_tax','landline_total','approved_by','azhrms_employee.emp_code','azhrms_employee.emp_mobile',
    'azhrms_claim_details.id as id', 'azhrms_employee.emp_firstname','azhrms_user_role.name')
   
    ->join('azhrms_employee','azhrms_claim_details.emp_id','=','azhrms_employee.id')
    ->join('azhrms_user_role','azhrms_claim_details.designation_id','=','azhrms_user_role.id')
    ->findOrFail($id);
      
      
     
      return view('claim.viewemployeeclaimdetails',compact('entitlement',));
   }
   public function deleteemployeeclaim(Request $request,$id)
    {

        EmployeeClaim::where('id',$id)->delete();
        
        return Redirect::back();
    }
    


    public function editemployeeclaim($id)

    {
       
        $entitlement = EmployeeClaim::findOrFail($id);
        $entitle = TaDaEntitlement::get();
        //Log::debug("entitlement".print_r($entitlement,true));
 
        return view('claim.editemployeeclaim', compact('entitlement','entitle') );
    }
 
 
    public function updateemployeeclaim($id, Request $request)
    {
        
 
        $entitlement= EmployeeClaim::findOrFail($id);
        $entitlement->update($request->all());
        Log::debug("entitlement".print_r($entitlement,true));
        return Redirect::back()->with('success','Successfully Updated!');
    }


    public function employeeclaimadminapprove(Request $request,$id)
    {

      
        $leave = EmployeeClaim::find($id);

       if($leave){
           $leave->approved_by = $request -> approve;
           $leave->save();
           return redirect()->back();
       }
    }

    public function employeeclaimdirapprove(Request $request,$id)
    {
        $leave = EmployeeClaim::find($id);
        if($leave){
            $leave->approved_by = $request -> paid;
            $leave->save();
            return redirect()->back();
        }
    }


    public function getentitlementname($id) 
    {
        $unit= TaDaEntitlement::where("travel_by",$id)->get();
         //Log::debug("unit".print_r($unit,true));
        return json_encode($unit);
    }
}

