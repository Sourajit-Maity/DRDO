<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LeavePeriodHistory;
use App\Models\LeaveType;
use App\Models\WorkWeek;
use App\Models\Holiday;
use App\Models\LeaveEntitlement;
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


class EntitlementController extends Controller
{
    public function addleaveentitlement()
    {
        $leavetype= DB::table('azhrms_leave_type')->get();
        $employee= DB::table('azhrms_employee')->get();
        $leaveperiod= DB::table('azhrms_leave_period_history')->get();
        $company= DB::table('azhrms_company_gen_info')->where('deleted_at',null)->get();
        $companylocation= DB::table('azhrms_company_location')->get();
        
        
        return view('entitlement.addleaveentitlement',compact('leavetype','companylocation','company','leaveperiod','employee'));
    }

    
    public function submitleaveentitlement(Request $request)
   {
       
    $this->validate($request, [
 
        'company_id'  => 'required',
        'leave_type_id'  => 'required',
        'period'  => 'required',
        'no_of_days'  => 'required',
       
        
    ]);
    $user_id = Auth::user()->id;

    LeaveEntitlement::create([
           
           'company_id' => $request->get('company_id'),
           'no_of_days' => $request->get('no_of_days'), 
           'leave_type_id' => $request->get('leave_type_id'),
           'period' => $request->get('period'),
           'created_by_id' => $user_id,  
         
       ]);

     

       return Redirect::to('view-leave-entitlement')->with('success',' Created Successfully!');
   }



   public function viewleaveentitlement(Request $request)
   {

    
       $leaveentitlement = DB::table('azhrms_leave_entitlement')
       ->select('no_of_days','leave_period_start_date','c_name','azhrms_leave_entitlement.id as id','azhrms_leave_type.name','days_used','leave_type_id','period','company_id',)
       
       ->join('azhrms_leave_type','azhrms_leave_entitlement.leave_type_id','=','azhrms_leave_type.id')
       ->join('azhrms_company_gen_info','azhrms_leave_entitlement.company_id','=','azhrms_company_gen_info.id')
       ->join('azhrms_leave_period_history','azhrms_leave_entitlement.period','=','azhrms_leave_period_history.id')
       ->get();
       
      
     
      return view('entitlement.viewleaveentitlement',compact('leaveentitlement',));
   } 


   public function viewmyleaveentitlement(Request $request)
   {

    
       $myleaveentitlement = DB::table('azhrms_leave_entitlement')
       ->join('azhrms_leave_type','azhrms_leave_entitlement.leave_type_id','=','azhrms_leave_type.id')
       ->get();
       
      
     
      return view('entitlement.viewmyleaveentitlement',compact('myleaveentitlement',));
   }
   
   


   public function editleaveentitlement($id, Request $request)
   {
       $leaveentitlement = LeaveEntitlement::findOrFail($id);
       $leavetype= DB::table('azhrms_leave_type')->get();
        $leaveperiod= DB::table('azhrms_leave_period_history')->get();
        $employee= DB::table('azhrms_employee')->get();
        $company= DB::table('azhrms_company_gen_info')->get();
        $companylocation= DB::table('azhrms_company_location')->get();

        $entitlementcompany= DB::table('azhrms_leave_entitlement')->select('azhrms_company_gen_info.c_name as company_name','azhrms_leave_entitlement.company_id as company')->
        join('azhrms_company_gen_info', 'azhrms_leave_entitlement.company_id', '=', 'azhrms_company_gen_info.id')
        ->where('azhrms_leave_entitlement.id',$id)->get();

        $entitlementtype= DB::table('azhrms_leave_entitlement')->select('azhrms_leave_type.name as leave_name','azhrms_leave_entitlement.leave_type_id as leave_type')->
        join('azhrms_leave_type', 'azhrms_leave_entitlement.leave_type_id', '=', 'azhrms_leave_type.id')
        ->where('azhrms_leave_entitlement.id',$id)->get();
        Log::debug("all".print_r($request->all(),true));

       return view('entitlement.editleaveentitlement', compact('leaveentitlement','entitlementtype','entitlementcompany',
       'companylocation','company','employee','leavetype','leaveperiod') );
   }


   public function updateleaveentitlement($id, Request $request)
   {
       
    //Log::debug("all".print_r($request->all(),true));

       $leave= LeaveEntitlement::findOrFail($id);
       $leave->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deleteleaveentitlement(Request $request,$id)
    {

        LeaveEntitlement::where('id',$id)->delete();
        
        return Redirect::back();
    }
    function Conform_Delete()
    {
        return confirm("Are You Sure Want to Delete?");

    }





    
}
