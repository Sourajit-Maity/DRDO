<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DailyReport;
use App\Models\Employee;
use App\Models\User;
use App\Models\Jobcategory;
use App\Models\Jobtype;
use App\Models\CRM;
use App\Models\CompanyGenInfo;
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

class DailyReportController extends Controller
{
    public function adddailyreport()
    {
        $jobcategory = Jobcategory::get();
        $jobtype = Jobtype::get();
        $crm = CRM::get();

      return view('dailyreport.adddailyreport',compact('jobcategory','jobtype','crm'));
    }

    public function submitdailyreport( Request $request)
            {

                $request->validate([
 
                    'moreFields.*.job_type_id'  => 'required',
                    'moreFields.*.job_category_id'  => 'required',
                    'moreFields.*.crm_id'  => 'required',
                    'moreFields.*.words'  => 'required',
                    'moreFields.*.job_id'  => 'required',
                    'moreFields.*.report_time'  => 'required',
                    'moreFields.*.report_date'  => 'required',
                    'moreFields.*.emp_id'  => 'required',
                    
  
                    
                ]);

                //$currentuserid = Auth::user()->id;

               // $emp_id = User::where('id',$currentuserid)->value('emp_id');

               
               // $now = Carbon::now();
                //$date = Carbon::today();

                //$start_time = $now;
               // $end_time = Carbon::now()->addHour(8);
                
            

                
                
           // $report = new DailyReport;
            //$report->report_time= $now;
            
           // $report->emp_id=  $emp_id;
            
           // $report->report_date= $date;
          
           // $report->job_type_id= $request->get('job_type_id');
            //$report->job_category_id= $request->get('job_category_id');
            //$report->crm_id= $request->get('crm_id');
            //$report->words= $request->get('words');
            //$report->job_id= $request->get('job_id');
           // $report->job_description= $request->get('job_description');

            //$report->save(); 

            foreach ($request->moreFields as $key => $value) {
                DailyReport::create($value);
            }



           // Log::debug("time".print_r($now,true));
        Log::debug("all".print_r($request->all(),true));
        return Redirect::back()->with('success','You have successfully submitted.');
        
        }


        public function viewdailyreport(Request $request)
   {
    $currentuserid = Auth::user()->emp_id;

    $emp_comp_id = Employee::where('azhrms_employee.id',$currentuserid)->value('operational_company_id');

    $comp_id = CompanyGenInfo::where('azhrms_company_gen_info.id',$emp_comp_id)->value('id');


    if(Auth::user()->role=='1') {
       $report = DB::table('azhrms_daily_report')
       ->select('emp_id','report_date','report_time','azhrms_daily_report.id as id',
       'azhrms_crm.crm','azhrms_jobcategory.job_category','azhrms_jobtype.job_type','azhrms_employee.emp_nick_name',
       'job_type_id','job_category_id','crm_id','words','job_id',)
       
       ->join('azhrms_jobcategory','azhrms_daily_report.job_category_id','=','azhrms_jobcategory.id')
       ->join('azhrms_crm','azhrms_daily_report.crm_id','=','azhrms_crm.id')
       ->join('azhrms_jobtype','azhrms_daily_report.job_type_id','=','azhrms_jobtype.id')
       ->join('azhrms_employee','azhrms_daily_report.emp_id','=','azhrms_employee.id')
       ->get();
    }
    else{
        $report = DB::table('azhrms_daily_report')
       ->select('emp_id','report_date','report_time','azhrms_daily_report.id as id',
       'azhrms_crm.crm','azhrms_jobcategory.job_category','azhrms_jobtype.job_type','azhrms_employee.emp_nick_name',
       'job_type_id','job_category_id','crm_id','words','job_id',)
       
       ->join('azhrms_jobcategory','azhrms_daily_report.job_category_id','=','azhrms_jobcategory.id')
       ->join('azhrms_crm','azhrms_daily_report.crm_id','=','azhrms_crm.id')
       ->join('azhrms_jobtype','azhrms_daily_report.job_type_id','=','azhrms_jobtype.id')
       ->join('azhrms_employee','azhrms_daily_report.emp_id','=','azhrms_employee.id')
       ->where('azhrms_employee.operational_company_id',$comp_id)
       ->get();
    }
      return view('dailyreport.viewdailyreport',compact('report',));
   } 
}
