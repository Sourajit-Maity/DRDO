<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\State;
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


class StateController extends Controller
{
    public function addstate()
    {
      return view('state.addstate');
    }

    
    public function submitstate(Request $request)
   {
       
    $this->validate($request, [
 
        'state_name'  => 'required|string|max:120|unique:azhrms_company_state',
      
    ]);
    
   

    State::create([
           
           'state_name' => $request->get('state_name'),

         
                  
       ]);

     

       return Redirect::to('view-state')->with('success',' Created Successfully!');
   }



   public function viewstate(Request $request)
   {

    
       $type = State::get();

      return view('state.viewstate',compact('type',));
   } 


   
   
   


   public function editstate($id)
   {

    $type = State::findOrFail($id);

     return view('state.editstate',compact('type'));
   }


   public function updatestate($id, Request $request)
   {
       
    $this->validate($request, [
 
        'state_name'  => 'required|string|max:120',
      
    ]);

       $type= State::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deletestate(Request $request,$id)
    {

        State::where('id',$id)->delete();
        
        return Redirect::back();
    }
    function Confirm_Delete()
    {
        return confirm("Are You Sure Want to Delete?");

    }
}
