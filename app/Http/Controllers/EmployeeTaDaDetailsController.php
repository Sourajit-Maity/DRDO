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
use App\Models\LeaveEntitlement;
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
use App\Models\CRM;

class EmployeeTaDaDetailsController extends Controller
{
    public function addemployeetada()

    {
        $currentuserid = Auth::user()->emp_id;

        $myprofile= Employee::select('emp_status',
        'emp_nick_name','operational_company_id','emp_code','azhrms_employee_salary.committed_amount',
        'azhrms_employee.operational_company_location_id', 'azhrms_employee.operational_company_loc_dept_id','users.name',
        'azhrms_company_location_department.d_name','azhrms_user_role.display_name','emp_mobile',
        'reporting_to','shift','designation','job_role','azhrms_employee.id as id',)->

       
        join('azhrms_company_location_department', 'azhrms_employee.operational_company_loc_dept_id', '=', 'azhrms_company_location_department.id')->
        join('azhrms_user_role', 'azhrms_employee.designation', '=', 'azhrms_user_role.id')->
        join('azhrms_employee_salary', 'azhrms_employee.id', '=', 'azhrms_employee_salary.emp_id')->
        join('users', 'azhrms_employee.reporting_to', '=', 'users.emp_id')->
            where('azhrms_employee.id',$currentuserid)
            ->first();
            $reportingid = Employee:: where('azhrms_employee.id',$currentuserid)->value('reporting_to');
            $hodprofile= Employee::select(
            'emp_nick_name','operational_company_id','emp_code',
            'azhrms_employee.operational_company_location_id', 'azhrms_employee.operational_company_loc_dept_id',
            'azhrms_company_location_department.d_name','azhrms_user_role.display_name','emp_mobile',
            'designation','job_role','azhrms_employee.id as id',)->
    
           
            join('azhrms_company_location_department', 'azhrms_employee.operational_company_loc_dept_id', '=', 'azhrms_company_location_department.id')->
            join('azhrms_user_role', 'azhrms_employee.designation', '=', 'azhrms_user_role.id')->
                where('azhrms_employee.id',$reportingid)
                ->first();
                $dirprofile= Employee::select(
                    'emp_nick_name','operational_company_id','emp_code',
                    'azhrms_employee.operational_company_location_id', 'azhrms_employee.operational_company_loc_dept_id',
                    'azhrms_company_location_department.d_name','azhrms_user_role.display_name','emp_mobile',
                    'designation','job_role','azhrms_employee.id as id',)->
            
                   
                    join('azhrms_company_location_department', 'azhrms_employee.operational_company_loc_dept_id', '=', 'azhrms_company_location_department.id')->
                    join('azhrms_user_role', 'azhrms_employee.designation', '=', 'azhrms_user_role.id')->
                        where('azhrms_employee.designation',1)
                        ->first();

            //Log::debug("hod".print_r($dirprofile,true));
       $entitlement = TaDaEntitlement::get();
       $travel = CRM::get();
        return view('employeetada.addemployeetada',compact('entitlement','travel','myprofile','hodprofile','dirprofile'));
    }

