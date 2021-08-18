<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddNomination;
use App\Models\Employee;
use App\Models\User;
use App\Models\FamilyNominations;
use App\Models\EmployeeFamilyDetails;
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
use App\Models\Role;
use App\Models\File;
use App\Notifications\EmployeeTaDa;
use App\Notifications\ApplyNomination;
use Illuminate\Support\Facades\Notification;

class AddNominationController extends Controller
{
    public function addaddnominationinsurance()
    {
        $currentuserid = Auth::user()->emp_id;
        $employee = EmployeeFamilyDetails::where('employee_family_details.emp_id',$currentuserid)->get();
 
      return view('addnominationinsurance.addaddnominationinsurance',compact('employee'));
    }

    public function submitaddnominationinsurance( Request $request)
            {

                $request->validate([
 
                    'moreFields.*.nomination_type'  => 'required',
                    'moreFields.*.member_name'  => 'required',
                    'moreFields.*.member_address'  => 'required',
                    'moreFields.*.relation'  => 'required',
                    'moreFields.*.age'  => 'required',
                    'moreFields.*.amount_share'  => 'required',
                    'moreFields.*.contingencies'  => 'required',
                    'moreFields.*.emp_id'  => 'required',
                    'moreFields.*.other_details'  => 'required',
  
                    
                ]);

               

            foreach ($request->moreFields as $key => $value) {
                AddNomination::create($value);
            }

           
            $dir = User::find(1);
            $issuerid = Auth::user()->id;
    
            $applier = User::find($issuerid);
    
            Notification::send($dir, new ApplyNomination($dir)); 
           
            Notification::send($applier, new ApplyNomination($applier)); 

           // Log::debug("time".print_r($now,true));
        //Log::debug("all".print_r($request->all(),true));
        return Redirect::back()->with('success','You have successfully submitted.');
        
        }


        public function viewaddnominationinsurance(Request $request)
   {
    $currentuserid = Auth::user()->emp_id;

    

    if(Auth::user()->role=='1') {
       $report = AddNomination::select('add_nomination_insurance_employee.emp_id','add_nomination_insurance_employee.id as id','azhrms_employee.emp_nick_name',
        'nomination_type','employee_family_details.member_name','member_address','add_nomination_insurance_employee.relation','age',
       'amount_share','contingencies','other_details','amount_share_other','is_approved')
       ->join('employee_family_details','add_nomination_insurance_employee.member_name','=','employee_family_details.id')

       ->join('azhrms_employee','add_nomination_insurance_employee.emp_id','=','azhrms_employee.id')
       ->where('add_nomination_insurance_employee.nomination_type',1)
       ->get();
    }
    else{
        $report = AddNomination::select('add_nomination_insurance_employee.emp_id','add_nomination_insurance_employee.id as id','azhrms_employee.emp_nick_name',
        'nomination_type','employee_family_details.member_name','member_address','add_nomination_insurance_employee.relation','age',
       'amount_share','contingencies','other_details','amount_share_other','is_approved')
       ->join('employee_family_details','add_nomination_insurance_employee.member_name','=','employee_family_details.id')

       ->join('azhrms_employee','add_nomination_insurance_employee.emp_id','=','azhrms_employee.id')
       ->where('add_nomination_insurance_employee.emp_id',$currentuserid)
       ->where('add_nomination_insurance_employee.nomination_type',1)
       ->get();
    }
      return view('addnominationinsurance.viewaddnominationinsurance',compact('report',));
   } 

   public function viewaddinsurance(Request $request)
   {
    $currentuserid = Auth::user()->emp_id;

    

    if(Auth::user()->role=='1') {
       $report = AddNomination::select('add_nomination_insurance_employee.emp_id','add_nomination_insurance_employee.id as id','azhrms_employee.emp_nick_name',
        'nomination_type','employee_family_details.member_name','member_address','add_nomination_insurance_employee.relation','age',
       'amount_share','contingencies','other_details','amount_share_other','is_approved')
       ->join('employee_family_details','add_nomination_insurance_employee.member_name','=','employee_family_details.id')

       ->join('azhrms_employee','add_nomination_insurance_employee.emp_id','=','azhrms_employee.id')
       ->where('add_nomination_insurance_employee.nomination_type',2)
       ->get();
    }
    else{
        $report = AddNomination::select('add_nomination_insurance_employee.emp_id','add_nomination_insurance_employee.id as id','azhrms_employee.emp_nick_name',
        'nomination_type','employee_family_details.member_name','member_address','add_nomination_insurance_employee.relation','age',
       'amount_share','contingencies','other_details','amount_share_other','is_approved')
       ->join('employee_family_details','add_nomination_insurance_employee.member_name','=','employee_family_details.id')

       ->join('azhrms_employee','add_nomination_insurance_employee.emp_id','=','azhrms_employee.id')
       ->where('add_nomination_insurance_employee.emp_id',$currentuserid)
       ->where('add_nomination_insurance_employee.nomination_type',2)
       ->get();
    }
      return view('addnominationinsurance.viewgroupinsurance',compact('report',));
   } 


