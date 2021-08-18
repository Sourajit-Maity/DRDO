<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Workshift;
use App\Models\Employee;
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

class WorkshiftController extends Controller
{
    public function addworkshift()
    {
       

        return view('workshift.addworkshift');
    }

    
    public function submitworkshift(Request $request)
   {
       
    $this->validate($request, [
 
        'name'  => 'required|string|max:120',
        'start_time'  => 'required',
        'end_time'  => 'required',
       
       
        
    ]);
   
    $start_time = ($request->get('start_time'));
   $end_time = ($request->get('end_time'));
   //$diff_in_minutes = $from->diffInHours($to); 


   $start_datetime = new DateTime($start_time);
   $end_datetime = new DateTime($end_time);

   $diff_in_minutes =  $start_datetime->diff($end_datetime);
   $hour = $diff_in_minutes->format('%h');

     Log::debug("allhour".print_r($hour,true));
    Workshift::create([
           
           'name' => $request->get('name'),
           'hours_per_day' =>  $hour, 
           'start_time' => $request->get('start_time'),
           'end_time'  => $request->get('end_time'),
         
                  
       ]);

     

       return Redirect::to('view-workshift')->with('success',' Created Successfully!');
   }



   public function viewworkshift(Request $request)
   {

    
       $workshift = DB::table('azhrms_work_shift')->get();

      return view('workshift.viewworkshift',compact('workshift',));
   } 

   //Exact time diff carbon
   //{{ (\Carbon\Carbon::parse($value->start_time))->diff(\Carbon\Carbon::parse($value->end_time))->format('%h:%I') }}
   
    


   public function editworkshift($id)
   {

    $workshift = Workshift::findOrFail($id);

 

     return view('workshift.editworkshift',compact('workshift'));
   }


   public function updateworkshift($id, Request $request)
   {
       
    $to = round($request->get('start_time'));
    $from = round($request->get('end_time'));
    $diff_in_minutes = $from-$to;

    $workshift= Workshift::findOrFail($id);
    $workshift->name= $request->get('name');
    $workshift->start_time= $request->get('start_time');
    $workshift->end_time= $request->get('end_time');
    $workshift->hours_per_day= $diff_in_minutes;
    
    $workshift->save();

       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deleteworkshift(Request $request,$id)
    {

        Workshift::where('id',$id)->delete();
        
        return Redirect::back();
    }
    function Confirm_Delete()
    {
        return confirm("Are You Sure Want to Delete?");

    }
}
