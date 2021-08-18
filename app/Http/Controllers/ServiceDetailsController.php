<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceDetails;
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
use App\Models\Role;
use App\Models\File;
use App\Notifications\EmployeeTaDa;
use App\Notifications\ServiceDetail;
use Illuminate\Support\Facades\Notification;

class ServiceDetailsController extends Controller
{
    public function addservicedetails()
    {
      return view('servicedetails.addservicedetails');
    }

    
    public function submitservicedetails(Request $request)
   {
       
    $this->validate($request, [
 
        
        'dept'  => 'required',
        'period_from'  => 'required',
        'period_to'  => 'required|string|max:120',
        'post_held'  => 'required',
        'pay'  => 'required',
        'additions_pay'  => 'required',
        'details'  => 'required',
        'upload_doc'  => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf',
        
      
    ]);
   

   DB::beginTransaction();

    try {
                $service = new ServiceDetails;

                $service->dept = $request->get('dept');
                $service->period_from = $request->get('period_from');
                $service->period_to= $request->get('period_to');
                $service->post_held= $request->get('post_held');
                $service->pay= $request->get('pay');
                $service->additions_pay= $request->get('additions_pay');
                $service->details= $request->get('details');
                $service->emp_id = Auth::user()->emp_id;


               

                $fileName = time().'.'.$request->upload_doc->extension();  

                $request->upload_doc->move(public_path('assets/service'), $fileName);
                $service->upload_doc= $fileName;

                $service->save();

                $dir = User::find(1);
            $emp_id = Auth::user()->id;
    
            $applier = User::find($emp_id);
    
           
            Notification::send($dir, new ServiceDetail($dir)); 
            Notification::send($applier, new ServiceDetail($applier)); 

                DB::commit();
              
           } 
            catch (\Exception $e) {
                DB::rollback();
                
            }
 
           Log::debug("all".print_r($request->all(),true));
           return Redirect::to('view-servicedetails')->with('success','You have successfully file uplaod.')
           ->with('file',$fileName);
        }



   public function viewservicedetails(Request $request)
   {

    
       $type = ServiceDetails::get();

       $currentuserid = Auth::user()->emp_id;

    

       if(Auth::user()->role=='1') {
          $type = ServiceDetails::select('drdo_details_service.emp_id','drdo_details_service.id as id','azhrms_employee.emp_nick_name',
          'dept','period_from','period_to','post_held','pay','additions_pay','details',
          'upload_doc','is_approved',)
   
          ->join('azhrms_employee','drdo_details_service.emp_id','=','azhrms_employee.id')
        
          ->get();
       }
       else{
           $type = ServiceDetails::select('drdo_details_service.emp_id','drdo_details_service.id as id','azhrms_employee.emp_nick_name',
           'dept','period_from','period_to','post_held','pay','additions_pay','details',
           'upload_doc','is_approved',)
   
          ->join('azhrms_employee','drdo_details_service.emp_id','=','azhrms_employee.id')
          ->where('drdo_details_service.emp_id',$currentuserid)
         
          ->get();
       }

      return view('servicedetails.viewservicedetails',compact('type',));
   } 


   
   
   


   public function editservicedetails($id)
   {

    $type = ServiceDetails::findOrFail($id);

     return view('servicedetails.editservicedetails',compact('type'));
   }


   public function updateservicedetails($id, Request $request)
   {
    $this->validate($request, [
 
        'bank_name'  => 'required|string|max:120',
        'bank_ifsc_no'  => 'required',
        'bank_name'  => 'required',
      
    ]);
    

       $type= ServiceDetails::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deleteservicedetails(Request $request,$id)
    {

        ServiceDetails::where('id',$id)->delete();
        
        return Redirect::back();
    }


    public function servicedetailshrapprove(Request $request,$id)
    {
        $service = ServiceDetails::find($id);
        if($service){
            $service->is_approved = $request -> approve;
            $service->save();

            return redirect()->back();
        }
    }
}
