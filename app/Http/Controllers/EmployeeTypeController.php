<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeType;
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

class EmployeeTypeController extends Controller
{
    public function addemployeetype()
    {
       

        return view('employeetype.addemployeetype');
    }

    
    public function submitemployeetype(Request $request)
   {
       
    $this->validate($request, [
 
        'emp_type_name'  => 'required|string|max:120',
      
    ]);
   

    EmployeeType::create([
           
           'emp_type_name' => $request->get('emp_type_name'),

         
                  
       ]);

     

       return Redirect::to('view-employee-type')->with('success',' Created Successfully!');
   }



   public function viewemployeetype(Request $request)
   {

    
       $type = DB::table('azhrms_employee_type')->get();

      return view('employeetype.viewemployeetype',compact('type',));
   } 


   
   
   


   public function editemployeetype($id)
   {

    $type = EmployeeType::findOrFail($id);

     return view('employeetype.editemployeetype',compact('type'));
   }


   public function updateemployeetype($id, Request $request)
   {
       
    

       $type= EmployeeType::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deleteemployeetype(Request $request,$id)
    {

        EmployeeType::where('id',$id)->delete();
        
        return Redirect::back();
    }
    function Confirm_Delete()
    {
        return confirm("Are You Sure Want to Delete?");

    }
}
