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
use App\Models\EmployeeEducation;
use App\Models\EmployeeType;
use App\Models\User; 
use App\Models\CompanyLocation;
use App\Models\Assets;
use App\Models\EmployeeAssets;
use App\Models\Workshift;
use App\Models\EmployeePromotion;
use App\Models\EmployeeSalary;
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
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\File;
use App\Notifications\AssetsNotification;
use App\Notifications\AssetsReturnNotification;
use App\Notifications\TaskCompleted;
use Illuminate\Support\Facades\Notification;
use App\Listeners\SendComplainNotification;

class AllDocController extends Controller
{
    public function viewalldoc()
    {
       

        return view('alldoc.view-all-doc');
    }

    public function viewpandoc()
    {
        $currentuserid = Auth::user()->emp_id;

        $pandoc= Employee::where('azhrms_employee.id', $currentuserid)->first();

        return view('alldoc.view-pan-doc',compact('pandoc'));
    }

    public function viewblooddoc()
    {
        $currentuserid = Auth::user()->emp_id;

        $blooddoc= Employee::where('azhrms_employee.id', $currentuserid)->first();

        return view('alldoc.view-blood-doc',compact('blooddoc'));
    }

    public function viewpromotiondoc()
    {
        $currentuserid = Auth::user()->emp_id;

        $promotiondoc= EmployeePromotion::where('azhrms_employee_promotion.emp_id', $currentuserid)->first();

        return view('alldoc.view-promotion-doc',compact('promotiondoc'));
    }

    public function viewedudoccertificate()
    {
        $currentuserid = Auth::user()->emp_id;

        $edudoc= EmployeeEducation::where('azhrms_employee_edu_details.emp_id', $currentuserid)->get();

        return view('alldoc.view-edu-doc-certificate',compact('edudoc'));
    }
}
