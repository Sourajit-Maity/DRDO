<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
use App\Models\User; 
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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)

    {
        $announcements='';
        $announcementsArr=[];
        $date = Carbon::today();
        $shift = Workshift::get();
      //  Log::debug("id2".print_r($time,true));
       $user =  Complain::count();
       $emp =  Employee::count();
       $company =  CompanyGenInfo::count();

       $currentuserid = Auth::user()->emp_id;

       $emp_comp_id = Employee::where('azhrms_employee.id',$currentuserid)->value('operational_company_id');

       $comp_id = CompanyGenInfo::where('azhrms_company_gen_info.id',$emp_comp_id)->value('id');

       $time = EmployeeAttandance::where('azhrms_employee_attandance.date',$date)->get();

       Log::debug("id2".print_r($currentuserid,true));

       $notifications = auth()->user()->unreadNotifications;

      // $checkout = EmployeeAttandance::findOrFail($date);
      
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

            //$date = Carbon::today();
            $attandanceall = EmployeeAttandance::where('azhrms_employee_attandance.emp_id','=',$currentuserid)
            ->get();
            log::debug("attandanceall".print_r($attandanceall,true));
            
            $arruser= DB::table('announcements')->get()->toArray();
            //$users = explode(',', $arruser[0]->emp_id);
            // $user =  count($user);
            
            //  $user = explode(',', $arruser[0]);

            //$announce= DB::table('announcements')->get();

            

            foreach($arruser as $usr) {
                $users = explode(',', $usr->emp_id);
                foreach($users as $us) {
                    if($us==$currentuserid){
                        array_push($announcementsArr,$usr->text);
                    }
                } 
                
            }

            //log::debug("announceeeeeeeeeeeetttt".print_r($announcementsArr,true));
            
            
            // foreach($users as $usr) {
            //     if($usr == $currentuserid){
            //         // $announcements = Announcement::where('emp_id',$currentuserid)
            //         // ->where('active', true)->get();

            //         $announcements = Announcement::where('emp_id', 'LIKE', '%' . $currentuserid . '%')
            //         ->where('active', true)->get()->toArray();

            //         log::debug("announceeeeeeeeeeeetttt".print_r($announcements,true));
            //         // foreach($announce as $anc) {
            //         //     if($anc->id == $announcements){
            //         //         $announcements = $announcements[0]['text'];
            //         //         array_push($announcementsArr,$announcements);
            //         //     }
            //         // }
                    

                    
                    
            //     }
            // }
            // log::debug("announcementsArr".print_r($announcementsArr,true));
       

            return view('home',compact('user','emp','company','time','shift','attandanceall',
        
                    'employee','notifications','newemployee','announcements','announcementsArr')); 


            
            
            
            // Log::debug("user".print_r($user,true));

            //Log::debug("arruser".print_r($user,true));

        
    }

    public function markNotification(Request $request)
    {
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }

     public function getattandance() 
   {
    $date = Carbon::today();
    $currentuserid = Auth::user()->emp_id;
    $attandanceall = EmployeeAttandance::
    where('azhrms_employee_attandance.emp_id','=',$currentuserid)
    ->where('azhrms_employee_attandance.date','=',$date)
    ->get();
       return json_encode($attandanceall);
   }
}
