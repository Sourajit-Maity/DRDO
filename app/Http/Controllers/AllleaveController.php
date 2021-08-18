<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LeavePeriodHistory;
use App\Models\LeaveType;
use App\Models\Employee;
use App\Models\LeaveEntitlement;
use App\Models\EmployeeType;
use App\Models\User;
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




use App\Models\Leave;


use App\Http\Requests\LeaveRequest;
use App\Rules\MatchOldPassword;
use App\Models\Feedback;
use App\Models\EmployeeFeedback;
use App\Models\Complain;
use App\Models\CompanyGenInfo;
use App\Notifications\LeaveNotification;
use App\Listeners\SendComplainNotification;
use Illuminate\Support\Facades\Notification;


class AllleaveController extends Controller
{
    public function allleave()
    {
        return view('totalleave.index');
    }


    public function viewleaves(Request $request)
   {

    $currentuserid = Auth::user()->id;

        $emp_id = User::where('id',$currentuserid)->value('emp_id');

        $emp_comp_id = Employee::where('azhrms_employee.id',$emp_id)->value('operational_company_id');

        $comp_id = CompanyGenInfo::where('azhrms_company_gen_info.id',$emp_comp_id)->value('id');

        $user = Auth::user();
      

       if(Auth::user()->role=='1') {
        $leaveentitlement = DB::table('leaves')
        ->select('emp_id','no_of_days','leave_type_id','leave_type','date_from','azhrms_employee.emp_nick_name','reason','leaves.id as id','azhrms_leave_type.name','date_to','days','leave_type_offer','is_approved',)
        ->join('azhrms_leave_type','leaves.leave_type','=','azhrms_leave_type.id')
        ->join('azhrms_leave_entitlement','leaves.leave_type','=','azhrms_leave_entitlement.leave_type_id')
        ->join('azhrms_employee','leaves.emp_id','=','azhrms_employee.id')
        ->where('leaves.leave_type_offer',1)
        ->paginate(10);
       
    }
    else{
        $leaveentitlement = DB::table('leaves')
        ->select('emp_id','no_of_days','leave_type_id','leave_type','date_from','azhrms_employee.emp_nick_name','reason','leaves.id as id','azhrms_leave_type.name','date_to','days','leave_type_offer','is_approved',)
        ->join('azhrms_leave_type','leaves.leave_type','=','azhrms_leave_type.id')
        ->join('azhrms_leave_entitlement','leaves.leave_type','=','azhrms_leave_entitlement.leave_type_id')
        ->join('azhrms_employee','leaves.emp_id','=','azhrms_employee.id')
        ->where('azhrms_employee.operational_company_id',$comp_id)
        ->where('leaves.leave_type_offer',1)
        ->paginate(10); 
    }
       
      
     
      return view('totalleave.allleave',compact('leaveentitlement',));
   } 
}
