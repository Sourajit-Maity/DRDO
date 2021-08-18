<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Models\SubRole;
use App\Models\CompanyGenInfo;
use App\Models\Employee;
use App\Models\EmployeeType;
use App\Models\User; 
use App\Models\CompanyLocation;
use App\Models\Assets;
use App\Models\EmployeeAssets;
use App\Models\TeamHandover;
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
use App\Models\Role;
use App\Models\File;
use Illuminate\Support\Facades\Notification;


class TeamHandoverController extends Controller
{
    public function addteamhandover()
    {
       $employee = Employee::get(); 
      return view('teamhandover.addteamhandover',compact('employee'));
    }

    
    public function submitteamhandover(Request $request)
   {
       
    $this->validate($request, [
 
        'handover_emp_id'  => 'required|string|max:120',
        'emp_id'  => 'required',
        'handover_reason'  => 'required',
        'handover_from_date'  => 'required',
        'handover_to_date'  => 'required',
      
    ]);
   

    TeamHandover::create([
           
           'handover_emp_id' => $request->get('handover_emp_id'),
           'emp_id' => $request->get('emp_id'),
           'handover_reason' => $request->get('handover_reason'),
           'handover_from_date' => $request->get('handover_from_date'),
           'handover_to_date' => $request->get('handover_to_date'),

         
                  
       ]);

     

       return Redirect::to('view-teamhandover')->with('success',' Created Successfully!');
   }



   public function viewteamhandover(Request $request)
   {

    
       $type = TeamHandover::select('team_handover.id as id','handover_emp_id','team_handover.emp_id','handover_reason',
       'handover_reason','handover_from_date','handover_to_date','azhrms_employee.emp_nick_name','users.name',)
        ->join('azhrms_employee', 'team_handover.emp_id', '=', 'azhrms_employee.id')
        ->join('users', 'team_handover.handover_emp_id', '=', 'users.emp_id')->get();

      return view('teamhandover.viewteamhandover',compact('type',));
   } 


   public function editteamhandover($id)
   {

    $type = TeamHandover::findOrFail($id);

    $employee = Employee::get(); 

    $oldemployee= TeamHandover::select('azhrms_employee.emp_nick_name as nick_name','team_handover.emp_id as emp')->
    join('azhrms_employee', 'team_handover.emp_id', '=', 'azhrms_employee.id')
    ->where('team_handover.id',$id)->get();  

    $olduser= TeamHandover::select('users.name as user_name','team_handover.handover_emp_id as handover_id')->
    join('users', 'team_handover.handover_emp_id', '=', 'users.emp_id')
    ->where('team_handover.id',$id)->get();

     return view('teamhandover.editteamhandover',compact('type','employee','oldemployee','olduser'));
   }


   public function updateteamhandover($id, Request $request)
   {
    $this->validate($request, [
 
        'handover_emp_id'  => 'required|string|max:120',
        'emp_id'  => 'required',
        'handover_reason'  => 'required',
        'handover_from_date'  => 'required',
        'handover_to_date'  => 'required',
      
    ]);
    

       $type= TeamHandover::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deleteteamhandover(Request $request,$id)
    {

        TeamHandover::where('id',$id)->delete();
        
        return Redirect::back();
    }
}
