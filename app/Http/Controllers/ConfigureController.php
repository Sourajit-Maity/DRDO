<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LeavePeriodHistory;
use App\Models\LeaveType;
use App\Models\WorkWeek;
use App\Models\Holiday;
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

class ConfigureController extends Controller
{

    public function addleaveperiod()
    {
        return view('configure.addleaveperiod');
    }


    public function submitleaveperiod(Request $request)
   {
       
    $this->validate($request, [
 
        'leave_period_start_date'  => 'required',
       
        
    ]);

    LeavePeriodHistory::create([
           
           'leave_period_start_date' => $request->get('leave_period_start_date'),
           
       ]);

     

       return Redirect::to('view-leave-period')->with('success',' Created Successfully!');
   }



    public function viewleaveperiod(Request $request)
    {
       
     
        $leaveperiods = DB::table('azhrms_leave_period_history')->get();
        
       
      
       return view('configure.viewleaveperiod',compact('leaveperiods',));
    } 
    public function editleaveperiod($id)

    {
        $leaveperiod = LeavePeriodHistory::findOrFail($id);
        return view('configure.leaveperiodhistory', compact('leaveperiod'));
    }

    public function submitLeave($id, Request $request)
    {
        $this->validate($request, [
 
            
            'leave_period_start_date'  => 'required|',
            
        ]);
 
          $leave= LeavePeriodHistory::findOrFail($id);
          $leave->update($request->all());
      
 
 
        return Redirect::back()->with('success','Leave period Updated Successfully!');
    }

    public function deleteleaveperiod(Request $request,$id)
    {

        LeavePeriodHistory::where('id',$id)->delete();
        
        return Redirect::back();
    }

    public function addleavetype()
    {
        return view('configure.addleavetype');
    }


    public function submitleavetype(Request $request)
   {
       
    $this->validate($request, [
 
        'name'  => 'required|string|max:120',
       
        
    ]);

    LeaveType::create([
           
           'name' => $request->get('name'),
           'exclude_in_reports_if_no_entitlement' => $request->get('exclude_in_reports_if_no_entitlement'), 
         
       ]);

     

       return Redirect::to('view-leave-type')->with('success',' Created Successfully!');
   }


   public function viewleavetype(Request $request)
   {

    
       $leavetype = DB::table('azhrms_leave_type')->get();
       
      
     
      return view('configure.viewleavetype',compact('leavetype',));
   } 


   public function editleavetype($id)
   {
       $leavetype = LeaveType::findOrFail($id);

       return view('configure.editleavetype', compact('leavetype') );
   }


   public function updateleavetype($id, Request $request)
   {
       
       $this->validate($request, [
 
        'name'  => 'required|string|max:120',
       
        
    ]);

       $leave= LeaveType::findOrFail($id);
       $leave->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deleteleavetype(Request $request,$id)
    {

        LeaveType::where('id',$id)->delete();
        
        return Redirect::back();
    }
    function Conform_Delete()
    {
        return confirm("Are You Sure Want to Delete?");

    }


    public function viewworkweek(Request $request)
   {

    
       $workweek = DB::table('azhrms_work_week')->get();
       
      
     
      return view('configure.viewworkweek',compact('workweek'));
   } 


   public function editworkweek($id,Request $request)
   {
       $workweek = WorkWeek::findOrFail($id);
      
       //Log::debug("all".print_r($workweek,true));
      

       return view('configure.editworkweek', compact('workweek') ); 
   }


   public function updateworkweek($id, Request $request)
   {
       
     

       $work= WorkWeek::findOrFail($id);
       $work->update($request->all());
      
       return Redirect::to('view-work-week')->with('success','Successfully Updated!');
   }






   public function addholiday()
    {
        return view('configure.addholiday');
    }


    public function submitholiday(Request $request)
   {
       
    $this->validate($request, [
 
        'description'  => 'required|string|max:120',
        'recurring'  => 'required|',
           'date' => 'required|',
       
        
    ]);

    Holiday::create([
           
           'description' => $request->get('description'),
           'date' => $request->get('date'), 
           'recurring' => $request->get('recurring'), 
           
         
       ]);

     

       return Redirect::to('view-holiday')->with('success',' Created Successfully!');
   }


   public function viewholiday(Request $request)
   {

    
       $holiday = DB::table('azhrms_holiday')->get();
       
      
     
      return view('configure.viewholiday',compact('holiday',));
   } 


   public function editholiday($id)
   {
       $holiday = Holiday::findOrFail($id);

       return view('configure.editholiday', compact('holiday') );
   }


   public function updateholiday($id, Request $request)
   {
       
    $this->validate($request, [
 
        'description'  => 'required|string|max:120',
        'recurring'  => 'required|',
           'date' => 'required|',
       
        
    ]);

       $leave= Holiday::findOrFail($id);
       $leave->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deleteholiday(Request $request,$id)
    {

        Holiday::where('id',$id)->delete();
        
        return Redirect::back();
    }
   


}
