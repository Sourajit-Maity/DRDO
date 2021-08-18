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

class CompanyGenInfoController extends Controller
{
    public function addcompany()
    {
       
        $companylocation= CompanyLocation::get();
     
        return view('company.addcompany',compact('companylocation'));
    }

    
    public function submitcompany(Request $request)
   {
       
    $this->validate($request, [
 
        'c_name'  => 'required|string|max:120',
        'tax_id'  => 'required',
       'res_company_name' => 'required|string|max:4',
        'registration_number'  => 'required',
       
       
        
    ]);

    $company = new CompanyGenInfo();

    $company->c_name= $request->get('c_name');
    $company->tax_id= $request->get('tax_id');
    $company->registration_number= $request->get('registration_number');
    $company->res_company_name= $request->get('res_company_name');
    $company->save(); 
    Log::debug("all".print_r($request->all(),true));

       return Redirect::to('view-company')->with('success','You have successfully file uplaod.'); 
   }



   public function viewcompany(Request $request)
   {

    
       $company = CompanyGenInfo::where('azhrms_company_gen_info.deleted_at','=',null)->get();
      
      return view('company.viewcompany',compact('company',)); 
   } 


   
   
   


   public function editcompany($id)
   {
  

    $company = CompanyGenInfo::findOrFail($id);
   
    $companylocation= CompanyLocation::get();
 

     return view('company.editcompany',compact('companylocation','company'));
   }


   public function updatecompany($id, Request $request)
   {
    $this->validate($request, [
 
        'c_name'  => 'required|string|max:120',
        'tax_id'  => 'required',
       'res_company_name' => 'required|string|max:4',
        'registration_number'  => 'required',
       
       
        
    ]);
    

       $company= CompanyGenInfo::findOrFail($id);
       $company->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deletecompany(Request $request,$id)
    {

        CompanyGenInfo::where('id',$id)->delete();
        
        return Redirect::back();
    }
    
}
