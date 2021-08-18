<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\CompanyGenInfo;
use App\Models\CompanyLocation;
use App\Models\CompanyLocationDepartment;
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
use App\Rules\MatchOldPassword;
use App\Models\LeavePeriodHistory;
use App\Models\LeaveType;
use App\Models\WorkWeek;
use App\Models\Skills;
use App\Models\SubRole;
use App\Models\EmployeeLanguage;
use App\Models\Employee;
use App\Models\LeaveEntitlement;
use App\Models\EmployeeSkillGrade;
use App\Models\EmployeeSkills;
use App\Models\EmployeeEducation;
use App\Models\EmployeeType;
use App\Models\User; 
use App\Models\EmployeeAssets;
use App\Models\Workshift;
use App\Models\EmployeePromotion;
use App\Models\EmployeeSalary;
use App\Models\EmployeeBankDetails; 
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\File;
use App\Notifications\AssetsNotification;
use App\Notifications\AssetsReturnNotification;
use App\Notifications\TaskCompleted;
use Illuminate\Support\Facades\Notification;
use App\Listeners\SendComplainNotification;

class AnnouncementsController extends Controller
{

    public function addannouncement()
    {
        $designation= Role::get();
        $employee = Employee::get();
        $company= CompanyGenInfo::get();
        $location= CompanyLocation::get(); 

        return view('announcements.addannouncements',compact('designation','employee','company','location'));
    }


    public function getannouncementuser($lid,$did) 
    {
        
        $desig_id_array=[];

        $locArray = explode(',', $lid);  
        $desigArray = explode(',', $did); 


        $employeelocation = CompanyLocation::get(); 
        $employeedesignation = Role::get();
        
        //Log::debug("location".print_r($locArray,true));
        //Log::debug("designation".print_r($desigArray,true));


        foreach($locArray as $locarray) {
            foreach($desigArray as $desigarray) {
               
                    $unit= Employee::select(
                        'azhrms_user_role.display_name','azhrms_company_gen_info.c_name','azhrms_employee.emp_nick_name',
                        'azhrms_employee.operational_company_id','azhrms_employee.id as id')
                        ->join('azhrms_company_gen_info','azhrms_employee.operational_company_id','=','azhrms_company_gen_info.id')
                        ->join('azhrms_user_role','azhrms_employee.designation','=','azhrms_user_role.id')

                    ->where("azhrms_employee.operational_company_location_id",$locarray)
                    ->where("azhrms_employee.designation",$desigarray)
                    ->get();
                    
                    array_push($desig_id_array,$unit);
                }
            }
        
            //Log::debug("designation arrayaa".print_r($desig_id_array,true));
        return json_encode($desig_id_array);
       
    }

    public function getannouncementrole($id) 
    {
        $location_id_array=[]; 

        $locationArray = explode(',', $id);  

        //Log::debug("locationid".print_r($locationArray,true));

       $comprole = CompanyLocation::get();  

       

        foreach($locationArray as $locationarray) {
            foreach($comprole as $comproles) {
                if($comproles->id == $locationarray){
                    $role = Employee::select(
                        'azhrms_user_role.display_name',
                        'azhrms_employee.designation','azhrms_user_role.id as id')
                        ->join('azhrms_user_role','azhrms_employee.designation','=','azhrms_user_role.id')
                        ->where("azhrms_employee.operational_company_location_id",$comproles->id)->get();

                    array_push($location_id_array,$role);
                }
            }
        }

        return json_encode($location_id_array);
    }

    public function getlocationid($id) 
    {
        $company_id_array=[];
        

        $companyArray = explode(',', $id); 

        $complocation = CompanyGenInfo::get();

        foreach($companyArray as $companyarray) {
            foreach($complocation as $complocations) {
                if($complocations->id == $companyarray){
                    $companylocation = CompanyLocation::where("operational_company_id",$complocations->id)->get();
                    
                    array_push($company_id_array,$companylocation);
                }
            }
        }

       
        return json_encode($company_id_array);
    }


    public function postAnnouncement(Request $request)

    {

        $this->validate($request, [
 
            'text'  => 'required',
            'emp_id'  => 'required',
            'company_id'  => 'required',
            
           
            
       
        ]);

        $arraytostringemp =  implode(',',$request->input('emp_id'));
        $arraytostringdesignation =  implode(',',$request->input('designation_id'));
        $arraytostringlocation =  implode(',',$request->input('location_id'));
        $arraytostringcompany =  implode(',',$request->input('company_id'));

        $announcement = new Announcement;
        $announcement->text = $request->get('text');
        $announcement->active = $request->get('active_status');
        $announcement['location_id'] = $arraytostringlocation;
        $announcement['company_id'] = $arraytostringcompany;
        $announcement['designation_id'] = $arraytostringdesignation;
        $announcement['emp_id'] = $arraytostringemp;
        $announcement->save();

        Log::debug("all".print_r($request->all(),true));
    
        return back()->with('status', 'Announcement Posted Successfully');
     }

     public function viewannouncement(Request $request)
   {

    
       $announcements = Announcement::select('announcements.emp_id','announcements.id as id',
       'azhrms_company_gen_info.c_name','azhrms_company_location.l_name','azhrms_user_role.display_name','azhrms_employee.emp_nick_name',
       'designation_id','company_id','location_id','text','active',)
       
       ->join('azhrms_company_location','announcements.location_id','=','azhrms_company_location.id')
       ->join('azhrms_company_gen_info','announcements.company_id','=','azhrms_company_gen_info.id')
       ->join('azhrms_user_role','announcements.designation_id','=','azhrms_user_role.id')
       ->join('azhrms_employee','announcements.emp_id','=','azhrms_employee.id')
       ->get();

      return view('announcements.viewannouncements',compact('announcements',));
   } 

   public function changeActive($id,$status)
   {
       $change = DB::table('announcements')
           ->where('id', $id)
           ->update(
               [
                   'active' => (($status === "true") ? 1: 0),
                   'updated_at' => Carbon::now(),
               ]
           );
   }
}
