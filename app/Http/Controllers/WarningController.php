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

class WarningController extends Controller
{
    public function viewallwarning(Request $request)
    {
     $currentuserid = Auth::user()->emp_id;
 
     $emp_comp_id = Employee::where('azhrms_employee.id',$currentuserid)->value('operational_company_id');
 
     $comp_id = CompanyGenInfo::where('azhrms_company_gen_info.id',$emp_comp_id)->value('id');
 
 
     if(Auth::user()->role=='1') {
        $warning= DB::table('azhrms_employee_warning')
        ->select('emp_id','warning_emp_name','issuer_name','azhrms_employee_warning.id as id',
        'warning_header','reason','date','azhrms_employee.emp_nick_name')

        ->join('azhrms_employee','azhrms_employee_warning.emp_id','=','azhrms_employee.id')
        ->get();
     }
     else{
        $warning= DB::table('azhrms_employee_warning')
        ->select('emp_id','warning_emp_name','issuer_name','azhrms_employee_warning.id as id',
        'warning_header','reason','date','azhrms_employee.emp_nick_name')

        ->join('azhrms_employee','azhrms_employee_warning.emp_id','=','azhrms_employee.id')
        ->where('azhrms_employee.operational_company_id',$comp_id)
        ->get();
     }
       return view('warning.viewemployeewarning',compact('warning',));
    } 
}
