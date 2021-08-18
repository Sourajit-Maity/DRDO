<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Myinfo;
use App\Models\LeavePeriodHistory;
use App\Models\LeaveType;
use App\Models\WorkWeek;
use App\Models\Skills;
use App\Models\Employee;
use App\Models\CompanyGenInfo;
use App\Models\LeaveEntitlement;
use App\Models\EmployeeSkillGrade;
use App\Models\EmployeeSkills;
use App\Models\EmployeeEducation; 
use App\Models\User;
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

class MyinfoController extends Controller
{
    public function addinfotab()

    {  
        $currentuserid = Auth::user()->id;

        $emp_id = User::where('id',$currentuserid)->value('emp_id');

       // Log::debug("allcurrent".print_r($currentuserid,true));
       // Log::debug("allemp".print_r($emp_id,true));

        $myprofile= DB::table('azhrms_employee')->select('emp_status','emp_nationality_id','emp_lastname','emp_firstname','emp_middle_name',
        'emp_nick_name','emp_birthday','operational_company_id','emp_food_habit','emp_code','related_person','emp_language',
        'operational_company_location_id', 'operational_company_loc_dept_id','emp_gender','emp_marital_status','emp_religion_id',
        'emp_pan_num', 'emp_aadhar_num','emp_other_id','emp_bloodgroup','emp_street1','emp_street2',
        'district_code', 'emp_pincode','emp_hm_telephone','emp_mobile','emp_work_telephone','emp_work_email','city_code','state_code',
        'org_age','joined_date','emp_oth_email','emp_img','reporting_to','shift','designation','job_role',

        'azhrms_employee.id as id','azhrms_employee_assets.property_name','azhrms_employee_assets.property_details','azhrms_employee_assets.giving_date','azhrms_employee_assets.return_date','return_property_conditions',
        'acnt_holder_name','bank_name','branch_name','account_number','neft_code','ifsc_code','issuer',
        'promotion_date','effective_from','last_designation','last_salary','letters','emp_status_type',
        'committed_amount','ctc_per_month','esi_number','pf_uan_no','pf_no','ctc_per_annum','payroll_org','pf_effective_date',
        'azhrms_employee_edu_details.emp_education_id','ins_name','degree','grade','notes','year',
       'azhrms_employee_skill_details.emp_skill_id as skill','azhrms_employee_skill_details.skill_grade')->
        join('azhrms_employee_assets', 'azhrms_employee.id', '=', 'azhrms_employee_assets.emp_id')->
        join('azhrms_employee_bank_details', 'azhrms_employee.id', '=', 'azhrms_employee_bank_details.emp_id')->
        join('azhrms_employee_edu_details', 'azhrms_employee.id', '=', 'azhrms_employee_edu_details.emp_id')->

        join('azhrms_employee_salary', 'azhrms_employee.id', '=', 'azhrms_employee_salary.emp_id')->
        join('users', 'azhrms_employee.id', '=', 'users.emp_id')->
        join('azhrms_employee_skill_details', 'azhrms_employee.id', '=', 'azhrms_employee_skill_details.emp_id')->

        join('azhrms_employee_promotion', 'azhrms_employee.id', '=', 'azhrms_employee_promotion.emp_id')
            ->where('azhrms_employee.id',$emp_id)
            ->first();

            Log::debug("all".print_r($myprofile,true));
        $assets= DB::table('azhrms_employee_assets')-> join('azhrms_company_assets', 'azhrms_employee_assets.property_name', '=', 'azhrms_company_assets.id')->where('emp_id',$emp_id)->get();
        $promotionemployee= DB::table('azhrms_employee_promotion')->where('emp_id',$emp_id)->get();
        $skillemployee= DB::table('azhrms_employee_skill_details')-> join('azhrms_skill', 'azhrms_employee_skill_details.emp_skill_id', '=', 'azhrms_skill.id')->where('emp_id',$emp_id)->get();
        $educationemployee= DB::table('azhrms_employee_edu_details')-> join('azhrms_education', 'azhrms_employee_edu_details.emp_education_id', '=', 'azhrms_education.id')->where('emp_id',$emp_id)->get();

        $company= DB::table('azhrms_employee')->select('azhrms_company_gen_info.c_name as company_name','azhrms_employee.operational_company_id as operational_company')->
        join('azhrms_company_gen_info', 'azhrms_employee.operational_company_id', '=', 'azhrms_company_gen_info.id')
        ->where('azhrms_employee.id',$emp_id)->get();

        $nationality= DB::table('azhrms_employee')->select('azhrms_nationalities.name as nation_name','azhrms_employee.emp_nationality_id as emp_nationality')->
        join('azhrms_nationalities', 'azhrms_employee.emp_nationality_id', '=', 'azhrms_nationalities.id')
        ->where('azhrms_employee.id',$emp_id)->get();
        
        $companylocation= DB::table('azhrms_employee')->select('azhrms_company_location.l_name as location_name','azhrms_employee.operational_company_location_id as operational_company_loc')->
        join('azhrms_company_location', 'azhrms_employee.operational_company_location_id', '=', 'azhrms_company_location.id')
        ->where('azhrms_employee.id',$emp_id)->get();

        $locationdepartment= DB::table('azhrms_employee')->select('azhrms_company_location_department.d_name as dept_name','azhrms_employee.operational_company_loc_dept_id as operational_company_loc_dept')->
        join('azhrms_company_location_department', 'azhrms_employee.operational_company_loc_dept_id', '=', 'azhrms_company_location_department.id')
        ->where('azhrms_employee.id',$emp_id)->get();

        $religion= DB::table('azhrms_employee')->select('azhrms_religion.name as reli_name','azhrms_employee.emp_religion_id as emp_religion')->
        join('azhrms_religion', 'azhrms_employee.emp_religion_id', '=', 'azhrms_religion.id')
        ->where('azhrms_employee.id',$emp_id)->get();

        $education= DB::table('azhrms_education')->get();
        $skills= DB::table('azhrms_skill')->get();

        $roles= DB::table('azhrms_employee')->select('azhrms_user_role.name as role_name','azhrms_employee.designation as designation_id')->
        join('azhrms_user_role', 'azhrms_employee.designation', '=', 'azhrms_user_role.id')
        ->where('azhrms_employee.id',$emp_id)->get();

        $rolecategory= DB::table('azhrms_employee')->select('azhrms_user_role_categories.respname as respname_name','azhrms_employee.job_role as job_role_id')->
        join('azhrms_user_role_categories', 'azhrms_employee.job_role', '=', 'azhrms_user_role_categories.id')
        ->where('azhrms_employee.id',$emp_id)->get();

        $type= DB::table('azhrms_employee')->select('azhrms_employee_type.emp_type_name as emp_type_name_name','azhrms_employee.emp_status as emp_status_id')->
        join('azhrms_employee_type', 'azhrms_employee.emp_status', '=', 'azhrms_employee_type.id')
        ->where('azhrms_employee.id',$emp_id)->get();

        $shift= DB::table('azhrms_employee')->select('azhrms_work_shift.name as work_name','azhrms_employee.shift as shift_id')->
        join('azhrms_work_shift', 'azhrms_employee.shift', '=', 'azhrms_work_shift.id')
        ->where('azhrms_employee.id',$emp_id)->get();


        $language= DB::table('azhrms_employee_language')->get();
        $arrlanguages= DB::table('azhrms_employee')->where ('azhrms_employee.id',$emp_id)->value("emp_language");
        
        $lng = explode(',', $arrlanguages);


        //$reporting= DB::table('azhrms_employee')->select('users.name as user_name','azhrms_employee.reporting_to as reporting')->
        //join('users', 'azhrms_employee.id', '=', 'users.emp_id')
       // ->where('azhrms_employee.id',$emp_id)->get();  

        $emp_comp_id = Employee::where('azhrms_employee.id',$emp_id)->value('reporting_to');
        $reporting= DB::table('azhrms_employee')->select('azhrms_employee.emp_nick_name as user_name','azhrms_employee.reporting_to as reporting')
       
        ->where('azhrms_employee.id',$emp_comp_id)->get();
        
        $allleave= DB::table('leaves')-> join('azhrms_leave_type', 'leaves.leave_type', '=', 'azhrms_leave_type.id')
        ->join('azhrms_leave_entitlement','leaves.leave_type','=','azhrms_leave_entitlement.leave_type_id')
        ->where('emp_id',$emp_id)
        ->where('leaves.leave_type_offer',1)
        ->get();
        return view('myinfo.addinfotab',compact('roles','language','arrlanguages','lng',
        'promotionemployee','allleave','assets','skillemployee',    'educationemployee',
        'type','shift','reporting','myprofile','roles','rolecategory','education','skills',
        'company','nationality','companylocation','locationdepartment','religion'));
        
    }

//remuneration
    public function myremuneration()