   public function editaddnominationinsurance($id)
   {

    $type = AddNomination::findOrFail($id);

     return view('addnominationinsurance.editaddnominationinsurance',compact('type'));
   }


   public function updateaddnominationinsurance($id, Request $request)
   {
       
    

       $type= AddNomination::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deleteaddnominationinsurance(Request $request,$id)
    {

        AddNomination::where('id',$id)->delete();
        
        return Redirect::back();
    }

    public function nominationinsurancehrapprove(Request $request,$id)
    {
        $nomination = AddNomination::find($id);
        if($nomination){
            $nomination->is_approved = $request -> approve;
            $nomination->save();

           // $id =$request->get('hod_id');
           // $admin_id = User::where('emp_id',$id)->value('id');
           // $admin = User::find($admin_id);
           // $dir = User::find(1);
           // $issuerid = Auth::user()->id;
    
            //$applier = User::find($issuerid);
    
           // Notification::send($dir, new EmployeeTaDa($dir)); 
           // Notification::send($admin, new EmployeeTaDa($admin)); 
           // Notification::send($applier, new EmployeeTaDa($applier)); 
            //Log::debug("all".print_r($request->all(),true));
            return redirect()->back(); 
        }
    }

    public function addemployeenomini()
    {
        $currentuserid = Auth::user()->emp_id;
        $employee = EmployeeFamilyDetails::where('employee_family_details.emp_id',$currentuserid)->get();
 
      return view('addnominationinsurance.addemployeenomini',compact('employee'));
    }

    public function updateemployeenomini( Request $request)
{
    DB::beginTransaction();

    try {
                $currentuserid = Auth::user()->emp_id;
               
                $nomini = new FamilyNominations;

                $nomini->gpf_pran_no= $request->get('gpf_pran_no');
              
                $nomini->emp_id = $currentuserid;


                $pranfile = time().'.'.$request->gpf_pran_doc->extension();  

                $request->gpf_pran_doc->move(public_path('assets/gpf'), $pranfile);
                $nomini->gpf_pran_doc= $pranfile;

                $fileName = time().'.'.$request->dcr_doc->extension();  

                $request->dcr_doc->move(public_path('assets/dcr'), $fileName);
                $nomini->dcr_doc= $fileName;

                $letters = time().'.'.$request->family_declaration_doc->extension();  

                $request->family_declaration_doc->move(public_path('assets/family'), $letters);
                $nomini->family_declaration_doc= $letters;

                $nomini->save();
                DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }
 
           Log::debug("all".print_r($request->all(),true));
           return Redirect::back()->with('success','You have successfully file uplaod.')
           ->with('file',$letters,$fileName,$pranfile);
             
}


        public function viewemployeenomini(Request $request)
   {
    $currentuserid = Auth::user()->emp_id;

    

    if(Auth::user()->role=='1') {
       $report = FamilyNominations::select('azhrms_employee_family_nominations.emp_id','azhrms_employee_family_nominations.id as id','azhrms_employee.emp_nick_name',
       'family_declaration_doc','gpf_pran_no','gpf_pran_doc','dcr_doc','is_approved')

       ->join('azhrms_employee','azhrms_employee_family_nominations.emp_id','=','azhrms_employee.id')
     
       ->get();
    }
    else{
        $report = FamilyNominations::select('azhrms_employee_family_nominations.emp_id','azhrms_employee_family_nominations.id as id','azhrms_employee.emp_nick_name',
        'family_declaration_doc','gpf_pran_no','gpf_pran_doc','dcr_doc','is_approved')
       

       ->join('azhrms_employee','azhrms_employee_family_nominations.emp_id','=','azhrms_employee.id')
       ->where('azhrms_employee_family_nominations.emp_id',$currentuserid)
      
       ->get();
    }
      return view('addnominationinsurance.viewemployeenomini',compact('report',));
   } 

   public function employeenominiadminapprove(Request $request,$id)
   {
       $service = FamilyNominations::find($id);
       if($service){
           $service->is_approved = $request -> approve;
           $service->save();

           return redirect()->back();
       }
   }

}
