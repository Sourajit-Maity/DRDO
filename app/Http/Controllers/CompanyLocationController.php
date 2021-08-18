<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CompanyGenInfo;
use App\Models\CompanyLocation;
use App\Models\CompanyLocationDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\District;
use App\Models\State;
use App\Models\Country;
use Datatables;
use Response,Config;
use Carbon\Carbon;
use DateTime;

class CompanyLocationController extends Controller
{
    public function addcompanylocation()
    {
       
        $company= CompanyGenInfo::get();
        $state= State::get();
        $district= District::get();
        $country= Country::get();
     
        return view('company.addcompanylocation',compact('company','state','district',));
    }

    
    public function submitcompanylocation(Request $request)
   {
       

    $messages = [

        'phone.required' => 'Phone Number Should be 10 digit.',
    ];
    
    $this->validate($request, [
 
        'l_name'  => 'required|string|max:120',
        'district'  => 'required',
        'city'  => 'required',
        'address'  => 'required',
        'zip_code'  => 'required|max:6',
        'fax'  => 'max:14|',
        'phone'  => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|between:10,14',
        'operational_company_id'  => 'required',
        'state'  => 'required',
        'country_code' => 'required',
       
       
    ], $messages);
    

    CompanyLocation::create([
           
           'l_name' => $request->get('l_name'),
           'district' => $request->get('district'), 
           'city' => $request->get('city'),
           'address' => $request->get('address'),
           'zip_code' => $request->get('zip_code'), 
           'phone' => $request->get('phone'),
           'fax' => $request->get('fax'),
           'state' => $request->get('state'),
           'country_code' => $request->get('country_code'),
           'area_code' => $request->get('area_code'),
           'operational_company_id' => $request->get('operational_company_id'),
                  
       ]);

       Log::debug("all".print_r($request->all(),true));

       return Redirect::back()->with('success',' Created Successfully!');
   }



   public function viewcompanylocation(Request $request)
   {

    
       $companylocation = CompanyLocation::
       select('l_name','azhrms_company_district.district_name','azhrms_company_state.state_name',
       'operational_company_id','azhrms_company_location.id as id','azhrms_company_gen_info.id as c_id',
       'azhrms_company_gen_info.c_name','address','zip_code','phone','fax','district','city')
       
       ->join('azhrms_company_gen_info','azhrms_company_location.operational_company_id','=','azhrms_company_gen_info.id')
       ->join('azhrms_company_state','azhrms_company_location.state','=','azhrms_company_state.id')
       ->join('azhrms_company_district','azhrms_company_location.district','=','azhrms_company_district.id')
       ->get();
       
      
      
      return view('company.viewcompanylocation',compact('companylocation',));
   } 

   public function editcompanylocation($id)
   {

    $location = CompanyLocation::findOrFail($id);

    $state= State::get();
    $editstate= CompanyLocation::select('azhrms_company_state.state_name as state_nme','azhrms_company_location.state as state_code_id')->
        join('azhrms_company_state', 'azhrms_company_location.state', '=', 'azhrms_company_state.id')
        ->where('azhrms_company_location.id',$id)->get();
    //$editstate= DB::table('azhrms_company_location')->select('azhrms_company_location.state as state_id')->
  
   // where('azhrms_company_location.id',$id)->get();

    $district= District::get();

    $editdistrict= CompanyLocation::select('azhrms_company_district.district_name as district_nme','azhrms_company_location.district as district_code_id')->
    join('azhrms_company_district', 'azhrms_company_location.district', '=', 'azhrms_company_district.id')
    ->where('azhrms_company_location.id',$id)->get();


    //$editdistrict= DB::table('azhrms_company_location')->select('azhrms_company_location.district as district_id')->
  
    //where('azhrms_company_location.id',$id)->get();
    $country= Country::get();
   
    $company= CompanyGenInfo::get();

    $editlocation= CompanyLocation::select('azhrms_company_gen_info.c_name as company_name','azhrms_company_location.operational_company_id as company_id')->
    join('azhrms_company_gen_info', 'azhrms_company_location.operational_company_id', '=', 'azhrms_company_gen_info.id')
    ->where('azhrms_company_location.id',$id)->get();
    //$company1= DB::table('azhrms_company_gen_info')->where('id',$id)->get();
 

     return view('company.editcompanylocation',compact('company','editstate','editdistrict','editlocation','state','district','location'));
   }


   public function updatecompanylocation($id, Request $request)
   {
       
    $messages = [

        'phone.required' => 'Phone Number Should be 10 digit.',
    ];
    
    $this->validate($request, [
 
        'l_name'  => 'required|string|max:120',
        'district'  => 'required',
        'state'  => 'required',
        'city'  => 'required',
        'address'  => 'required',
        'zip_code'  => 'required|max:6',
        'fax'  => 'max:14',
        'phone'  => 'required|between:10,14',
        'operational_company_id'  => 'required',
        'country_code' => 'required',
       
    ], $messages);

       $location= CompanyLocation::findOrFail($id);
       $location->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deletecompanylocation(Request $request,$id)
    {

        CompanyLocation::where('id',$id)->delete();
        
        return Redirect::back();
    }
    function Conform_Delete()
    {
        return confirm("Are You Sure Want to Delete?");

    }


    public function viewlocation($id,Request $request)
   {
 
       $companylocation = CompanyLocation::select('l_name','azhrms_company_district.district_name','azhrms_company_state.state_name',
       'operational_company_id','azhrms_company_location.id as id','azhrms_company_gen_info.id as c_id',
       'azhrms_company_gen_info.c_name','address','zip_code','phone','fax','district','city')
       
       ->join('azhrms_company_gen_info','azhrms_company_location.operational_company_id','=','azhrms_company_gen_info.id')
       ->join('azhrms_company_state','azhrms_company_location.state','=','azhrms_company_state.id')
       ->join('azhrms_company_district','azhrms_company_location.district','=','azhrms_company_district.id')->
       where('azhrms_company_location.operational_company_id',$id)->get();

      return view('company.viewlocation',compact('companylocation',));
   } 
}
