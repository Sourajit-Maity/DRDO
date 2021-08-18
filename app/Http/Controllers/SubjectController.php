<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\State;
use App\Models\Employee;
use App\Models\User;
use App\Models\Subject;
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

class SubjectController extends Controller
{
    public function addsubject()
    {
      return view('subject.addsubject');
    }

    
    public function submitsubject(Request $request)
   {
       
    $this->validate($request, [
 
        'subject'  => 'required|string|max:120',
      
    ]);
   

    Subject::create([
           
           'subject' => $request->get('subject'),

         
                  
       ]);

     

       return Redirect::to('view-subject')->with('success',' Created Successfully!');
   }



   public function viewsubject(Request $request)
   {

    
       $type = Subject::get();

      return view('subject.viewsubject',compact('type',));
   } 


   
   
   


   public function editsubject($id)
   {

    $type = Subject::findOrFail($id);

     return view('subject.editsubject',compact('type'));
   }


   public function updatesubject($id, Request $request)
   {
       
    

       $type= Subject::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deletesubject(Request $request,$id)
    {

        Subject::where('id',$id)->delete();
        
        return Redirect::back();
    }
   
}
