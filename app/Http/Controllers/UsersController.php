<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Redirect,Response,DB,Config;
use Datatables;
use App\Models\User;
use App;
use App\Models\LeavePeriodHistory;
use App\Models\LeaveType;
use App\Models\EmployeeAttandance;
use App\Models\WorkWeek;
use App\Models\Skills;
use App\Models\Complain;
use App\Models\CompanyGenInfo;
use App\Models\EmployeeLanguage;
use App\Models\Employee;
use App\Models\LeaveEntitlement;
use App\Models\EmployeeSkillGrade;
use App\Models\EmployeeSkills;
use App\Models\EmployeeEducation;
use App\Models\EmployeeType; 
use App\Models\Announcement;
use App\Models\Assets;
use App\Models\EmployeeAssets;
use App\Models\Workshift;
use App\Models\EmployeePromotion;
use App\Models\EmployeeSalary;
use App\Models\EmployeeBankDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class UsersController extends Controller
{
    public function search()
    {
        return view('users');
    }
    public function usersList()
    {   
        $usersQuery = User::query();
 
        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
 
        if($start_date & $end_date){
     
         $start_date = date('Y-m-d', strtotime($start_date));
         $end_date = date('Y-m-d', strtotime($end_date));
          
         $usersQuery->whereRaw("date(users.created_at) >= '" . $start_date . "' AND date(users.created_at) <= '" . $end_date . "'");
        }
        $users = $usersQuery->select('*');
        return datatables()->of($users)
            ->make(true);
    }

    public function index($locale)
    {
        $announcements='';
        $announcementsArr=[];
        $date = Carbon::today();
        $shift = Workshift::get();
  
       $user =  Complain::count();
       $emp =  Employee::count();
       $company =  CompanyGenInfo::count();

       $currentuserid = Auth::user()->emp_id;

       $emp_comp_id = Employee::where('azhrms_employee.id',$currentuserid)->value('operational_company_id');

       $comp_id = CompanyGenInfo::where('azhrms_company_gen_info.id',$emp_comp_id)->value('id');

       $time = EmployeeAttandance::where('azhrms_employee_attandance.date',$date)->get();

       Log::debug("id2".print_r($currentuserid,true));

       $notifications = auth()->user()->unreadNotifications;

    
      
         $employee = DB::table('azhrms_employee')->select(
         'emp_nick_name','operational_company_id',
         
          'azhrms_company_gen_info.c_name',
         
         'azhrms_employee.id as id')
         ->join('azhrms_company_gen_info','azhrms_employee.operational_company_id','=','azhrms_company_gen_info.id')
         ->where('azhrms_employee.operational_company_id',$comp_id)
         ->where('azhrms_employee.deleted_at','=',null)
         ->first(); 

         $newemployee = DB::table('azhrms_employee')->select(
            'emp_nick_name','operational_company_id','emp_img',
            
             'azhrms_company_gen_info.c_name','azhrms_employee.created_at',
            
            'azhrms_employee.id as id')
            ->join('azhrms_company_gen_info','azhrms_employee.operational_company_id','=','azhrms_company_gen_info.id')
            ->orderBy('id','DESC')
            ->where('azhrms_employee.deleted_at','=',null)
            ->limit(4)
            ->get(); 

         
            $attandanceall = EmployeeAttandance::where('azhrms_employee_attandance.emp_id','=',$currentuserid)
            ->get();
            log::debug("attandanceall".print_r($attandanceall,true));
            
            $arruser= DB::table('announcements')->get()->toArray();
          

            

            foreach($arruser as $usr) {
                $users = explode(',', $usr->emp_id);
                foreach($users as $us) {
                    if($us==$currentuserid){
                        array_push($announcementsArr,$usr->text);
                    }
                } 
                
            }

        
        App::setlocale($locale);

        session()->put('locale', $locale);
        return view('homein',compact('user','emp','company','time','shift','attandanceall',
        
        'employee','notifications','newemployee','announcements','announcementsArr')); 
    }

}