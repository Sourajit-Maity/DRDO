<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\CompanyGenInfo;
use App\Models\EmployeeLanguage;
use App\Models\Employee;
use App\Models\Usermanagement;
use App\Models\FamilyNominations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Datatables;
use Response,Config;
use App\Models\LeavePeriodHistory;
use App\Models\LeaveType;
use App\Models\WorkWeek;
use App\Models\Skills;
use App\Models\LeaveEntitlement;
use App\Models\EmployeeSkillGrade;
use App\Models\EmployeeSkills;
use App\Models\EmployeeEducation;
use App\Models\EmployeeType;
use App\Models\EmployeeFamilyDetails;
use App\Models\EmployeeAssets;
use App\Models\Workshift;
use App\Models\EmployeePromotion;
use App\Models\EmployeeSalary;
use App\Models\EmployeeBankDetails;
use Illuminate\Support\Facades\Auth;
use App\Notifications\JoiningNotification;
use Illuminate\Support\Facades\Notification;
use App\Listeners\SendNewUserNotification;



class UsermanagementController extends Controller
{
    public function addUser()

   {
    $roles= DB::table('azhrms_user_role')->get();
    $company= CompanyGenInfo::where('azhrms_company_gen_info.deleted_at', null)->pluck("c_name","id");
    
    
       return view('usermanagement.adduser',compact('roles','company'));
   }

   public function registerUser(Request $request)
   {
       $this->validate($request, [

           'name'  => 'required|string|max:120|unique:users',
           'role'  => 'required',
           'operational_company_id'  => 'required',
           'email'  => 'required|email|unique:users',
           'password' => 'required|string|min:8|confirmed'
       ]);
 
       DB::beginTransaction();

                    try {
            $company = CompanyGenInfo::where('id',$request->operational_company_id)->first();
            // $newemp = Employee::where('operational_company_id',$request->operational_company_id)->get();
            // $nubrow=count($newemp)+1;
            // if($nubrow <10){
            //     $emp_code = $company->res_company_name.'-'.date('Y').'-'."00".$nubrow;
            // }
            // elseif($nubrow >=10 && $nubrow<=99){
            //  $emp_code = $company->res_company_name.'-'.date('Y').'-'."0".$nubrow;
            // }
            // elseif($nubrow <=100){
            //  $emp_code = $company->res_company_name.'-'.date('Y').'-'.$nubrow;
            // }

            $emp_code = $request->get('emp_code');

        $employee = new Employee();
        $employee->designation= $request->get('role');
        $employee->emp_work_email= $request->get('email');
        $employee->emp_nick_name= $request->get('name');
        $employee->operational_company_id= $request->get('operational_company_id');
        $employee->emp_code=  'CAS'.'-'.$emp_code;
        
        $employee->save();
 
        $user= new User();
        $user->emp_id = $employee->id;
        $user->name= $request->get('name');
        $user->email= $request->get('email');
        $user->role= $request->get('role');
        $user->password = bcrypt($request->get('password'));
        $user->save();

        $education = new EmployeeEducation();
        $education->emp_id = $employee->id;
        $education->save();

        $skills = new EmployeeSkills();
        $skills->emp_id = $employee->id;
        $skills->save();

        $bankdetails = new EmployeeBankDetails();
        $bankdetails->emp_id = $employee->id;
        $bankdetails->save();

        $language = new EmployeeFamilyDetails();
        $language->emp_id = $employee->id;
        $language->save();

        //$nomini = new FamilyNominations();
       // $nomini->emp_id = $employee->id;
        //$nomini->save();

        $salary= new EmployeeSalary();
        $salary->emp_id = $employee->id;
        $salary->save();

        $assets = new EmployeeAssets();
        $assets->emp_id = $employee->id;
        $assets->save();

        $promotion = new EmployeePromotion();
        $promotion->emp_id = $employee->id;
        $promotion->save();

        $admins = User::find(1);

        Notification::send($admins, new JoiningNotification($user)); 

        DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }

         


       return Redirect::to('view-user')->with('success','User Registered Successfully!');
   }