    public function submitemployeetada(Request $request)
    {
        $this->validate($request, [
 
            'hod_id'  => 'required',
            'ta_da_advance' => 'required',
            'hall_ordinary_da'  => 'required',
            'travel_by' => 'required',
            'ta_entitlement_id'  => 'required',
            'days' => 'required',
            'dir_id' => 'required',
            'location_from'  => 'required',
            'location_to' => 'required',
            'date_from'  => 'required',
            'date_to' => 'required',
            'reason' => 'required',
            'emp_dept' => 'required',
            'emp_name' => 'required',
            'hod_designation'  => 'required',
            'hod_department' => 'required',
            'hod_name'  => 'required',
            'dir_name' => 'required',
            'temp_move'  => 'required',
            'authority_move' => 'required',
            'grade_pay' => 'required',
            'basic_pay'  => 'required',
            'emp_gpf' => 'required',
            'emp_designation'  => 'required',
            'phone_no' => 'required',
            'cas_no' => 'required',


           
        ]);
 
        $ta = new EmployeeTaDaDetails();

        $ta->hod_id = $request->get('hod_id');
        $ta->travel_by = $request->get('travel_by');
        $ta->ta_da_advance = $request->get('ta_da_advance');
        $ta->hall_ordinary_da = $request->get('hall_ordinary_da');
        $ta->ta_entitlement_id = $request->get('ta_entitlement_id');
        $ta->days = $request->get('days');
        $ta->dir_id = $request->get('dir_id');
        $ta->location_from = $request->get('location_from');
        $ta->location_to = $request->get('location_to');
        $ta->date_from = $request->get('date_from');
        $ta->date_to = $request->get('date_to');
        $ta->reason = $request->get('reason');
        $ta->hod_designation = $request->get('hod_designation');
        $ta->hod_department = $request->get('hod_department');
        $ta->emp_name = $request->get('emp_name');
        $ta->emp_dept = $request->get('emp_dept');
        $ta->cas_no = $request->get('cas_no');
        $ta->phone_no = $request->get('phone_no');
        $ta->emp_designation = $request->get('emp_designation');
        $ta->emp_gpf = $request->get('emp_gpf');
        $ta->basic_pay = $request->get('basic_pay');
        $ta->grade_pay = $request->get('grade_pay');
        $ta->authority_move = $request->get('authority_move');
        $ta->temp_move = $request->get('temp_move');
        $ta->dir_name = $request->get('dir_name');
        $ta->hod_name = $request->get('hod_name');
        $ta->emp_id = Auth::user()->emp_id;
       

        $ta->save();
        //Log::debug("hod".print_r($ta,true));
        $id =$request->get('hod_id');
        $admin_id = User::where('emp_id',$id)->value('id');
        $admin = User::find($admin_id);
        $dir = User::find(1);
        $issuerid = Auth::user()->id;

        $applier = User::find($issuerid);

        Notification::send($dir, new EmployeeTaDa($dir)); 
        Notification::send($admin, new EmployeeTaDa($admin)); 
        Notification::send($applier, new EmployeeTaDa($applier));  
 
 
        return Redirect::to('view-employeetada')->with('success','TA-DA applied Successfully!');
    }