    {  
        $currentuserid = Auth::user()->id;

        $emp_id = User::where('id',$currentuserid)->value('emp_id');

        $remuneration= DB::table('azhrms_employee_salary')->select(
        'emp_nick_name','emp_code',


        'azhrms_employee_salary.id as id',

        'committed_amount','ctc_per_month','esi_number','pf_uan_no','pf_no','ctc_per_annum','payroll_org','pf_effective_date',)->
       
        join('azhrms_employee', 'azhrms_employee_salary.emp_id', '=', 'azhrms_employee.id')->
            where('azhrms_employee.id',$emp_id)->
            first();

            Log::debug("all".print_r($remuneration,true));
       
        return view('myinfo.myremuneration',compact('remuneration'));
        
    }


    //feedback

    public function myfeedback()

    {  
        $currentuserid = Auth::user()->id;

        $emp_id = User::where('id',$currentuserid)->value('emp_id');

        $feedback= DB::table('azhrms_employee_feedback')->select(
        'azhrms_employee.emp_nick_name','azhrms_employee.emp_code',


        'azhrms_employee_feedback.id as id','feedback_comment',

        'feedback_type','feedback_category','feedback_category.feedback','azhrms_employee_feedback.created_at')->
        join('feedback_category', 'azhrms_employee_feedback.feedback_category', '=', 'feedback_category.id')->
        join('azhrms_employee', 'azhrms_employee_feedback.feedback_to_id', '=', 'azhrms_employee.id')->
            where('azhrms_employee.id',$emp_id)->
            get();

            Log::debug("all".print_r($feedback,true));
       
        return view('myinfo.myfeedback',compact('feedback'));
        
    }
//attandance
    public function myattandance()

