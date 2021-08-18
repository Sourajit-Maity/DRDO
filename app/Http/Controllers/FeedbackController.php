<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Models\Feedback;
use App\Models\EmployeeFeedback;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Complain;
use App\Models\User;
use App\Models\Employee;
use App\Models\CompanyGenInfo;
use Illuminate\Support\Facades\Auth;
use Datatables;
use Response,Config;
use Carbon\Carbon;
use DateTime;
use App\Notifications\TaskCompleted;
use Illuminate\Support\Facades\Notification;
use App\Listeners\SendComplainNotification;

class FeedbackController extends Controller
{
    public function addfeedback()
    {
        return view('feedback.add-feedback');
    }


    public function submitfeedback(Request $request)
   {
       
        $this->validate($request, [
    
            'feedback'  => 'required|string|max:100',
            
            
        ]);

        Feedback::create([
           
           'feedback' => $request->get('feedback'),
           
         
       ]);

     

       return Redirect::to('all-feedback')->with('success','Religion added Successfully to Religion Master!');
   }


   public function viewallfeedback(Request $request)
   {

    
        $feedback = Feedback::get();
            
        return view('feedback.view-feedback',compact('feedback',));
   } 


   public function editfeedback($id)
   {
       $feedback = Feedback::findOrFail($id);

       return view('feedback.edit-feedback', compact('feedback') );
   }


   public function updatefeedback($id, Request $request)
   {
       
        $this->validate($request, [
 
        'feedback'  => 'required|string|max:100',
       
        
        ]);

       $feedback= Feedback::findOrFail($id);
       $feedback->update($request->all());
      
       return Redirect::back()->with('success','Feedback Successfully updated to Feedback Master!');
   }

   public function deletefeedback(Request $request,$id)
    {

        Feedback::where('id',$id)->delete();
        
        return Redirect::back();
    }





    //employee feedback function start

    public function givefeedback()
    {
        //$employee = Employee::get(); 
        $currentuserid = Auth::user()->id;

        $emp_id = User::where('id',$currentuserid)->value('emp_id');
        $currentdesigid = Employee::where('azhrms_employee.id',$emp_id)->value('designation');

        $role_hierarchy = Role::where('azhrms_user_role.id',$currentdesigid)->value('role_hierarchy');
   

        $employee= DB::table('azhrms_employee')-> join('azhrms_user_role', 'azhrms_employee.designation', '=', 'azhrms_user_role.id')
        ->select('azhrms_employee.emp_nick_name','azhrms_employee.id as id')
        ->where('azhrms_user_role.role_hierarchy','>',$role_hierarchy)
        ->get();

        $feedbackcategory = Feedback::get();
        return view('feedback.add-employee-feedback',compact('employee','feedbackcategory'));
    }

    public function submitemployeefeedback(Request $request)
    {
        
     $this->validate($request, [
  
         'feedback_to_id'  => 'required',
         'feedback_category'  => 'required',
         'feedback_type'  => 'required',
       
     ]);
    
     $currentuserid = Auth::user()->id;
 
     $emp_id = User::where('id',$currentuserid)->value('emp_id');
 
     EmployeeFeedback::create([
            
            'feedback_type' => $request->get('feedback_type'),
            'feedback_category' => $request->get('feedback_category'),
            'feedback_to_id' => $request->get('feedback_to_id'),
            'feedback_comment' => $request->get('feedback_comment'),
            'emp_id' => $emp_id,
 
          
                   
        ]);
 
        //$user = User::find(1);

       // User::find(1)->notify(new TaskCompleted($user));
       $feedback_id = $request->get('feedback_to_id');
       $emp_id = User::where('emp_id',$feedback_id)->value('id');
                $emp = User::find($emp_id);

        $admins = User::find(1);

                Notification::send($admins, new TaskCompleted($admins));
                Notification::send($emp, new TaskCompleted($emp));

 
        return Redirect::back()->with('success',' Feedback Submitted Successfully!');
    }


    public function viewallemployeefeedback(Request $request)
   {

    $currentuserid = Auth::user()->emp_id;

    $emp_comp_id = Employee::where('azhrms_employee.id',$currentuserid)->value('operational_company_id');

    $comp_id = CompanyGenInfo::where('azhrms_company_gen_info.id',$emp_comp_id)->value('id');


    if(Auth::user()->role=='1') {

    $feedback = DB::table('azhrms_employee_feedback')->select(
        'azhrms_employee.emp_nick_name','azhrms_employee.emp_code','users.name',


        'azhrms_employee_feedback.id as id','feedback_comment','feedback_to_id',

        'feedback_type','feedback_category','feedback_category.feedback','azhrms_employee_feedback.created_at')->
        join('feedback_category', 'azhrms_employee_feedback.feedback_category', '=', 'feedback_category.id')->
        join('azhrms_employee', 'azhrms_employee_feedback.feedback_to_id', '=', 'azhrms_employee.id')->
        join('users', 'azhrms_employee_feedback.emp_id', '=', 'users.emp_id')->
            
        get();

    }
    else{

        $feedback = DB::table('azhrms_employee_feedback')->select(
            'azhrms_employee.emp_nick_name','azhrms_employee.emp_code','users.name',
    
    
            'azhrms_employee_feedback.id as id','feedback_comment','feedback_to_id',
    
            'feedback_type','feedback_category','feedback_category.feedback','azhrms_employee_feedback.created_at')->
            join('feedback_category', 'azhrms_employee_feedback.feedback_category', '=', 'feedback_category.id')->
            join('azhrms_employee', 'azhrms_employee_feedback.feedback_to_id', '=', 'azhrms_employee.id')->
            join('users', 'azhrms_employee_feedback.emp_id', '=', 'users.emp_id')->
            where('azhrms_employee.operational_company_id',$comp_id)   
            ->get();
        }  
        return view('feedback.view-all-employee-feedback',compact('feedback',));
   } 
    
}
