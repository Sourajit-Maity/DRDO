<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LeaveRequest;
use App\Rules\MatchOldPassword;
use App\Models\Feedback;
use App\Models\EmployeeFeedback;
use App\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Complain;
use App\Models\Employee;
use App\Models\CompanyGenInfo;
use Illuminate\Support\Facades\Auth;
use Datatables;
use Response,Config;
use Carbon\Carbon;
use DateTime;
use App\Notifications\LeaveNotification;
use App\Listeners\SendComplainNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LeaveApprove;




class LeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function index()
    {
        $currentuserid = Auth::user()->id;

        $emp_id = User::where('id',$currentuserid)->value('emp_id');
      

        $emp_comp_id = Employee::where('azhrms_employee.id',$emp_id)->value('operational_company_id');

        $comp_id = CompanyGenInfo::where('azhrms_company_gen_info.id',$emp_comp_id)->value('id');

        $user = Auth::user();

        

        
        if(Auth::user()->role=='1') {
            $leaves = DB::table('leaves')
            ->select('emp_id','leave_type','date_from','azhrms_employee.emp_nick_name','reason','leaves.id as id','azhrms_leave_type.name','date_to','days','leave_type_offer','is_approved',)
            
            ->join('azhrms_leave_type','leaves.leave_type','=','azhrms_leave_type.id')
            ->join('azhrms_employee','leaves.emp_id','=','azhrms_employee.id')
            ->paginate(10);
           // $leaves = Leave::paginate(5);
        }
        elseif(Auth::user()->role=='2') {
            $leaves = DB::table('leaves')
            ->select('emp_id','leave_type','date_from','azhrms_employee.emp_nick_name','reason','leaves.id as id','azhrms_leave_type.name','date_to','days','leave_type_offer','is_approved',)
            
            ->join('azhrms_leave_type','leaves.leave_type','=','azhrms_leave_type.id')
            ->join('azhrms_employee','leaves.emp_id','=','azhrms_employee.id')
            ->where('azhrms_employee.operational_company_id',$comp_id)
            ->paginate(10);
           // $leaves = Leave::paginate(5); 
        }
        elseif(Auth::user()->role=='3') {
            $leaves = DB::table('leaves')
            ->select('emp_id','leave_type','date_from','azhrms_employee.emp_nick_name','reason','leaves.id as id','azhrms_leave_type.name','date_to','days','leave_type_offer','is_approved',)
            
            ->join('azhrms_leave_type','leaves.leave_type','=','azhrms_leave_type.id')
            ->join('azhrms_employee','leaves.emp_id','=','azhrms_employee.id')
            ->where('azhrms_employee.operational_company_id',$comp_id) 
            ->where('leaves.emp_id',$emp_id)
            ->paginate(10);
           // $leaves = Leave::paginate(5);
        }
        elseif(Auth::user()->role=='4') {
            $leaves = DB::table('leaves')
            ->select('emp_id','leave_type','date_from','azhrms_employee.emp_nick_name','reason','leaves.id as id','azhrms_leave_type.name','date_to','days','leave_type_offer','is_approved',)
            
            ->join('azhrms_leave_type','leaves.leave_type','=','azhrms_leave_type.id')
            ->join('azhrms_employee','leaves.emp_id','=','azhrms_employee.id')
            ->where('azhrms_employee.operational_company_id',$comp_id)
            ->where('leaves.emp_id',$emp_id)
            ->paginate(10);
           // $leaves = Leave::paginate(5);
        }
        elseif(Auth::user()->role=='5') {
            $leaves = DB::table('leaves')
            ->select('emp_id','leave_type','date_from','azhrms_employee.emp_nick_name','reason','leaves.id as id','azhrms_leave_type.name','date_to','days','leave_type_offer','is_approved',)
            
            ->join('azhrms_leave_type','leaves.leave_type','=','azhrms_leave_type.id')
            ->join('azhrms_employee','leaves.emp_id','=','azhrms_employee.id')
            ->where('azhrms_employee.operational_company_id',$comp_id)
            ->where('leaves.emp_id',$emp_id)
            ->paginate(10);
           // $leaves = Leave::paginate(5);
        }
     

        else{
            $leaves =  DB::table('leaves')
            ->select('emp_id','leave_type','date_from','azhrms_employee.emp_nick_name','reason','leaves.id as id','azhrms_leave_type.name','date_to','days','leave_type_offer','is_approved',)
            
            ->join('azhrms_leave_type','leaves.leave_type','=','azhrms_leave_type.id')
            ->join('azhrms_employee','leaves.emp_id','=','azhrms_employee.id')
             ->where('leaves.emp_id',$emp_id)->paginate(10);
            
        }
//        $user = Auth::user();
        return view('leave.index',compact('leaves','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leavetype= DB::table('azhrms_leave_type')->get();
        $currentuserid = Auth::user()->emp_id;

        $myprofile= Employee::select('emp_status','joined_date','emp_street2','azhrms_employee_type.emp_type_name',
        'emp_nick_name','operational_company_id','azhrms_company_location_department.phone','emp_code','azhrms_employee_salary.committed_amount',
        'azhrms_employee.operational_company_location_id', 'azhrms_employee.operational_company_loc_dept_id','users.name',
        'azhrms_company_location_department.d_name','azhrms_user_role.display_name','emp_mobile',
        'reporting_to','shift','designation','job_role','azhrms_employee.id as id','emp_hm_telephone')->

        join('azhrms_employee_type', 'azhrms_employee.emp_status', '=', 'azhrms_employee_type.id')->
        join('azhrms_company_location_department', 'azhrms_employee.operational_company_loc_dept_id', '=', 'azhrms_company_location_department.id')->
        join('azhrms_user_role', 'azhrms_employee.designation', '=', 'azhrms_user_role.id')->
        join('azhrms_employee_salary', 'azhrms_employee.id', '=', 'azhrms_employee_salary.emp_id')->
        join('users', 'azhrms_employee.reporting_to', '=', 'users.emp_id')->
            where('azhrms_employee.id',$currentuserid)
            ->first();
        return view('leave.create',compact('leavetype','myprofile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeaveRequest $request)
    {

        $this->validate($request, [
            
            'leave_type'  => 'required',
            'date_from'  => 'required',
            'date_to'  => 'required', 
            'days'  => 'required',
            'reason'  => 'required',
            'designation_id'  => 'required',
            'leave_address'  => 'required',
            'phone_no' => 'required',
            'sunday_holiday' => 'required',
            'dept_phone_no'  => 'required',
            'dept_phone_no'  => 'required',
            'dept_id' => 'required',
            'emp_id' => 'required',
            'employee_type' => 'required',
        
    
        ]);
        DB::beginTransaction();

        try {
                $currentuserid = Auth::user()->id;

                $emp_id = User::where('id',$currentuserid)->value('emp_id');
                Leave::create([
                    'emp_id'   => $request->emp_id,
                    'leave_type'    => $request->leave_type,
                    'date_from'     => $request->date_from,
                    'date_to'       => $request->date_to,
                    'days'          => $request->days,
                    'reason'        => $request->reason,
                    'designation_id'    => $request->designation_id,
                    'leave_address'    => $request->leave_address,
                    'phone_no'     => $request->phone_no,
                    'sunday_holiday'       => $request->sunday_holiday,
                    'dept_phone_no'          => $request->dept_phone_no,
                    'dept_id'        => $request->dept_id,
                    'personal_id'        => $request->personal_id,
                    'employee_type' => $request->employee_type,


                ]);

                    $admins = User::find(1);

                    Notification::send($admins, new LeaveNotification($admins));

                    $id = $currentuserid;
                    $emp_user_id = User::where('emp_id',$emp_id)->value('id');
                    $applier = User::find($emp_user_id);
                    Notification::send($applier, new LeaveNotification($applier));  

            DB::commit();

            } 
            catch (\Exception $e) {
            DB::rollback();

            }


        return redirect()->route('leave')->with('success','You have successfully Applied.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
//        dd($request->all());
           // $leave = $request -> get('search');
            $leaves =Leave::where('leave_type', 'LIKE',"%{$request->search}%")->paginate();
            return view('leave.index',compact('leaves'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */

    public function approve(Request $request,$id)
    {

      //  dd($request->all());
        $leave = Leave::find($id);
//        dd($leave);
       if($leave){
           $leave->is_approved = $request -> approve;
           $leave->save();
           return redirect()->back();
       }
    } 

    public function paid(Request $request,$id)
    {

        $leaveid = $id;
        $empid = Leave::where('leaves.id', $id)->value('emp_id');
          
        $leave = Leave::find($id);
        if($leave){
            $leave->leave_type_offer = $request -> paid;
            $leave->save();

            $emp_user_id = User::where('emp_id',$empid)->value('id');
              $applier = User::find($emp_user_id);
            
               Notification::send($applier, new LeaveApprove($applier));
            return redirect()->back();
        }
    }


    public function viewleavedetails($id,Request $request)
     {
        $currentuserid = Auth::user()->id;
 
        $emp_id = User::where('id',$currentuserid)->value('emp_id');
      


      $leave = Leave::
           select('emp_id','date_from','azhrms_employee.emp_nick_name','reason','leaves.id as id','date_to','days','leave_type_offer','is_approved',
           'designation_id','employee_type','azhrms_employee_type.emp_type_name','leave_address','phone_no',
       'azhrms_user_role.display_name','personal_id','dept_id','dept_phone_no', 'sunday_holiday',
       'azhrms_company_location_department.d_name',
        'is_approved','date_from','date_to','days','reason','leave_type_offer',
        'azhrms_leave_type.name as leave_name' )->
        join('azhrms_company_location_department', 'leaves.dept_id', '=', 'azhrms_company_location_department.id')->

        join('azhrms_employee_type', 'leaves.employee_type', '=', 'azhrms_employee_type.id')->
        join('azhrms_user_role', 'leaves.designation_id', '=', 'azhrms_user_role.id')->
           join('azhrms_leave_type','leaves.leave_type','=','azhrms_leave_type.id')
           ->join('azhrms_employee','leaves.emp_id','=','azhrms_employee.id')
           ->findOrFail($id);

     
        
       Log::debug("leave".print_r($leave,true));
       
        return view('leave.viewleaveapplicationdetails',compact('leave'));
     }
}
