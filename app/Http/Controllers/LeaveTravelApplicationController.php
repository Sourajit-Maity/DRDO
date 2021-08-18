<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rules\MatchOldPassword;
use App\Models\LeavePeriodHistory;
use App\Models\LeaveType;
use App\Models\WorkWeek;
use App\Models\EmployeeFamilyDetails;
use App\Models\SubRole;
use App\Models\CompanyGenInfo;
use App\Models\EmployeeLanguage;
use App\Models\Employee;
use App\Models\LeaveEntitlement;
use App\Models\EmployeeSkillGrade;
use App\Models\EmployeeSkills;
use App\Models\EmployeeEducation;
use App\Models\EmployeeType;
use App\Models\User; 
use App\Models\CompanyLocation;
use App\Models\Assets;
use App\Models\EmployeeAssets;
use App\Models\Workshift;
use App\Models\EmployeePromotion;
use App\Models\EmployeeSalary;
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
use App\Models\LeaveTravelApplication;
use App\Models\LtcPersonDetails;
use App\Models\LeaveTravelConcessionType;
use Illuminate\Support\Facades\Notification;
use App\Models\CRM;
use App\Models\BankMaster;
use App\Models\District;
use App\Models\State;
use App\Models\Country; 
use App\Notifications\LeaveTravelapprove;
use App\Notifications\LeaveTravelapply;
use App\Listeners\SendComplainNotification;


class LeaveTravelApplicationController extends Controller
{
    public function addleavetravelapply()
    {

        $currentuserid = Auth::user()->emp_id;

        $myprofile= Employee::select('emp_status','joined_date','emp_street2','azhrms_employee_type.emp_type_name',
        'emp_nick_name','operational_company_id','emp_code','azhrms_employee_salary.committed_amount',
        'azhrms_employee.operational_company_location_id', 'azhrms_employee.operational_company_loc_dept_id','users.name',
        'azhrms_company_location_department.d_name','azhrms_user_role.display_name','emp_mobile',
        'reporting_to','shift','designation','job_role','azhrms_employee.id as id',)->

        join('azhrms_employee_type', 'azhrms_employee.emp_status', '=', 'azhrms_employee_type.id')->
        join('azhrms_company_location_department', 'azhrms_employee.operational_company_loc_dept_id', '=', 'azhrms_company_location_department.id')->
        join('azhrms_user_role', 'azhrms_employee.designation', '=', 'azhrms_user_role.id')->
        join('azhrms_employee_salary', 'azhrms_employee.id', '=', 'azhrms_employee_salary.emp_id')->
        join('users', 'azhrms_employee.reporting_to', '=', 'users.emp_id')->
            where('azhrms_employee.id',$currentuserid)
            ->first();

        $designation = Role::get(); 
        $leavecocessiontype = LeaveTravelConcessionType::get();
      return view('ltcapplication.addltcapplication',compact('myprofile','leavecocessiontype','designation'));
    }

    
    public function submitleavetravelapply(Request $request)
   {
                
                $this->validate($request, [
            
                    'designation_id'  => 'required',
                    'emp_id'  => 'required',
                    'employee_type'  => 'required', 
                    'date_of_joining'  => 'required',
                    'present_pay_npa_si'  => 'required',
                    'home_town'  => 'required',
                    'destination_ltc'  => 'required',
                    'single_fare' => 'required',
                    'days' => 'required',
                    'advance'  => 'required',
                    'date_from'  => 'required',
                    'date_to' => 'required',
                    'reason'  => 'required',
                    'total_person_availed' => 'required',
                    'spouse_ltc' => 'required',
                    'ticket_file' => 'required|file|mimes:jpg,jpeg,png',
                
            
                ]);

                DB::beginTransaction();

                try {
                
            $employee=  new LeaveTravelApplication();
            $employee->designation_id= $request->get('designation_id');
            $employee->emp_id= $request->get('emp_id');
            $employee->employee_type= $request->get('employee_type');
            $employee->date_of_joining= $request->get('date_of_joining');
            $employee->present_pay_npa_si= $request->get('present_pay_npa_si');
            $employee->home_town= $request->get('home_town');
            $employee->spouse_ltc= $request->get('spouse_ltc');
            $employee->leave_travel_type_id= $request->get('leave_travel_type_id');
            $employee->hometown_ltc= $request->get('hometown_ltc');
            $employee->destination_ltc= $request->get('destination_ltc');
            $employee->single_fare= $request->get('single_fare');
            $employee->advance= $request->get('advance');
            $employee->date_from= $request->get('date_from');
            $employee->reason= $request->get('reason');
            $employee->date_to= $request->get('date_to');
            $employee->days= $request->get('days');
            $employee->total_person_availed= $request->get('total_person_availed');
            $employee->declare_check= $request->get('declare');

            $fileName = time().'.'.$request->ticket_file->extension();  

            $request->ticket_file->move(public_path('assets/ticket'), $fileName);
            $employee->ticket_file= $fileName;


            $employee->save();

            $id = $request->get('emp_id');
            $emp_user_id = User::where('emp_id',$id)->value('id');
            $applier = User::find($emp_user_id);
            
            $admin = User::find(1);

            Notification::send($admin, new LeaveTravelapply($admin)); 
            Notification::send($applier, new LeaveTravelapply($applier));  


            DB::commit();

            } 
            catch (\Exception $e) {
            DB::rollback();

            }


            //Log::debug("all".print_r($request->all(),true));
            return Redirect::to('view-leave-travel-apply')->with('success','You have successfully Updated.');

            }

