<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EmployeeAttandance;
use App\Models\LeavePeriodHistory;
use App\Models\LeaveType;
use App\Models\WorkWeek;
use App\Models\Skills;
use App\Models\TimetrackerReview;
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
use App\Models\Assets;
use App\Models\EmployeeAssets;
use App\Models\Workshift;
use App\Models\EmployeePromotion;
use App\Models\EmployeeSalary;
use App\Models\EmployeeBankDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Redirect;

class AttandanceController extends Controller
{
         public function submitattandance( Request $request) 
            {

                $currentuserid = Auth::user()->id;

                $emp_id = User::where('id',$currentuserid)->value('emp_id');

                $emp_code = Employee::where('id',$emp_id)->value('emp_code');

                $now = Carbon::now();
                $date = Carbon::today();

                $start_time = $now;
                $end_time = Carbon::now()->addHour(8);
                
            
            
                $start_datetime = new DateTime($start_time);
                $end_datetime = new DateTime($end_time);
            
                $diff_in_minutes =  $start_datetime->diff($end_datetime);
                $hour = $diff_in_minutes->format('%h');


                
                
            $attandance = new EmployeeAttandance;
            $attandance->in_time= $start_time;
            $attandance->out_time= $end_time; 
            $attandance->emp_id=  $emp_id;
            
            $attandance->date= $date;
            $attandance->status= 'present';
            $attandance->shift_id= $request->get('shift_id');
            $attandance->total_duration= $hour;
            $attandance->remarks= $request->get('remarks');
            $attandance->status_flag= 1;
        

            $attandance->save();



            //Log::debug("attandance".print_r($attandance,true));
        //Log::debug("all".print_r($request->all(),true));
         //return Redirect::back()->with('success',1);
            return(1);
        }

        public function updateattandance($date, Request $request)
        {

                $now = Carbon::now();

                $start_time = $request->get('in_time');
                $end_time = $now;
                
            
            
                $start_datetime = new DateTime($start_time);
                $end_datetime = new DateTime($end_time);
            
                $diff_in_minutes =  $end_datetime->diff($start_datetime);
                $hour = $diff_in_minutes->format('%h');

            
                $attandance= EmployeeAttandance::findOrFail($date);
                $attandance->in_time= $request->get('in_time');
                $attandance->emp_id= $request->get('emp_id');
                $attandance->emp_code= $request->get('emp_code');
                $attandance->date= $request->get('date');
                $attandance->status= $request->get('status');
                $attandance->shift_id= $request->get('shift_id');
                $attandance->status_flag= $request->get('status_flag');
                $attandance->total_duration= $hour;
                $attandance->out_time= $now;



                 $attandance->update();


        Log::debug("all".print_r($request->all(),true));
        return Redirect::back()->with('success','See You Tomorrow');

        }



   public function checkout(Request $request,$id)
   {

    EmployeeAttandance::where('id',$id)->delete();
       
       return Redirect::back()->with('success','Good Bye,See You Tomorrow');
   }



   public function addattandancereview()
    {
      return view('time.addreview');
    }

    
    public function submitattandancereview(Request $request)
   {
       
    $this->validate($request, [
 
        'review'  => 'required|string|max:200',
      
    ]);
    $currentuserid = Auth::user()->id;

    $emp_id = User::where('id',$currentuserid)->value('emp_id');

         $review = new TimetrackerReview;
            $review->emp_id=  $emp_id;
            $review->review= $request->get('review');
            
        

            $review->save();

     

       return Redirect::back()->with('success',' Submitted Successfully!');
   }



   public function viewattandancereview(Request $request)
   {
    $currentuserid = Auth::user()->emp_id;

    $emp_comp_id = Employee::where('azhrms_employee.id',$currentuserid)->value('operational_company_id');

    $comp_id = CompanyGenInfo::where('azhrms_company_gen_info.id',$emp_comp_id)->value('id');


    if(Auth::user()->role=='1') {
    
       $review = TimetrackerReview::select('review','azhrms_time_tracker_review.created_at','emp_id','azhrms_employee.emp_nick_name')
  
       -> join('azhrms_employee', 'azhrms_time_tracker_review.emp_id', '=', 'azhrms_employee.id')-> get();
    }
    else{
        $review = TimetrackerReview::select('review','azhrms_time_tracker_review.created_at','emp_id','azhrms_employee.emp_nick_name')
  
        -> join('azhrms_employee', 'azhrms_time_tracker_review.emp_id', '=', 'azhrms_employee.id')
        ->where('azhrms_employee.operational_company_id',$comp_id)
        -> get();
     }

      return view('time.viewreview',compact('review',));
   } 

}
