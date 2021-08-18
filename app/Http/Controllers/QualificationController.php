<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Skills;
use App\Models\Education;
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

class QualificationController extends Controller
{
    
    public function addeducation()
    {
       

        return view('qualification.addeducation');
    }

    
    public function submiteducation(Request $request)
   {
       
    $this->validate($request, [
 
        'name'  => 'required|string|max:120',
      
    ]);
   

    Education::create([
           
           'name' => $request->get('name'),

         
                  
       ]);

     

       return Redirect::to('view-education')->with('success',' Created Successfully!');
   }



   public function vieweducation(Request $request)
   {

    
       $education = DB::table('azhrms_education')->get();

      return view('qualification.vieweducation',compact('education',));
   } 


   
   
   


   public function editeducation($id)
   {

    $education = Education::findOrFail($id);

     return view('qualification.editeducation',compact('education'));
   }


   public function updateeducation($id, Request $request)
   {
       
    

       $education= Education::findOrFail($id);
       $education->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deleteeducation(Request $request,$id)
    {

        Education::where('id',$id)->delete();
        
        return Redirect::back();
    }
    function Confirm_Delete()
    {
        return confirm("Are You Sure Want to Delete?");

    }


    public function addskills()
    {
 
        return view('qualification.addskills');
    }

    
    public function submitskills(Request $request)
   {
       
    $this->validate($request, [
 
        'name'  => 'required|string|max:120',
     
    ]);
   

    Skills::create([
           
           'name' => $request->get('name'),
           'description' => $request->get('description'),
                
       ]);

     

       return Redirect::to('view-skills')->with('success',' Created Successfully!');
   }



   public function viewskills(Request $request)
   {

    
       $skills = DB::table('azhrms_skill')->get();

      return view('qualification.viewskills',compact('skills',));
   } 


   
   
   


   public function editskills($id)
   {

    $skills = Skills::findOrFail($id);
   

 

     return view('qualification.editskills',compact('skills'));
   }


   public function updateskills($id, Request $request)
   {
       
    

       $skills= Skills::findOrFail($id);
       $skills->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deleteskills(Request $request,$id)
    {

        Skills::where('id',$id)->delete();
        
        return Redirect::back();
    }
  
}