   public function editleavetravelapply($id)
   {

    $type = LeaveTravelApplication::findOrFail($id);

     return view('ltcapplication.editltcapplication',compact('type'));
   }


   public function updateleavetravelapply($id, Request $request)
   {
       
    

       $type= LeaveTravelApplication::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }
   

   public function getemployee($id) 
   {
       $employee = Employee::where("designation",$id)->get();
       return json_encode($employee);
   }

   public function getemployeetype($id) 
   {
       $status_id = Employee::where("id",$id)->value('emp_status');
       $employeetype = EmployeeType::where("id",$status_id)->get();
       return json_encode($employeetype);
   }

   public function getemployeejoining($id) 
   {
       $employeejoining = Employee::where("id",$id)->get();
       return json_encode($employeejoining);
   }


   public function __construct()
   {
       $this->middleware('auth'); 
   }

   public function viewleavetravelapply()
   {
       $currentuserid = Auth::user()->id;

       $emp_id = User::where('id',$currentuserid)->value('emp_id');

       $emp_comp_id = Employee::where('azhrms_employee.id',$emp_id)->value('operational_company_id');

       $comp_id = CompanyGenInfo::where('azhrms_company_gen_info.id',$emp_comp_id)->value('id');

       $user = Auth::user();

       

       
       if(Auth::user()->role=='1') {
           $leaves = LeaveTravelApplication::
           select('emp_id','leave_travel_type_id','date_from','azhrms_employee.emp_nick_name','reason','leave_travel_application.id as id','leave_travel_concession_type.leave_travel_concession','date_to','days','leave_type_offer','is_approved',)
           
           ->join('leave_travel_concession_type','leave_travel_application.leave_travel_type_id','=','leave_travel_concession_type.id')
           ->join('azhrms_employee','leave_travel_application.emp_id','=','azhrms_employee.id')
           ->paginate(10);
          // $leaves = Leave::paginate(5);
       }
       elseif(Auth::user()->role=='2') {
           $leaves = LeaveTravelApplication::
           select('emp_id','leave_travel_type_id','date_from','azhrms_employee.emp_nick_name','reason','leave_travel_application.id as id','leave_travel_concession_type.leave_travel_concession','date_to','days','leave_type_offer','is_approved',)
           
           ->join('leave_travel_concession_type','leave_travel_application.leave_travel_type_id','=','leave_travel_concession_type.id')
           ->join('azhrms_employee','leave_travel_application.emp_id','=','azhrms_employee.id')
           ->where('azhrms_employee.operational_company_id',$comp_id)
           ->paginate(10);
          // $leaves = Leave::paginate(5); 
       }
      
    

       else{
           $leaves =  LeaveTravelApplication::
           select('emp_id','leave_travel_type_id','date_from','azhrms_employee.emp_nick_name','reason','leave_travel_application.id as id','leave_travel_concession_type.leave_travel_concession','date_to','days','leave_type_offer','is_approved',)
           
           ->join('leave_travel_concession_type','leave_travel_application.leave_travel_type_id','=','leave_travel_concession_type.id')
           ->join('azhrms_employee','leave_travel_application.emp_id','=','azhrms_employee.id')
            ->where('leave_travel_application.emp_id',$emp_id)->paginate(10);
           
       }

       return view('ltcapplication.viewltcapplication',compact('leaves','user'));
   }

