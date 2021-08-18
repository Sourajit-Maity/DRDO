<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CertificateAttestation;
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
use App\Models\Role;
use App\Models\File;
use App\Notifications\EmployeeTaDa;
use App\Notifications\CertificateAttested;
use Illuminate\Support\Facades\Notification;

use Illuminate\Support\Facades\Auth;

class CertificateAttestationController extends Controller
{
    public function addcertificateattestation()
    {
      return view('certificateattestation.addcertificateattestation');
    }

    
    public function submitcertificateattestation(Request $request)
   {
       
    $this->validate($request, [
 
        'medical_exam_no'  => 'required|string|max:120',
        'medical_exam_date'  => 'required',
        'character_no'  => 'required',
        'allegiance_no'  => 'required|string|max:120',
        'secrecy_no'  => 'required',
        'confirmation_no'  => 'required',
        'confirmation_details'  => 'required',
        'medical_exam_certificate'  => 'required',
        'character_certificate'  => 'required',
        'allegiance_certificate'  => 'required',
        'secrecy_certificate'  => 'required',
        'confirmation_certificate'  => 'required',
        
      
    ]);
   

    DB::beginTransaction();

    try {
                $certificate = new CertificateAttestation;

                $certificate->medical_exam_no = $request->get('medical_exam_no');
                $certificate->medical_exam_date = $request->get('medical_exam_date');
                $certificate->character_no= $request->get('character_no');
                $certificate->allegiance_no= $request->get('allegiance_no');
                $certificate->secrecy_no= $request->get('secrecy_no');
                $certificate->confirmation_no= $request->get('confirmation_no');
                $certificate->confirmation_details= $request->get('confirmation_details');
                $certificate->emp_id = Auth::user()->emp_id;


                $pranfile = time().'.'.$request->medical_exam_certificate->extension();  

                $request->medical_exam_certificate->move(public_path('assets/medical'), $pranfile);
                $certificate->medical_exam_certificate= $pranfile;

                $fileName = time().'.'.$request->character_certificate->extension();  

                $request->character_certificate->move(public_path('assets/character'), $fileName);
                $certificate->character_certificate= $fileName;

                $letters = time().'.'.$request->allegiance_certificate->extension();  

                $request->allegiance_certificate->move(public_path('assets/allegiance'), $letters);
                $certificate->allegiance_certificate= $letters;

                $secrecy = time().'.'.$request->secrecy_certificate->extension();  

                $request->secrecy_certificate->move(public_path('assets/secrecy'), $secrecy);
                $certificate->secrecy_certificate= $secrecy;

                $confirm = time().'.'.$request->confirmation_certificate->extension();  

                $request->confirmation_certificate->move(public_path('assets/confirm'), $confirm);
                $certificate->confirmation_certificate= $confirm;

                $certificate->save();

                
            
            $dir = User::find(1);
            $emp_id = Auth::user()->id;
    
            $applier = User::find($emp_id);
    
           
            Notification::send($dir, new CertificateAttested($dir)); 
            Notification::send($applier, new CertificateAttested($applier)); 
            //Log::debug("all".print_r($request->all(),true));

                DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }
 
           Log::debug("all".print_r($request->all(),true));
           return Redirect::to('view-certificateattestation')->with('success','You have successfully file uplaod.')
           ->with('file',$letters,$fileName,$pranfile,$secrecy,$confirm);
     

       return Redirect::to('view-certificateattestation')->with('success',' Created Successfully!');
   }



   public function viewcertificateattestation(Request $request)
   {

    
       $type = CertificateAttestation::get();

       $currentuserid = Auth::user()->emp_id;

    

    if(Auth::user()->role=='1') {
       $type = CertificateAttestation::select('drdo_certificate_attestation.emp_id','drdo_certificate_attestation.id as id','azhrms_employee.emp_nick_name',
       'medical_exam_no','medical_exam_date','medical_exam_certificate','character_no','character_certificate','allegiance_no','allegiance_certificate','secrecy_no',
       'secrecy_certificate','confirmation_no','confirmation_details','confirmation_certificate','is_approved')

       ->join('azhrms_employee','drdo_certificate_attestation.emp_id','=','azhrms_employee.id')
     
       ->get();
    }
    else{
        $type = CertificateAttestation::select('drdo_certificate_attestation.emp_id','drdo_certificate_attestation.id as id','azhrms_employee.emp_nick_name',
        'medical_exam_no','medical_exam_date','medical_exam_certificate','character_no','character_certificate','allegiance_no','allegiance_certificate','secrecy_no',
        'secrecy_certificate','confirmation_no','confirmation_details','confirmation_certificate','is_approved')
       

       ->join('azhrms_employee','drdo_certificate_attestation.emp_id','=','azhrms_employee.id')
       ->where('drdo_certificate_attestation.emp_id',$currentuserid)
      
       ->get();
    }

      return view('certificateattestation.viewcertificateattestation',compact('type',));
   } 


   
   
   


   public function editcertificateattestation($id)
   {

    $type = CertificateAttestation::findOrFail($id);

     return view('bank.editbank',compact('type'));
   }


   public function updatecertificateattestation($id, Request $request)
   {
    $this->validate($request, [
 
        'bank_name'  => 'required|string|max:120',
        'bank_ifsc_no'  => 'required',
        'bank_name'  => 'required',
      
    ]);
    

       $type= CertificateAttestation::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deletecertificateattestation(Request $request,$id)
    {

        CertificateAttestation::where('id',$id)->delete();
        
        return Redirect::back();
    } 

    public function viewcertificateattestationdetails($id,Request $request)
    {
 
     
     $certificate = CertificateAttestation::findOrFail($id);
       
       
      
       return view('certificateattestation.viewcertificateattestationdetails',compact('certificate',));
    }


    public function certificateattestationhrapprove(Request $request,$id)
    {
        $service = CertificateAttestation::find($id);
        if($service){
            $service->is_approved = $request -> approve;
            $service->save();

            return redirect()->back();
        }
    }
}
