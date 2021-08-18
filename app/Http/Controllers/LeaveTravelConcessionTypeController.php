<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;

use App\Models\LeaveTravelConcessionType;

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

class LeaveTravelConcessionTypeController extends Controller
{
    public function addleavetravelconcessiontype()
    {
      return view('leavetraveltype.addleavetraveltype');
    }

    
    public function submitleavetravelconcessiontype(Request $request)
   {
       
    $this->validate($request, [
 
        'leave_travel_concession'  => 'required|string|max:120',
      
    ]);
   

    LeaveTravelConcessionType::create([
           
           'leave_travel_concession' => $request->get('leave_travel_concession'),

         
                  
       ]);

     

       return Redirect::to('view-leave-travel-concession-type')->with('success',' Created Successfully!');
   }



   public function viewleavetravelconcessiontype(Request $request)
   {

    
       $type = LeaveTravelConcessionType::get();

      return view('leavetraveltype.viewleavetraveltype',compact('type',));
   } 


   
   
   


   public function editleavetravelconcessiontype($id)
   {

    $type = LeaveTravelConcessionType::findOrFail($id);

     return view('leavetraveltype.editleavetraveltype',compact('type'));
   }


   public function updateleavetravelconcessiontype($id, Request $request)
   {
       
    

       $type= LeaveTravelConcessionType::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deleteleavetravelconcessiontype(Request $request,$id)
    {

        LeaveTravelConcessionType::where('id',$id)->delete();
        
        return Redirect::back();
    }
   
}