   public function leavetravelapprove(Request $request,$id)
    {

     // $leaveid = $id;
     // $empid = LeaveTravelApplication::where('leave_travel_application.id', $id)->value('emp_id');
        $leave = LeaveTravelApplication::find($id);

       if($leave){
           $leave->is_approved = $request -> approve;
           $leave->save();

           //  $empid = $request->get('emp_id');
           // $emp_user_id = User::where('emp_id',$empid)->value('id');
            
           // $admin = User::find(1);

           // Notification::send($admin, new LeaveTravelapprove($admin)); 
           // Notification::send($emp_user_id, new LeaveTravelapprove($emp_user_id));

           return redirect()->back();
       }
    }

    public function leavetravelpaid(Request $request,$id)
    {

      $leaveid = $id;
      $empid = LeaveTravelApplication::where('leave_travel_application.id', $id)->value('emp_id');
        $leave = LeaveTravelApplication::find($id);
        
        if($leave){
            $leave->leave_type_offer = $request -> paid;
            $leave->save();
              
              $emp_user_id = User::where('emp_id',$empid)->value('id');
              $applier = User::find($emp_user_id);
            
               Notification::send($applier, new LeaveTravelapprove($applier));
            return redirect()->back();
        }
    }


   public function addltcmember($id)
   {
        $currentuserid = Auth::user()->emp_id;

        $ltcapply = LeaveTravelApplication::findOrFail($id);
        Log::debug("ltcapply".print_r($ltcapply,true));
        
       $member = EmployeeFamilyDetails::where('employee_family_details.emp_id', $currentuserid)->get();
      
       return view('ltcapplication.addltcperson',compact('member','ltcapply'));
   }


   public function submitltcmember($id,Request $request)
  {

   $request->validate([
       'moreFields.*.ltc_application_id' => 'required',
       'moreFields.*.person_name' => 'required',
       'moreFields.*.emp_id' => 'required',
      
   ]); 
     

       foreach ($request->moreFields as $key => $value) {
        LtcPersonDetails::create($value);
       }
    
       return Redirect::back()->with('success', 'Member Details Uploaded Successfully.');
     
 
  }

