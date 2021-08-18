<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use App\Models\Jobtype;
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

class JobtypeController extends Controller
{
    public function addjobtype()
    {
      return view('jobtype.addjobtype');
    }

    
    public function submitjobtype(Request $request)
   {
       
    $this->validate($request, [
 
        'job_type'  => 'required|string|max:120',
      
    ]);
   

    Jobtype::create([
           
           'job_type' => $request->get('job_type'),

         
                  
       ]);

     

       return Redirect::to('view-jobtype')->with('success',' Created Successfully!');
   }



   public function viewjobtype(Request $request)
   {

    
       $type = Jobtype::get();

      return view('jobtype.viewjobtype',compact('type',));
   } 


   
   
   


   public function editjobtype($id)
   {

    $type = Jobtype::findOrFail($id);

     return view('jobtype.editjobtype',compact('type'));
   }


   public function updatejobtype($id, Request $request)
   {
       
    

       $type= Jobtype::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deletejobtype(Request $request,$id)
    {

        Jobtype::where('id',$id)->delete();
        
        return Redirect::back();
    }
}
