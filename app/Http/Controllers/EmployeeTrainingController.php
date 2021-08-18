<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeTraining;
use App\Models\Employee;
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

class EmployeeTrainingController extends Controller
{
    public function addemployeetraining()
    {
        $subject = Subject::get();
        $employee = Employee::get();
       

      return view('training.addemployeetraining',compact('subject','employee'));
    }

    public function submitemployeetraining( Request $request)
            {

              //Log::debug("all".print_r($request->all(),true));

              $request->validate([
 
                'moreFields.*.training_given_by_id'  => 'required',
                'moreFields.*.subject_id'  => 'required',
                'moreFields.*.training_time'  => 'required',
                'moreFields.*.training_date'  => 'required',
                'moreFields.*.duration_from'  => 'required',
                'moreFields.*.duration_to'  => 'required',
                'moreFields.*.topics'  => 'required',
                'moreFields.*.emp_id'  => 'required',
                
               
                
            ]);
          
           // $currentuserid = Auth::user()->id;

            //$emp_id = User::where('id',$currentuserid)->value('emp_id');
                
    
            //$report = new EmployeeTraining;
            //$report->emp_id=  $emp_id;
            //$report->training_given_by_id= $request->get('training_given_by_id');
            //$report->subject_id= $request->get('subject_id');
            //$report->training_time= $request->get('training_time');
            //$report->training_date= $request->get('training_date');
            //$report->duration_from= $request->get('duration_from');
            //$report->duration_to= $request->get('duration_to');
            //$report->topics= $request->get('topics');

            //$report->save();
 
            foreach ($request->moreFields as $key => $value) {
              Log::debug("all".print_r($request->all(),true));
              EmployeeTraining::create($value);
          }

            //Log::debug("time".print_r($now,true));
       // Log::debug("all".print_r($request->all(),true));
        return Redirect::back()->with('success','You have successfully submitted.');
        
        }


        public function viewemployeetraining(Request $request)
   {
    $currentuserid = Auth::user()->emp_id;

    $emp_comp_id = Employee::where('azhrms_employee.id',$currentuserid)->value('operational_company_id');

    $comp_id = CompanyGenInfo::where('azhrms_company_gen_info.id',$emp_comp_id)->value('id');


    if(Auth::user()->role=='1') {
    
       $report = DB::table('azhrms_training')
       ->select('azhrms_training.emp_id','duration_from','duration_to','azhrms_training.id as id',
       'azhrms_subject.subject','users.name','azhrms_employee.emp_nick_name',
       'training_given_by_id','subject_id','training_date','training_time','topics',)
       
       ->join('azhrms_subject','azhrms_training.subject_id','=','azhrms_subject.id')
       ->join('users','azhrms_training.emp_id','=','users.emp_id')
       ->join('azhrms_employee','azhrms_training.training_given_by_id','=','azhrms_employee.id')
       ->get();
      }
      else{
        $report = DB::table('azhrms_training')
        ->select('azhrms_training.emp_id','duration_from','duration_to','azhrms_training.id as id',
        'azhrms_subject.subject','users.name','azhrms_employee.emp_nick_name',
        'training_given_by_id','subject_id','training_date','training_time','topics',)
        
        ->join('azhrms_subject','azhrms_training.subject_id','=','azhrms_subject.id')
        ->join('users','azhrms_training.emp_id','=','users.emp_id')
        ->join('azhrms_employee','azhrms_training.training_given_by_id','=','azhrms_employee.id')
        ->where('azhrms_employee.operational_company_id',$comp_id)
        ->get();

      }
     
      return view('training.viewemployeetraining',compact('report',));
   } 
}