  public function viewallltcmember($id,Request $request)
   {

    
      
       $currentuserid = Auth::user()->id;

       $emp_id = User::where('id',$currentuserid)->value('emp_id');


       if(Auth::user()->role=='1') {
           $leaves = LtcPersonDetails::
           select('emp_id','ltc_application_id','person_name','azhrms_employee.emp_nick_name','age','leave_travel_person_details.id as id','relationship',)
           
           ->join('azhrms_employee','leave_travel_person_details.emp_id','=','azhrms_employee.id')
           ->where('leave_travel_person_details.ltc_application_id',$id)
           ->paginate(10);
        
       }
      
           else{
            $leaves =  LtcPersonDetails::
            select('emp_id','ltc_application_id','person_name','azhrms_employee.emp_nick_name','age','leave_travel_person_details.id as id','relationship',)
            
            ->join('azhrms_employee','leave_travel_person_details.emp_id','=','azhrms_employee.id')
            ->where('leave_travel_person_details.ltc_application_id',$id)
             ->where('leave_travel_person_details.emp_id',$emp_id)->paginate(10);
            
        }

      return view('ltcapplication.viewltcperson',compact('leaves',));
    }
    public function viewltcmember($id, Request $request)
    {
 
     
       
        $currentuserid = Auth::user()->id;
 
        $emp_id = User::where('id',$currentuserid)->value('emp_id');
 
        $emp_comp_id = Employee::where('azhrms_employee.id',$emp_id)->value('operational_company_id');
 
        $comp_id = CompanyGenInfo::where('azhrms_company_gen_info.id',$emp_comp_id)->value('id');
 
        $user = Auth::user();
 
        
 
        
        if(Auth::user()->role=='1') {
            $leaves = LtcPersonDetails::
            select('emp_id','ltc_application_id','person_name','azhrms_employee.emp_nick_name','age','leave_travel_person_details.id as id','relationship',)
            
            ->join('azhrms_employee','leave_travel_person_details.emp_id','=','azhrms_employee.id')
            ->where('leave_travel_person_details.ltc_application_id',$id)
            ->paginate(10);
           
        }
       
            else{
             $leaves =  LtcPersonDetails::
             select('emp_id','ltc_application_id','person_name','azhrms_employee.emp_nick_name','age','leave_travel_person_details.id as id','relationship',)
             
             ->join('azhrms_employee','leave_travel_person_details.emp_id','=','azhrms_employee.id')
              ->where('leave_travel_person_details.emp_id',$emp_id)
              ->where('leave_travel_person_details.ltc_application_id',$id)
              ->paginate(10);
             
         }
 
       return view('ltcapplication.viewltcmember',compact('leaves',));
     }



     public function viewleavetraveldetails($id,Request $request)
     {
        $currentuserid = Auth::user()->id;
 
        $emp_id = User::where('id',$currentuserid)->value('emp_id');
      
     // $entitlement = LeaveTravelApplication::findOrFail($id);

      $entitlement = LeaveTravelApplication::
           select('emp_id','leave_travel_type_id','date_from','azhrms_employee.emp_nick_name','reason','leave_travel_application.id as id','leave_travel_concession_type.leave_travel_concession','date_to','days','leave_type_offer','is_approved',
           'designation_id','date_of_joining','present_pay_npa_si','employee_type','azhrms_employee_type.emp_type_name',
        'home_town', 'spouse_ltc','hometown_ltc','destination_ltc','single_fare','azhrms_user_role.display_name',
        'advance', 'declare_check','total_person_availed','ticket_file','leave_travel_type_id',
        'is_approved','date_from','date_to','days','reason','leave_type_offer')->
        join('azhrms_employee_type', 'leave_travel_application.employee_type', '=', 'azhrms_employee_type.id')->
        join('azhrms_user_role', 'leave_travel_application.designation_id', '=', 'azhrms_user_role.id')->
           join('leave_travel_concession_type','leave_travel_application.leave_travel_type_id','=','leave_travel_concession_type.id')
           ->join('azhrms_employee','leave_travel_application.emp_id','=','azhrms_employee.id')
           ->findOrFail($id);

           //Log::debug("entitlement".print_r($entitlement,true));

      $leaves =  LtcPersonDetails::
      select('leave_travel_person_details.emp_id','ltc_application_id','person_name','azhrms_employee.emp_nick_name','age','leave_travel_person_details.id as id','relationship',
      'employee_family_details.maritial_status','employee_family_details.relation','employee_family_details.member_name','employee_family_details.addhar_no','employee_family_details.dob')
      ->join('employee_family_details','leave_travel_person_details.person_name','=','employee_family_details.id')

      ->join('azhrms_employee','leave_travel_person_details.emp_id','=','azhrms_employee.id')
       //->where('leave_travel_person_details.emp_id',$emp_id)
       ->where('leave_travel_person_details.ltc_application_id',$id)
       ->paginate(10);
        
       Log::debug("leaves".print_r($leaves,true));
       
        return view('ltcapplication.viewltcapplicationdetails',compact('entitlement','leaves'));
     }


   
}
