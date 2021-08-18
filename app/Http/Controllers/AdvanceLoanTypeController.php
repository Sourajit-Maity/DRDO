<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;

use App\Models\AdvanceLoanType;

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

class AdvanceLoanTypeController extends Controller
{
    public function addadvancetype()
    {
      return view('advancetype.addadvancetype');
    }

    
    public function submitadvancetype(Request $request)
   {
       
    $this->validate($request, [
 
        'advance_loan_type_name'  => 'required|string|max:120',
      
    ]);
   

    AdvanceLoanType::create([
           
           'advance_loan_type_name' => $request->get('advance_loan_type_name'),

         
                  
       ]);

     

       return Redirect::to('view-advancetype')->with('success',' Created Successfully!');
   }



   public function viewadvancetype(Request $request)
   {

    
       $type = AdvanceLoanType::get();

      return view('advancetype.viewadvancetype',compact('type',));
   } 


   
   
   


   public function editadvancetype($id)
   {

    $type = AdvanceLoanType::findOrFail($id);

     return view('advancetype.editadvancetype',compact('type'));
   }


   public function updateadvancetype($id, Request $request)
   {
       
    

       $type= AdvanceLoanType::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deleteadvancetype(Request $request,$id)
    {

        AdvanceLoanType::where('id',$id)->delete();
        
        return Redirect::back();
    }
}
