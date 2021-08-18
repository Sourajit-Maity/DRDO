<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Country;
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

class CountryController extends Controller
{
    public function addcountry()
    {
      return view('country.addcountry');
    }

    
    public function submitcountry(Request $request)
   {
       
    $this->validate($request, [
 
        'country_name'  => 'required|string|max:120',
      
    ]);
   

    Country::create([
           
           'country_name' => $request->get('country_name'),

         
                  
       ]);

     

       return Redirect::to('view-country')->with('success',' Created Successfully!');
   }



   public function viewcountry(Request $request)
   {

    
       $type = DB::table('azhrms_company_country')->get();

      return view('country.viewcountry',compact('type',));
   } 


   
   
   


   public function editcountry($id)
   {

    $type = Country::findOrFail($id);

     return view('country.editcountry',compact('type'));
   }


   public function updatecountry($id, Request $request)
   {
       
    

       $type= Country::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::to('view-country')->with('success','Successfully Updated!');
   }

   public function deletecountry(Request $request,$id)
    {

        Country::where('id',$id)->delete();
        
        return Redirect::back();
    }
    function Confirm_Delete()
    {
        return confirm("Are You Sure Want to Delete?");

    }
}
