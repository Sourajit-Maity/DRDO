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
use Datatables;
use Response,Config;
use Carbon\Carbon;
use DateTime;

class CompanyLocationDepartmentController extends Controller
{
    public function addcompanylocationsubunit()
    {
       
        $subunit= DB::table('azhrms_company_location')->get();
        $country= DB::table('azhrms_company_district')->get();
     
        return view('company.addcompanylocationdepartment',compact('subunit','country'));
    }

    
    public function submitcompanylocationsubunit(Request $request)
   {
       
    $this->validate($request, [
 
        'd_name'  => 'required|string|max:120',
        'type'  => 'required',
        'phone'  => 'required|between:10,14',
        'fax'  => 'max:14',
        'country_code' => 'required',
       
        'operational_company_location_id'  => 'required',
       
    ]);
   

    CompanyLocationDepartment::create([
           
           'd_name' => $request->get('d_name'),
           'type' => $request->get('type'), 
           'phone' => $request->get('phone'),
           'fax' => $request->get('fax'),   
           'country_code' => $request->get('country_code'),
           'area_code' => $request->get('area_code'),      
           'operational_company_location_id' => $request->get('operational_company_location_id'),
                  
       ]);

     

       return Redirect::back()->with('success',' Created Successfully!');
   }



   public function viewcompanylocationsubunit(Request $request)
   {

    
       $subunit = DB::table('azhrms_company_location_department')
       ->select('d_name','operational_company_location_id','azhrms_company_location_department.id as id','azhrms_company_location.id as l_id','azhrms_company_location.l_name','azhrms_company_location_department.phone','azhrms_company_location_department.fax','type')
       
       ->join('azhrms_company_location','azhrms_company_location_department.operational_company_location_id','=','azhrms_company_location.id')
       
       ->get();
       
      
     
      return view('company.viewcompanylocationdepartment',compact('subunit',));
   } 

   public function editcompanylocationsubunit($id)
   {

    $subunit = CompanyLocationDepartment::findOrFail($id);
   
    $location= DB::table('azhrms_company_location')->get();
    $edittype= DB::table('azhrms_company_location_department')->select('azhrms_company_location_department.type as type_id')->
    where('azhrms_company_location_department.id',$id)->get();
  // $company1= DB::table('azhrms_company_gen_info')->where('id',$id)->get();
    $editlocation= DB::table('azhrms_company_location_department')->select('azhrms_company_location.l_name as company_name','azhrms_company_location_department.operational_company_location_id as company_id')->
    join('azhrms_company_location', 'azhrms_company_location_department.operational_company_location_id', '=', 'azhrms_company_location.id')
    ->where('azhrms_company_location_department.id',$id)->get();
 

     return view('company.editcompanylocationdepartment',compact('subunit','edittype','location','editlocation'));
   }


   public function updatecompanylocationsubunit($id, Request $request)
   {
       
    $this->validate($request, [
 
        'd_name'  => 'required|string|max:120',
        'type'  => 'required',
        'phone'  => 'required|between:10,14',
        'fax'  => 'max:14',
        'operational_company_location_id'  => 'required',
        'country_code' => 'required',
       
    ]);

       $unit= CompanyLocationDepartment::findOrFail($id);
       $unit->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deletecompanylocationsubunit(Request $request,$id)
    {

        CompanyLocationDepartment::where('id',$id)->delete();
        
        return Redirect::back();
    }
    function Conform_Delete()
    {
        return confirm("Are You Sure Want to Delete?");

    }


    public function viewlocationsubunit($id,Request $request)
   {
 
       $subunit = CompanyLocationDepartment::where('operational_company_location_id',$id)->get();

      return view('company.viewcompanysubunit',compact('subunit',));
   } 
}