    {  
        $currentuserid = Auth::user()->id;

        $emp_id = User::where('id',$currentuserid)->value('emp_id');

        $attandance= DB::table('azhrms_employee_attandance')->select(
        'azhrms_employee.emp_nick_name','azhrms_employee.emp_code',
          'status','out_time','total_duration','azhrms_employee_attandance.deleted_at',

        'azhrms_employee_attandance.id as id','azhrms_employee_attandance.shift_id',
        'azhrms_work_shift.name as shift_name','azhrms_employee_attandance.created_at',

        'date','in_time','azhrms_employee_attandance.created_at')->
       join('azhrms_work_shift', 'azhrms_employee_attandance.shift_id', '=', 'azhrms_work_shift.id')->
        join('azhrms_employee', 'azhrms_employee_attandance.emp_id', '=', 'azhrms_employee.id')->
            where('azhrms_employee_attandance.emp_id',$emp_id)->
            get();

            Log::debug("emp".print_r($attandance,true));
       
        return view('myinfo.myattandance',compact('attandance'));
        
    }
//dailyattandance
    public function myattandancecheckout()

    {  
        $currentuserid = Auth::user()->id;

        $emp_id = User::where('id',$currentuserid)->value('emp_id');

        $attandance= DB::table('azhrms_employee_attandance')->select(
        'azhrms_employee.emp_nick_name','azhrms_employee.emp_code',
          'status','out_time','total_duration','azhrms_employee_attandance.deleted_at',

        'azhrms_employee_attandance.id as id','azhrms_employee_attandance.shift_id',
        'azhrms_work_shift.name as shift_name',

        'date','in_time','azhrms_employee_attandance.created_at')->
       join('azhrms_work_shift', 'azhrms_employee_attandance.shift_id', '=', 'azhrms_work_shift.id')->
        join('azhrms_employee', 'azhrms_employee_attandance.emp_id', '=', 'azhrms_employee.id')->
            where('azhrms_employee_attandance.emp_id',$emp_id)->
            where('azhrms_employee_attandance.deleted_at','=',null)->
            get();

            Log::debug("emp".print_r($attandance,true));
       
        return view('myinfo.checkout',compact('attandance'));
        
    }

