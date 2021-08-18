<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use App\Models\Jobcategory;
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

class JobcategoryController extends Controller
{
    public function addjobcategory()
    {
      return view('jobcategory.addjobcategory');
    }

    
    public function submitjobcategory(Request $request)
   {
       
    $this->validate($request, [
 
        'job_category'  => 'required|string|max:120',
      
    ]);
   

    Jobcategory::create([
           
           'job_category' => $request->get('job_category'),

         
                  
       ]);

     

       return Redirect::to('view-jobcategory')->with('success',' Created Successfully!');
   }



   public function viewjobcategory(Request $request)
   {

    
       $type = Jobcategory::get();

      return view('jobcategory.viewjobcategory',compact('type',));
   } 


   
   
   


   public function editjobcategory($id)
   {

    $type = Jobcategory::findOrFail($id);

     return view('jobcategory.editjobcategory',compact('type'));
   }


   public function updatejobcategory($id, Request $request)
   {
       
    

       $type= Jobcategory::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deletejobcategory(Request $request,$id)
    {

        Jobcategory::where('id',$id)->delete();
        
        return Redirect::back();
    }
}
