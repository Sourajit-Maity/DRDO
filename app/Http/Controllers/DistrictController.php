<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\District;
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

class DistrictController extends Controller
{
    public function adddistrict()
    {
        $state= State::get();
      return view('district.adddistrict',compact('state'));
    }

    
    public function submitdistrict(Request $request)
   {
       
    $this->validate($request, [
 
        'district_name'  => 'required|string|max:120|unique:azhrms_company_district',
         'state_id' => 'required',
    ]);
   

    District::create([
           
           'district_name' => $request->get('district_name'),
           'state_id' => $request->get('state_id'),

         
                  
       ]);

     

       return Redirect::to('view-district')->with('success',' Created Successfully!');
   }



   public function viewdistrict(Request $request)
   {

    
       $type = District::get();

      return view('district.viewdistrict',compact('type',));
   } 


   
   
   


   public function editdistrict($id)
   {

    $type = District::findOrFail($id);

    $state= State::get();
    $editstate= District::select('azhrms_company_state.state_name as state_nme','azhrms_company_district.state_id as state_code_id')->
        join('azhrms_company_state', 'azhrms_company_district.state_id', '=', 'azhrms_company_state.id')
        ->where('azhrms_company_district.id',$id)->get();

     return view('district.editdistrict',compact('type','state','editstate'));
   }


   public function updatedistrict($id, Request $request)
   {
    $this->validate($request, [
 
        'district_name'  => 'required|string|max:120',
         'state_id' => 'required',
    ]);
    

       $type= District::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deletedistrict(Request $request,$id)
    {

        District::where('id',$id)->delete();
        
        return Redirect::back();
    }
   
}