    public function viewemployeetada(Request $request)
   {

    
      // $entitlement = EmployeeTaDaDetails::get(); 

       $currentuserid = Auth::user()->emp_id;

    if(Auth::user()->role=='1' || Auth::user()->role=='2') {
       $entitlement = EmployeeTaDaDetails::select('crm','entitlement_name','ta_da_entitlement.travel_by',
       'employee_ta_da_details.travel_by as travel_id',
       'employee_ta_da_details.id as id', 'emp_id', 'dir_id','hod_id','ta_da_advance','hall_ordinary_da',
        'ta_entitlement_id','location_from','location_to','date_from',
       'date_to', 'days','reason','remarks','dir_aproval','hod_aproval',
       'deleted_at',
       'hod_name', 'hod_department','hod_designation',
       'emp_name', 'emp_dept','cas_no','phone_no','emp_designation',
       'emp_gpf', 'basic_pay','grade_pay','authority_move','temp_move','dir_name',
       )
       ->join('ta_da_entitlement','employee_ta_da_details.ta_entitlement_id','=','ta_da_entitlement.id')
       ->join('azhrms_crm','employee_ta_da_details.travel_by','=','azhrms_crm.id')->get();
       
       
     
       
    }
    else{
        $entitlement = EmployeeTaDaDetails::select('crm','entitlement_name','ta_da_entitlement.travel_by',
        'employee_ta_da_details.travel_by as travel_id',
        'employee_ta_da_details.id as id', 'emp_id', 'dir_id','hod_id','ta_da_advance','hall_ordinary_da',
         'ta_entitlement_id','location_from','location_to','date_from',
        'date_to', 'days','reason','remarks','dir_aproval','hod_aproval',
        'deleted_at',
        'hod_name', 'hod_department','hod_designation',
        'emp_name', 'emp_dept','cas_no','phone_no','emp_designation',
        'emp_gpf', 'basic_pay','grade_pay','authority_move','temp_move','dir_name',
        )
        ->join('ta_da_entitlement','employee_ta_da_details.ta_entitlement_id','=','ta_da_entitlement.id')
        ->join('azhrms_crm','employee_ta_da_details.travel_by','=','azhrms_crm.id')->
        where('employee_ta_da_details.emp_id',$currentuserid)->get();
      
      
       
    }
      
       Log::debug("hod".print_r($entitlement,true));
     
      return view('employeetada.viewemployeetada',compact('entitlement',));
   }
   public function viewemployeetadadetails($id,Request $request)
   {

    
    $entitlement = EmployeeTaDaDetails::select('crm','entitlement_name','ta_da_entitlement.travel_by',
    'employee_ta_da_details.travel_by as travel_id',
    'employee_ta_da_details.id as id', 'emp_id', 'dir_id','hod_id','ta_da_advance','hall_ordinary_da',
     'ta_entitlement_id','location_from','location_to','date_from',
    'date_to', 'days','reason','remarks','dir_aproval','hod_aproval',
    'deleted_at',
    'hod_name', 'hod_department','hod_designation',
    'emp_name', 'emp_dept','cas_no','phone_no','emp_designation',
    'emp_gpf', 'basic_pay','grade_pay','authority_move','temp_move','dir_name',
    )
    ->join('ta_da_entitlement','employee_ta_da_details.ta_entitlement_id','=','ta_da_entitlement.id')
    ->join('azhrms_crm','employee_ta_da_details.travel_by','=','azhrms_crm.id')->findOrFail($id);
      
      
     
      return view('employeetada.viewemployeetadadetails',compact('entitlement',));
   }
   public function deleteemployeetada(Request $request,$id)
    {

        EmployeeTaDaDetails::where('id',$id)->delete();
        
        return Redirect::back();
    }
    


    public function editemployeetada($id)

    {
       
        $entitlement = EmployeeTaDaDetails::findOrFail($id);
        $entitle = TaDaEntitlement::get();
        //Log::debug("entitlement".print_r($entitlement,true));
 
        return view('employeetada.editemployeetada', compact('entitlement','entitle') );
    }
 
 
    public function updateemployeetada($id, Request $request)
    {
        $this->validate($request, [
 
            'hod_id'  => 'required',
            'ta_da_advance' => 'required',
            'hall_ordinary_da'  => 'required',
            'travel_by' => 'required',
            'ta_entitlement_id'  => 'required',
            'days' => 'required',
            'dir_id' => 'required',
            'location_from'  => 'required',
            'location_to' => 'required',
            'date_from'  => 'required',
            'date_to' => 'required',
            'reason' => 'required',
            'emp_dept' => 'required',
            'emp_name' => 'required',
            'hod_designation'  => 'required',
            'hod_department' => 'required',
            'hod_name'  => 'required',
            'dir_name' => 'required',
            'temp_move'  => 'required',
            'authority_move' => 'required',
            'grade_pay' => 'required',
            'basic_pay'  => 'required',
            'emp_gpf' => 'required',
            'emp_designation'  => 'required',
            'phone_no' => 'required',
            'cas_no' => 'required',

        ]);
 
        $entitlement= EmployeeTaDaDetails::findOrFail($id);
        $entitlement->update($request->all());
        Log::debug("entitlement".print_r($entitlement,true));
        return Redirect::back()->with('success','Successfully Updated!');
    }


    public function employeetadaadminapprove(Request $request,$id)
    {

      
        $leave = EmployeeTaDaDetails::find($id);

       if($leave){
           $leave->hod_aproval = $request -> approve;
           $leave->save();
           return redirect()->back();
       }
    }

    public function employeetadadirapprove(Request $request,$id)
    {
        $leave = EmployeeTaDaDetails::find($id);
        if($leave){
            $leave->dir_aproval = $request -> paid;
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
