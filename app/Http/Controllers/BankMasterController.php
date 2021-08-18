<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankMaster;
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

class BankMasterController extends Controller
{
    public function addbanks()
    {
      return view('bank.addbank');
    }

    
    public function submitbanks(Request $request)
   {
       
    $this->validate($request, [
 
        'bank_name'  => 'required|string|max:120|unique:azhrms_banks',
        'bank_name'  => 'required|unique:azhrms_banks',
        'bank_ifsc_no'  => 'required|regex:/^[A-Za-z]{4}[a-zA-Z0-9]{7}$/',
      
    ]);
  

    BankMaster::create([
           
           'bank_name' => $request->get('bank_name'),
           'bank_ifsc_no' => $request->get('bank_ifsc_no'),
           'branch_name' => $request->get('branch_name'),

         
                  
       ]);

     

       return Redirect::to('view-banks')->with('success',' Created Successfully!');
   }



   public function viewbanks(Request $request)
   {

    
       $type = BankMaster::get();

      return view('bank.viewbank',compact('type',));
   } 


   
   
   


   public function editbanks($id)
   {

    $type = BankMaster::findOrFail($id);

     return view('bank.editbank',compact('type'));
   }


   public function updatebanks($id, Request $request)
   {
    $this->validate($request, [
 
        'bank_name'  => 'required|string|max:120',
        'bank_ifsc_no'  => 'required|regex:/^[A-Za-z]{4}[a-zA-Z0-9]{7}$/',
        'bank_name'  => 'required',
      
    ]);
    

       $type= BankMaster::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deletebanks(Request $request,$id)
    {

        BankMaster::where('id',$id)->delete();
        
        return Redirect::back();
    }
}
