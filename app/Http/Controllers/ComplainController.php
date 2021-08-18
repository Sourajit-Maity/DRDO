<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rules\MatchOldPassword;
use App\Models\Complain;
use App\Models\User;
use App\Models\Employee;
use App\Models\Role;
use App\Models\CompanyGenInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Datatables;
use Response,Config;
use Carbon\Carbon;
use DateTime;
use App\Notifications\ComplainNotification;
use App\Notifications\TaskCompleted;
use Illuminate\Support\Facades\Notification;
use App\Listeners\SendComplainNotification;

class ComplainController extends Controller
{
    public function addcomplain()
    {

        $designation= Role::get();
        $employee = Employee::get();
       
      return view('complain.addcomplain',compact('designation','employee'));
    }

    public function getcomplainuser($id) 
    {
        $unit= DB::table("azhrms_employee")->where("designation",$id)->get();
        return json_encode($unit);
    }

    public function getcomplainuserimage($id) 
    {
        $unit= DB::table("azhrms_employee")->where("id",$id)->get();
        return json_encode($unit);
    }


    public function submitcomplain(Request $request)
   {
       
    $this->validate($request, [
 
        'complain'  => 'required|string',
        'notes'  => 'required|string',
        'complain_against_id' => 'required',
      
    ]);
   
    $currentuserid = Auth::user()->id;

    $emp_id = User::where('id',$currentuserid)->value('emp_id');

    Complain::create([
           
           'complain' => $request->get('complain'),
           'notes' => $request->get('notes'),
           'emp_id' => $emp_id,
           'complain_against_id' => $request->get('complain_against_id'),

         
                  
       ]);

       Log::debug("all".print_r($request->all(),true));
      // $admins = User::find(1);

      //  Notification::send($admins, new ComplainNotification($user)); 
        $user = User::find(1);

        User::find(1)->notify(new ComplainNotification($user));

     

       return Redirect::back()->with('success',' Complain Submitted Successfully!');
   }



   public function viewcomplain(Request $request)
   {

    
       

       $currentuserid = Auth::user()->emp_id;

       $emp_comp_id = Employee::where('azhrms_employee.id',$currentuserid)->value('operational_company_id');
   
       $comp_id = CompanyGenInfo::where('azhrms_company_gen_info.id',$emp_comp_id)->value('id');
   
       
   
   
       //Log::debug("ids".print_r($comp_id,true));
       if(Auth::user()->role=='1') {
   
          $complain = DB::table('azhrms_complain')->select('complain','azhrms_complain.created_at',
          'notes','users.name','azhrms_complain.id as id','azhrms_employee.emp_nick_name')
          ->join('azhrms_employee','azhrms_complain.complain_against_id','=','azhrms_employee.id')
          ->join('users','azhrms_complain.emp_id','=','users.emp_id')
          ->where('azhrms_complain.deleted_at','=',null)
          ->get(); 
       }
       else{
        $complain = DB::table('azhrms_complain')->select('complain','azhrms_complain.created_at','azhrms_employee.emp_nick_name',
        'notes','users.name','azhrms_complain.id as id')
  
        ->join('users','azhrms_complain.emp_id','=','users.emp_id')
        ->join('azhrms_employee','azhrms_complain.complain_against_id','=','azhrms_employee.id')
           ->where('azhrms_employee.operational_company_id',$comp_id)
           ->where('azhrms_complain.deleted_at','=',null)
           ->get(); 
       }

      return view('complain.viewcomplain',compact('complain',));
   } 

}
