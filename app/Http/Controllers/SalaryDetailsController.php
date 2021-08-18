<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Models\LeavePeriodHistory;
use App\Models\LeaveType;
use App\Models\WorkWeek;
use App\Models\Skills;
use App\Models\SubRole;
use App\Models\CompanyGenInfo;
use App\Models\EmployeeLanguage;
use App\Models\Employee;
use App\Models\LeaveEntitlement;
use App\Models\EmployeeSkillGrade;
use App\Models\EmployeeSkills;
use App\Models\BankMaster;
use App\Models\EmployeeType;
use App\Models\User; 
use App\Models\CRM; 
use App\Models\CompanyLocation;
use App\Models\Assets;
use App\Models\EmployeeAssets;
use App\Models\Workshift;
use App\Models\EmployeePromotion;
use App\Models\EmployeeSalary;
use App\Models\SalaryDetails;
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
use PDF;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\File;
use App\Notifications\EmployeeSalaryNotification;
use Illuminate\Support\Facades\Notification;
use App\Listeners\SendComplainNotification; 

class SalaryDetailsController extends Controller
{
    public function viewsalarydetails(Request $request)
    {
 
        $salarydetails = DB::table('azhrms_employee_salary')->select('azhrms_employee_salary.emp_id as id','azhrms_employee_salary.emp_id','committed_amount','ctc_per_month','esi_number','pf_uan_no',
        'pf_no','ctc_per_annum','payroll_org','pf_effective_date','azhrms_employee.emp_nick_name','azhrms_employee.emp_img',)
        ->join('azhrms_employee', 'azhrms_employee_salary.emp_id', '=', 'azhrms_employee.id')
        ->get();
         
        $banks= BankMaster::get();
 
       return view('salary.viewsalarydetails',compact('salarydetails','banks'));
    } 

    public function storesalarydetails($id, Request $request)
    {
        $this->validate($request, [
 
            'paid_amount'  => 'required',
            'salary_for_month'  => 'required',
            'payment_bank'  => 'required',
            'salary_status'  => 'required',
          
        ]);

        $date = Carbon::today();

        Log::debug("salary".print_r($request->all(),true));
        Log::debug("id".print_r($id,true));
 
        $salary = new SalaryDetails();

                $salary->paid_amount = $request->get('paid_amount');
                $salary->payment_date = $date;
                $salary->salary_for_month = $request->get('salary_for_month');
                $salary->salary_status = $request->get('salary_status');
                $salary->remarks = $request->get('remarks');
                $salary->payment_bank = $request->get('payment_bank');
                $salary->due = $request->get('due');
                $salary->emp_id = $id;
                $salary->salary_issuer_id = Auth::user()->id;

                $salary->save();

                $emp_id = User::where('emp_id',$id)->value('id');
                $emp = User::find($emp_id);
                $admins = User::find(1);
                $issuerid = Auth::user()->id;

                $issuer = User::find($issuerid);

                Notification::send($admins, new EmployeeSalaryNotification($admins)); 
                Notification::send($issuer, new EmployeeSalaryNotification($issuer)); 
                Notification::send($emp, new EmployeeSalaryNotification($emp));  

               // $pdf = PDF::loadView('salary.salaryPDF');
               // Session::flash('Salary given successfully');
               // return $pdf->download('payslip.pdf');
          
           
            return Redirect::back()->with('success','Successfully Salaray Submitted!');
    } 

    public function viewallsalary(Request $request)
    {
 
        $allsalary = DB::table('salary_details')->select('salary_details.id as id','salary_details.emp_id','salary_for_month','salary_status','remarks',
       'payment_date','salary_issuer_id','paid_amount','due','azhrms_employee.emp_nick_name','users.name',)
        ->join('azhrms_employee', 'salary_details.emp_id', '=', 'azhrms_employee.id')
        ->join('users', 'salary_details.salary_issuer_id', '=', 'users.id')
        ->get();
 
        return view('salary.viewallsalary',compact('allsalary',));
    } 


    public function addsalary()
    {
        $employee = Employee::get(); 
        $crm = CRM::get();
        $bank = BankMaster::get();
        return view('salary.addsalary',compact('employee','crm','bank'));
    }


    public function submitsalary(Request $request)
   {

    $request->validate([
        'moreFields.*.paid_amount' => 'required',
        'moreFields.*.payment_date' => 'required',
        'moreFields.*.salary_for_month' => 'required',
        'moreFields.*.remarks' => 'required',
        'moreFields.*.payment_bank' => 'required',
        'moreFields.*.due' => 'required',
        'moreFields.*.emp_id' => 'required',
        'moreFields.*.salary_issuer_id' => 'required',
    ]); 
      

        foreach ($request->moreFields as $key => $value) {
            SalaryDetails::create($value);
        }
     
        return Redirect::back()->with('success', 'Salary Disbursed Successfully.');
      
  
   }

   public function getsalary($id) 
    {
        $salary= DB::table("azhrms_employee_salary")->where("emp_id",$id)->get();
        return json_encode($salary);
    }

    public function getdue($id) 
    {
        $jobrole = DB::table("azhrms_user_role_categories")->where("role_id",$id)->pluck("respname","id");
        return json_encode($jobrole);
    }
}
