<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Language;
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

class LanguageController extends Controller
{
    public function addlanguage()
    {
      return view('language.addlanguage');
    }

    
    public function submitlanguage(Request $request)
   {
       
    $this->validate($request, [
 
        'lng_name'  => 'required|string|max:120',
      
    ]);
   

    Language::create([
           
           'lng_name' => $request->get('lng_name'),

         
                  
       ]);

     

       return Redirect::to('view-language')->with('success',' Created Successfully!');
   }



   public function viewlanguage(Request $request)
   {

    
       $type = DB::table('azhrms_employee_language')->get();

      return view('language.viewlanguage',compact('type',));
   } 


   
   
   


   public function editlanguage($id)
   {

    $type = Language::findOrFail($id);

     return view('language.editlanguage',compact('type'));
   }


   public function updatelanguage($id, Request $request)
   {
       
    

       $type= Language::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::to('view-language')->with('success','Successfully Updated!');
   }

   public function deletelanguage(Request $request,$id)
    {

        Language::where('id',$id)->delete();
        
        return Redirect::back();
    }
    function Confirm_Delete()
    {
        return confirm("Are You Sure Want to Delete?");

    }
}