    //myteam

    public function myteam()

    {  
        $currentuserid = Auth::user()->emp_id;

    $emp_comp_id = Employee::where('azhrms_employee.id',$currentuserid)->value('operational_company_id');

    $comp_id = CompanyGenInfo::where('azhrms_company_gen_info.id',$emp_comp_id)->value('id');

  
    //Log::debug("ids".print_r($comp_id,true));
    if(Auth::user()->role=='1') {

       $employee = DB::table('azhrms_employee')->select('emp_lastname','emp_firstname','emp_middle_name',
       'emp_nick_name','operational_company_id','designation','emp_code',
       'operational_company_location_id', 'operational_company_loc_dept_id',
        'azhrms_company_gen_info.c_name','azhrms_user_role.display_name',
       'emp_img','azhrms_employee.id as id')
       ->join('azhrms_company_gen_info','azhrms_employee.operational_company_id','=','azhrms_company_gen_info.id')
       ->join('azhrms_user_role','azhrms_employee.designation','=','azhrms_user_role.id')
      // ->where('azhrms_employee.designation','=',Auth::user()->role)
       ->where('azhrms_employee.deleted_at','=',null)  
       ->get(); 
    }
    else{
        $employee = DB::table('azhrms_employee')->select('emp_lastname','emp_firstname','emp_middle_name',
        'emp_nick_name','operational_company_id','emp_code','azhrms_user_role.display_name',
        'operational_company_location_id', 'operational_company_loc_dept_id',
         'azhrms_company_gen_info.c_name',
        'emp_img','azhrms_employee.id as id')
        ->join('azhrms_company_gen_info','azhrms_employee.operational_company_id','=','azhrms_company_gen_info.id')
        ->join('azhrms_user_role','azhrms_employee.designation','=','azhrms_user_role.id')
        ->where('azhrms_employee.operational_company_id',$comp_id)
        //->where('azhrms_employee.designation','=',Auth::user()->role)
        ->where('azhrms_employee.deleted_at','=',null)
        ->get(); 
    }

           // Log::debug("all".print_r($employee,true)); 

           
           // return json_encode($employee);
        return view('myinfo.myteam',compact('employee'));
        
    } 

