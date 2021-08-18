<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Employee;
use App\Models\User;
use App\Models\CRM;
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

class CRMController extends Controller
{
    public function addcrm()
    {
      return view('crm.addcrm');
    }

    
    public function submitcrm(Request $request)
   {
       
    $this->validate($request, [
 
        'crm'  => 'required|string|max:120',
      
    ]);
   

    CRM::create([
           
           'crm' => $request->get('crm'),

         
                  
       ]);

     

       return Redirect::to('view-crm')->with('success',' Created Successfully!');
   }



   public function viewcrm(Request $request)
   {

    
       $type = CRM::get();

      return view('crm.viewcrm',compact('type',));
   } 


   
   
   


   public function editcrm($id)
   {

    $type = CRM::findOrFail($id);

     return view('crm.editcrm',compact('type'));
   }


   public function updatecrm($id, Request $request)
   {
       
    

       $type= CRM::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deletecrm(Request $request,$id)
    {

        CRM::where('id',$id)->delete();
        
        return Redirect::back();
    }
}
