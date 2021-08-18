<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Rules\MatchOldPassword;

use App\Models\GradeMaster;

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

class GradeMasterController extends Controller
{
    public function addgrademaster()
    {
      return view('grademaster.addgrademaster');
    }

    
    public function submitgrademaster(Request $request)
   {
       
    $this->validate($request, [
 
        'grade_master'  => 'required',
      
    ]);
   

    GradeMaster::create([
           
           'grade_master' => $request->get('grade_master'),

         
                  
       ]);

     

       return Redirect::to('view-grade-master')->with('success',' Created Successfully!');
   }



   public function viewgrademaster(Request $request)
   {

    
       $type = GradeMaster::get();

      return view('grademaster.viewgrademaster',compact('type',));
   } 


   
   
   


   public function editgrademaster($id)
   {

    $type = GradeMaster::findOrFail($id);

     return view('grademaster.editgrademaster',compact('type'));
   }


   public function updategrademaster($id, Request $request)
   {
       
    

       $type= GradeMaster::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deletegrademaster(Request $request,$id)
    {

        GradeMaster::where('id',$id)->delete();
        
        return Redirect::back();
    }
}