    public function myteamview() 
   {
    $currentuserid = Auth::user()->emp_id;
    $emp_name = Employee::where('azhrms_employee.id',$currentuserid)->value('emp_nick_name');
    $emp_img = Employee::where('azhrms_employee.id',$currentuserid)->value('emp_img');

    $emp_designation = Employee::where('azhrms_employee.id',$currentuserid)->value('designation');

    $emp_comp_id = Employee::where('azhrms_employee.id',$currentuserid)->value('operational_company_id');

    $comp_id = CompanyGenInfo::where('azhrms_company_gen_info.id',$emp_comp_id)->value('id');

    $emp_reporting = Employee::where('azhrms_employee.id',$currentuserid)->value('reporting_to');

   // $all_reporting = Employee::where('azhrms_employee.reporting_to',$currentuserid)->pluck('id','emp_nick_name');
    $all_reporting = Employee::select(
        'emp_nick_name','designation','azhrms_user_role.display_name', 'emp_img','azhrms_employee.id as id')->
    where('azhrms_employee.reporting_to',$currentuserid)
    ->join('azhrms_user_role','azhrms_employee.designation','=','azhrms_user_role.id')
    ->get(); 
 
    //Log::debug("all_reporting".print_r($all_reporting,true));
    $all1_reporting = Employee::select(
    'emp_nick_name','designation','azhrms_user_role.display_name', 'emp_img','azhrms_employee.id as id')

    ->join('azhrms_user_role','azhrms_employee.designation','=','azhrms_user_role.id')->

    where('azhrms_employee.id',$currentuserid)->value('display_name'); 
    Log::debug("all1_reporting".print_r($all1_reporting,true));

  $finalArray = '{
    "id": '.$currentuserid.',
    "name": "'.$emp_name.'",
    "img": "'.$emp_img.'",
    "title": "'.$all1_reporting.'",
    "children":[';
    
        $i=0;
        foreach ($all_reporting as $reporting) 
        {
            
            $finalArray .= '{
                "id": '.$reporting->id.',
                "name": "'.$reporting->emp_nick_name.'",
                "img": "'.$reporting->emp_img.'",
                "title": "'.$reporting->display_name.'",
                "children":[
            ';

            $reporting1 = Employee::select(
                'emp_nick_name','designation','azhrms_user_role.display_name', 'emp_img','azhrms_employee.id as id')->
            where('azhrms_employee.reporting_to',$reporting->id)
            ->join('azhrms_user_role','azhrms_employee.designation','=','azhrms_user_role.id')
            ->get();  

            foreach ($reporting1 as $reportings) 
            {
                    
                $finalArray .= '{
                "id": '.$reportings->id.',
                "name": "'.$reportings->emp_nick_name.'",
                "img": "'.$reportings->emp_img.'",
                "title": "'.$reportings->display_name.'",
                "children":[';

                $reporting2 = Employee::select(
                    'emp_nick_name','designation','azhrms_user_role.display_name', 'emp_img','azhrms_employee.id as id')->
                where('azhrms_employee.reporting_to',$reportings->id)
                ->join('azhrms_user_role','azhrms_employee.designation','=','azhrms_user_role.id')
                ->get(); 

                foreach ($reporting2 as $report) 
                {
                    $finalArray .= '{
                    "id": '.$report->id.',
                    "name": "'.$report->emp_nick_name.'",
                    "img": "'.$report->emp_img.'",
                    "title": "'.$report->display_name.'",
                    "children":[';

                    $reporting3 = Employee::select(
                        'emp_nick_name','designation','azhrms_user_role.display_name', 'emp_img','azhrms_employee.id as id')->
                    where('azhrms_employee.reporting_to',$report->id)
                    ->join('azhrms_user_role','azhrms_employee.designation','=','azhrms_user_role.id')
                    ->get(); 

                    foreach ($reporting3 as $repo) 
                    {
                        $finalArray .= '{
                            "id": '.$repo->id.',
                            "name": "'.$repo->emp_nick_name.'",
                            "img": "'.$repo->emp_img.'",
                            "title": "'.$repo->display_name.'",
                            "children":[';
                        
                        $reporting4 = Employee::select(
                            'emp_nick_name','designation','azhrms_user_role.display_name', 'emp_img','azhrms_employee.id as id')->
                        where('azhrms_employee.reporting_to',$repo->id)
                        ->join('azhrms_user_role','azhrms_employee.designation','=','azhrms_user_role.id')
                        ->get(); 

                        foreach ($reporting4 as $repot)
                        {
                                $finalArray .= '{
                                    "id": '.$repot->id.',
                                    "name": "'.$repot->emp_nick_name.'",
                                    "img": "'.$repot->emp_img.'",
                                    "title": "'.$repot->display_name.'",
                                    "children":[';

                                $reporting5 = Employee::select(
                                    'emp_nick_name','designation','azhrms_user_role.display_name', 'emp_img','azhrms_employee.id as id')->
                                where('azhrms_employee.reporting_to',$repot->id)
                                ->join('azhrms_user_role','azhrms_employee.designation','=','azhrms_user_role.id')
                                ->get(); 
                                
                            foreach ($reporting5 as $repo5)
                            {
                                    $finalArray .= '{
                                        "id": '.$repo5->id.',
                                        "name": "'.$repo5->emp_nick_name.'",
                                        "img": "'.$repo5->emp_img.'",
                                        "title": "'.$repo5->display_name.'"
                                        },';
                            }
                            $finalArray .=']},';
                        }
                        $finalArray .=']},';
                    }
                    $finalArray .=']},';
                }
                $finalArray .=']},';
            }
            $finalArray .=']},';   
        }
        $finalArray .=']}';

    
        $finalArray=str_replace('},]', '}] ', $finalArray);
    
    
                 Log::debug("finalArray".print_r($finalArray,true));

       
     return json_encode($finalArray);
   }


//givenfeedback
    public function givenfeedback()

    {  
        $currentuserid = Auth::user()->id;

        $emp_id = User::where('id',$currentuserid)->value('emp_id');

       
            $feedback = DB::table('azhrms_employee_feedback')->select(
                'azhrms_employee.emp_nick_name','azhrms_employee.emp_code','users.name',
        
        
                'azhrms_employee_feedback.id as id','feedback_comment','feedback_to_id',
        
                'feedback_type','feedback_category','feedback_category.feedback','azhrms_employee_feedback.created_at')->
                join('feedback_category', 'azhrms_employee_feedback.feedback_category', '=', 'feedback_category.id')->
                join('azhrms_employee', 'azhrms_employee_feedback.feedback_to_id', '=', 'azhrms_employee.id')->
                join('users', 'azhrms_employee_feedback.emp_id', '=', 'users.emp_id')->
                where('azhrms_employee_feedback.emp_id',$emp_id)->
                    get();

            Log::debug("all".print_r($feedback,true));
       
        return view('myinfo.givenfeedback',compact('feedback'));
        
    }
//givencomplain
    public function givencomplain()

    {  
        $currentuserid = Auth::user()->id;

        $emp_id = User::where('id',$currentuserid)->value('emp_id');

       
            $complain = DB::table('azhrms_complain')->select(
                'azhrms_employee.emp_nick_name','azhrms_employee.emp_code','users.name',
        
        
                'azhrms_complain.id as id','azhrms_complain.complain','complain_against_id',
        
                'notes','azhrms_complain.created_at')->
                join('azhrms_employee', 'azhrms_complain.complain_against_id', '=', 'azhrms_employee.id')->
                join('users', 'azhrms_complain.emp_id', '=', 'users.emp_id')->
                where('azhrms_complain.emp_id',$emp_id)->
                    get();

            Log::debug("all".print_r($complain,true));
       
        return view('myinfo.givencomplain',compact('complain'));
        
    }
//mytraining
    public function mytraining()

    {  
        $currentuserid = Auth::user()->id;

        $emp_id = User::where('id',$currentuserid)->value('emp_id');

       
            $training = DB::table('azhrms_training')->select(
                'azhrms_employee.emp_nick_name','azhrms_employee.emp_code','users.name',
        
          'training_date','training_time','subject_id','topics','duration_from','duration_to',
                'azhrms_training.id as id','training_given_by_id',
                'azhrms_subject.subject','azhrms_training.created_at')->
                
                join('azhrms_employee', 'azhrms_training.training_given_by_id', '=', 'azhrms_employee.id')->
                join('users', 'azhrms_training.emp_id', '=', 'users.emp_id')->
                join('azhrms_subject', 'azhrms_training.subject_id', '=', 'azhrms_subject.id')->
                where('azhrms_training.emp_id',$emp_id)->
                    get();

            Log::debug("all".print_r($training,true));
       
        return view('myinfo.mytraining',compact('training'));
        
    }

    public function myexamscore()

    {  
        $currentuserid = Auth::user()->id;

        $emp_id = User::where('id',$currentuserid)->value('emp_id');

       
            $training = DB::table('azhrms_exam_score')->select(
                'azhrms_employee.emp_nick_name','azhrms_employee.emp_code','users.name',
        
          'exam_score_date','exam_score_time','subject_id','topics','duration_from','duration_to',
                'azhrms_exam_score.id as id','training_given_by_id','exam_score',
                'azhrms_subject.subject','azhrms_exam_score.created_at')->
                
                join('azhrms_employee', 'azhrms_exam_score.training_given_by_id', '=', 'azhrms_employee.id')->
                join('users', 'azhrms_exam_score.emp_id', '=', 'users.emp_id')->
                join('azhrms_subject', 'azhrms_exam_score.subject_id', '=', 'azhrms_subject.id')->
                where('azhrms_exam_score.emp_id',$emp_id)->
                    get();

            Log::debug("all".print_r($training,true));
       
        return view('myinfo.myexamscore',compact('training'));
        
    }
//mydailyreport
    public function mydailyreport()

    {  
        $currentuserid = Auth::user()->id;

        $emp_id = User::where('id',$currentuserid)->value('emp_id');
   

        $report = DB::table('azhrms_daily_report')
       ->select('emp_id','report_date','report_time','azhrms_daily_report.id as id',
       'azhrms_crm.crm','azhrms_jobcategory.job_category','azhrms_jobtype.job_type','azhrms_employee.emp_nick_name',
       'job_type_id','job_category_id','crm_id','words','job_id',)
       
       ->join('azhrms_jobcategory','azhrms_daily_report.job_category_id','=','azhrms_jobcategory.id')
       ->join('azhrms_crm','azhrms_daily_report.crm_id','=','azhrms_crm.id')
       ->join('azhrms_jobtype','azhrms_daily_report.job_type_id','=','azhrms_jobtype.id')
       ->join('azhrms_employee','azhrms_daily_report.emp_id','=','azhrms_employee.id')
       ->where('azhrms_daily_report.emp_id',$emp_id)
       ->get();

            Log::debug("all".print_r($report,true));
       
        return view('myinfo.mydailyreport',compact('report'));
        
    }

    //mywarning
    public function mywarning()

    {  
        $currentuserid = Auth::user()->id;

        $emp_id = User::where('id',$currentuserid)->value('emp_id');

        $warning= DB::table('azhrms_employee_warning')
        ->select('emp_id','warning_emp_name','issuer_name','azhrms_employee_warning.id as id',
        'warning_header','reason','date','azhrms_employee.emp_nick_name')

        ->join('azhrms_employee','azhrms_employee_warning.emp_id','=','azhrms_employee.id')
        -> where('azhrms_employee.id',$emp_id)->
            get();

            Log::debug("all".print_r($warning,true));
       
        return view('myinfo.mywarning',compact('warning'));
        
    }

     //mysalary
     public function mysalary()

     {  
         $currentuserid = Auth::user()->id;
 
         $emp_id = User::where('id',$currentuserid)->value('emp_id');
 
         $salary= DB::table('salary_details')->select('salary_details.id as id','salary_details.emp_id','salary_for_month','salary_status','remarks',
         'payment_date','salary_issuer_id','paid_amount','azhrms_employee.emp_nick_name','users.name',)
          ->join('azhrms_employee', 'salary_details.emp_id', '=', 'azhrms_employee.id')
          ->join('users', 'salary_details.salary_issuer_id', '=', 'users.id')
         ->where('azhrms_employee.id',$emp_id)->
             get();
 
             Log::debug("all".print_r($salary,true));
        
         return view('myinfo.mysalary',compact('salary'));
         
     }


}
