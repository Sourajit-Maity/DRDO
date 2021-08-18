<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeTraining;
use App\Models\Employee;
use App\Models\EmployeeExamScore;
use App\Models\User;
use App\Models\Subject;
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

class EmployeeExamScoreController extends Controller
{
    public function addemployeeexamscore()
    {
        $subject = Subject::get();
        $employee = Employee::get();
       

      return view('examscore.addemployeeexamscore',compact('subject','employee'));
    }

    public function submitemployeeexamscore( Request $request)
            {
          
              $request->validate([
 
                'moreFields.*.training_given_by_id'  => 'required',
                'moreFields.*.subject_id'  => 'required',
                'moreFields.*.exam_score_time'  => 'required',
                'moreFields.*.exam_score_date'  => 'required',
                'moreFields.*.duration_from'  => 'required',
                'moreFields.*.duration_to'  => 'required',
                'moreFields.*.topics'  => 'required',
                'moreFields.*.exam_score'  => 'required',
                'moreFields.*.emp_id'  => 'required',
                
               
                
            ]);
           // $currentuserid = Auth::user()->id;

           // $emp_id = User::where('id',$currentuserid)->value('emp_id');
                
    
           // $report = new EmployeeExamScore;
          //  $report->emp_id=  $emp_id;
           // $report->training_given_by_id= $request->get('training_given_by_id');
         //   $report->subject_id= $request->get('subject_id');
         //   $report->exam_score_time= $request->get('exam_score_time');
        //    $report->exam_score_date= $request->get('exam_score_date');
           // $report->duration_from= $request->get('duration_from');
          //  $report->duration_to= $request->get('duration_to');
           // $report->topics= $request->get('topics');
           // $report->exam_score= $request->get('exam_score');
        

            //$report->save();

            
            foreach ($request->moreFields as $key => $value) {
              EmployeeExamScore::create($value);
          }


            //Log::debug("time".print_r($now,true));
        Log::debug("all".print_r($request->all(),true));
        return Redirect::back()->with('success','You have successfully submitted.');
        
        }


        public function viewemployeeexamscore(Request $request)
   {

    $currentuserid = Auth::user()->emp_id;

    $emp_comp_id = Employee::where('azhrms_employee.id',$currentuserid)->value('operational_company_id');

    $comp_id = CompanyGenInfo::where('azhrms_company_gen_info.id',$emp_comp_id)->value('id');


    if(Auth::user()->role=='1') {
       $report = DB::table('azhrms_exam_score')
       ->select('azhrms_exam_score.emp_id','duration_from','duration_to','azhrms_exam_score.id as id',
       'azhrms_subject.subject','users.name','azhrms_employee.emp_nick_name','exam_score',
       'training_given_by_id','subject_id','exam_score_date','exam_score_time','topics',)
       
       ->join('azhrms_subject','azhrms_exam_score.subject_id','=','azhrms_subject.id')
       ->join('users','azhrms_exam_score.emp_id','=','users.emp_id')
       ->join('azhrms_employee','azhrms_exam_score.training_given_by_id','=','azhrms_employee.id')
       ->get();
      }
      else{
        $report = DB::table('azhrms_exam_score')
        ->select('azhrms_exam_score.emp_id','duration_from','duration_to','azhrms_exam_score.id as id',
        'azhrms_subject.subject','users.name','azhrms_employee.emp_nick_name','exam_score',
        'training_given_by_id','subject_id','exam_score_date','exam_score_time','topics',)
        
        ->join('azhrms_subject','azhrms_exam_score.subject_id','=','azhrms_subject.id')
        ->join('users','azhrms_exam_score.emp_id','=','users.emp_id')
        ->join('azhrms_employee','azhrms_exam_score.training_given_by_id','=','azhrms_employee.id')
        ->where('azhrms_employee.operational_company_id',$comp_id)
        ->get();
      }
     
      return view('examscore.viewemployeeexamscore',compact('report',));
   } 
}