   public function viewUser(Request $request)
   {

    
    $currentuserid = Auth::user()->emp_id;

    $emp_comp_id = Employee::where('azhrms_employee.id',$currentuserid)->value('operational_company_id');

    $comp_id = CompanyGenInfo::where('azhrms_company_gen_info.id',$emp_comp_id)->value('id');

    if(Auth::user()->role=='1') {
       $users = DB::table('users')
       ->select('emp_id','email','users.name as u_name','role','azhrms_user_role.name as r_name','azhrms_user_role.display_name','users.id as id')
       ->join('azhrms_user_role','users.role','=','azhrms_user_role.id')
       ->get();
    }
    else{
        $users = DB::table('users')
       ->select('emp_id','email','users.name as u_name','role','azhrms_user_role.name as r_name','azhrms_user_role.display_name','users.id as id')
       ->join('azhrms_user_role','users.role','=','azhrms_user_role.id')
       ->join('azhrms_employee','users.emp_id','=','azhrms_employee.id')
       ->where('azhrms_employee.operational_company_id',$comp_id)
       ->get();
    }
       
       $roles= DB::table('azhrms_user_role')->get();
           
           
       return view('usermanagement.viewuser',compact('users','roles',));
   }



   public function usersList()
    {   
        $usersQuery = User::query();
 
        $user_id = (!empty($_GET["user_id"])) ? ($_GET["user_id"]) : ('');
        $name = (!empty($_GET["name"])) ? ($_GET["name"]) : ('');
 
        if($user_id & $name){
     
         $user_id = date('Y-m-d', strtotime($user_id));
         $name = date('Y-m-d', strtotime($name));
          
         $usersQuery->whereRaw("(users.user_id) = '" . $user_id . "' AND (users.name) = '" . $name . "'");
        }
        $users = $usersQuery->select('*');
        return datatables()->of($users)
            ->make(true);
    }


   public function deleteuser(Request $request,$id)
    {

        User::where('id',$id)->delete();
        
        return Redirect::back();
    }
    function Conform_Delete()
    {
        return confirm("Are You Sure Want to Delete?");

    }

    public function edituser($id)

    {
        $currentuserid = $id;

        $emp_id = User::where('id',$currentuserid)->value('emp_id');

        $company= DB::table('azhrms_company_gen_info')->where('azhrms_company_gen_info.deleted_at', null)->pluck("c_name","id");
        $empcompany= DB::table('azhrms_employee')->select('azhrms_company_gen_info.c_name as company_name','azhrms_employee.operational_company_id as operational_company')->
        join('azhrms_company_gen_info', 'azhrms_employee.operational_company_id', '=', 'azhrms_company_gen_info.id')
        ->where('azhrms_employee.id',$emp_id)->get(); 
         
        $roles= DB::table('azhrms_user_role')->get();
        $users= DB::table('users')->get();
        
        $emprole= DB::table('users')->select('azhrms_user_role.name as role_name','users.role as designation_id')->
        join('azhrms_user_role', 'users.role', '=', 'azhrms_user_role.id')
        ->where('users.id',$id)->get();

        $users = User::findOrFail($id);
 
        return view('usermanagement.edituser', compact('users','empcompany','company','emprole','roles') );
    }
 
 
    public function updateuser($id, Request $request)
    {
        $this->validate($request, [

            'name'  => 'required|string|max:120',
            'role'  => 'required',
            'emp_id'  => 'required',
            'operational_company_id'  => 'required',
            'email'  => 'required',
            
        ]);
        $currentuserid = $id;

        $emp_id = User::where('id',$currentuserid)->value('emp_id');

        DB::beginTransaction();

                    try {

 
        $user= User::findOrFail($id);
        $user->emp_id = $request->get('emp_id');;
        $user->name= $request->get('name');
        $user->email= $request->get('email');
        $user->role= $request->get('role');
        $user->update();



        $user_id=  Employee::where('id',$emp_id)->value('id');
        $employee =Employee::findOrFail($user_id);
        $employee->designation= $request->get('role');
        $employee->emp_work_email= $request->get('email');
        $employee->emp_nick_name= $request->get('name');
        $employee->operational_company_id= $request->get('operational_company_id');
                
        $employee->update();
        DB::commit();
              
    } 
    catch (\Exception $e) {
        DB::rollback();
        
    }
        return Redirect::to('view-user')->with('success','Successfully Updated!');
    }

    public function updatePass($id,Request $request)
    {
        
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        //dd('Password change successfully.');
        return Redirect::to('view-user'); 
    }

}
