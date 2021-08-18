<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VaccineMaster;
use App\Models\Employee;
use App\Models\User;
use App\Models\CompanyGenInfo;
use App\Models\EmployeeVaccine;
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

class VaccineController extends Controller
{
    public function addvaccinemaster()
    {
      return view('vaccine.addvaccinemaster');
    }

    
    public function submitvaccinemaster(Request $request)
   {
       
    $this->validate($request, [
 
        'vaccine_name'  => 'required|string|max:120|unique:vaccine_master',
        'vaccine_dose'  => 'required',
        
      
    ]);
    
   

    VaccineMaster::create([
           
           'vaccine_name' => $request->get('vaccine_name'),
           'vaccine_dose' => $request->get('vaccine_dose'),
           'others' => $request->get('others'),

         
                  
       ]);

     

       return Redirect::to('view-vaccine-master')->with('success',' Created Successfully!');
   }



   public function viewvaccinemaster(Request $request)
   {

    
       $type = VaccineMaster::get();

      return view('vaccine.viewvaccinemaster',compact('type',));
   } 


   
   
   


   public function editvaccinemaster($id)
   {

    $type = VaccineMaster::findOrFail($id);

     return view('vaccine.editvaccinemaster',compact('type'));
   }


   public function updatevaccinemaster($id, Request $request)
   {
       
    $this->validate($request, [
 
        'vaccine_name'  => 'required|string|max:120',
        'vaccine_dose'  => 'required',
        
      
    ]);

       $type= VaccineMaster::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deletevaccinemaster(Request $request,$id)
    {

        VaccineMaster::where('id',$id)->delete();
        
        return Redirect::back();
    }


    
    public function addvaccineemployee()
    {
        $vaccine = VaccineMaster::get();
        return view('vaccine.addemployeevaccine',compact('vaccine'));
    }

    
    public function submitvaccineemployee(Request $request)
   {
       
    $this->validate($request, [
 
        'vaccine_id'  => 'required',
        'dose_taken'  => 'required',
        'date_taken'  => 'required',
        'vaccine_certificate'  => 'required',
        
      
    ]);

    DB::beginTransaction();

    try {
                $currentuserid = Auth::user()->emp_id;
               
                $vaccine = new EmployeeVaccine;

                $vaccine->vaccine_id= $request->get('vaccine_id');
                $vaccine->dose_taken= $request->get('dose_taken');
                $vaccine->date_taken= $request->get('date_taken');
                $vaccine->others_dose= $request->get('others_dose'); 
                $vaccine->emp_id = $currentuserid;


                $pranfile = time().'.'.$request->vaccine_certificate->extension();  

                $request->vaccine_certificate->move(public_path('assets/vaccinedoc'), $pranfile);
                $vaccine->vaccine_certificate= $pranfile;


                $vaccine->save();
                DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }
 
           Log::debug("all".print_r($request->all(),true));
           return Redirect::back()->with('success','You have successfully file uplaod.')
           ->with('file',$pranfile);
             
}


   public function viewvaccineemployee(Request $request)
   {
    $currentuserid = Auth::user()->emp_id;

    $emp_comp_id = Employee::where('azhrms_employee.id',$currentuserid)->value('operational_company_id');

    $comp_id = CompanyGenInfo::where('azhrms_company_gen_info.id',$emp_comp_id)->value('id');


    if(Auth::user()->role=='1') {
    
       $type = EmployeeVaccine::select('vaccine_id','date_taken','others_dose','emp_id','dose_taken','vaccine_master.vaccine_name','vaccine_master.vaccine_dose','vaccine_master.others','azhrms_employee.emp_nick_name','employee_vaccine.id as id')
       ->join('vaccine_master','employee_vaccine.vaccine_id','=','vaccine_master.id')
       ->join('azhrms_employee','employee_vaccine.emp_id','=','azhrms_employee.id')
       ->get();
    }
    elseif(Auth::user()->role=='2'){

        $type = EmployeeVaccine::select('vaccine_id','date_taken','others_dose','emp_id','dose_taken','vaccine_master.vaccine_name','vaccine_master.vaccine_dose','vaccine_master.others','azhrms_employee.emp_nick_name','employee_vaccine.id as id')
        ->join('vaccine_master','employee_vaccine.vaccine_id','=','vaccine_master.id')
        ->join('azhrms_employee','employee_vaccine.emp_id','=','azhrms_employee.id')
           // ->where('azhrms_employee.operational_company_id',$comp_id)   
            ->get();
        }  
        else{

            $type = EmployeeVaccine::select('vaccine_id','date_taken','others_dose','emp_id','dose_taken','vaccine_master.vaccine_name','vaccine_master.vaccine_dose','vaccine_master.others','azhrms_employee.emp_nick_name','employee_vaccine.id as id')
            ->join('vaccine_master','employee_vaccine.vaccine_id','=','vaccine_master.id')
            ->join('azhrms_employee','employee_vaccine.emp_id','=','azhrms_employee.id')
                ->where('azhrms_employee.id',$currentuserid)   
                ->get();
            } 

      return view('vaccine.viewemployeevaccine',compact('type',));
   } 


   
   
   


   public function editvaccineemployee($id)
   {

    $type = EmployeeVaccine::findOrFail($id);

     return view('vaccine.editemployeevaccine',compact('type'));
   }


   public function updatevaccineemployee($id, Request $request)
   {
       
    $this->validate($request, [
 
        'vaccine_name'  => 'required|string|max:120',
        'vaccine_dose'  => 'required',
        
      
    ]);

       $type= EmployeeVaccine::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deletevaccineemployee(Request $request,$id)
    {

        EmployeeVaccine::where('id',$id)->delete();
        
        return Redirect::back();
    }
}
