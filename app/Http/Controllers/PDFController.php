<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Myinfo;
use App\Models\LeavePeriodHistory;
use App\Models\EmployeeWarning;
use App\Models\WorkWeek;
use App\Models\Skills;
use App\Models\Employee;
use App\Models\LeaveEntitlement;
use App\Models\EmployeeSkillGrade;
use App\Models\EmployeeSkills;
use App\Models\EmployeeEducation; 
use App\Models\User;
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

class PDFController extends Controller
{
    public function generatePDF()
    {
        $data = [
            'title' => 'Welcome to AZHRMS',
            'date' => date('m/d/Y')
        ];
          
        $pdf = PDF::loadView('myPDF', $data);
    
        return $pdf->download('hrms.pdf');
    }

    public function addwarning()
    {
        
        $user= DB::table('azhrms_employee')->get();
        
     
        return view('warning.addwarning',compact('user',));
    }


    public function warninggenerate(Request $request)
    {
        $this->validate($request, [
 
            'warning_header'  => 'required',
            'emp_id'  => 'required',
            'reason'  => 'required|max:5000', 

        ]);

        $warning_emp_id = $request->get('emp_id');
        $warning_emp_name = Employee::where('id',$warning_emp_id)->value('emp_nick_name');

        $date = Carbon::today();
        $currentuserid = Auth::user()->id;
        $currentusername = Auth::user()->name;

        $arrcurrentusername = explode(',',$currentusername);

        $issuer_id = User::where('id',$currentuserid)->value('emp_id');
        $emp_name = 
        $data = new EmployeeWarning();

        $data->warning_header	= $request->get('warning_header');
        $data->emp_id= $request->get('emp_id');
        $data->reason= $request->get('reason');
        $data->warning_emp_name= $warning_emp_name;  
        $data->issuer_name= $currentusername;
        $data->warning_given_id=  $issuer_id ;
        $data->date= $date;

        $data->save();
          
        $pdf = PDF::loadView('warning.warningPDF', $data,$arrcurrentusername);
        Session::flash('warning given successfully');
        return $pdf->download('hrms.pdf');
        //Session::flash('download.in.the.next.request', 'hrms.pdf');

        return Redirect::back()->with('success','warning given successfully');
            
    }
}
