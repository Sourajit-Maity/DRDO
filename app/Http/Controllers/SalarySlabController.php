<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalarySlab;

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

class SalarySlabController extends Controller
{
    public function addsalaryslab()
    {
      return view('salaryslabmaster.addsalaryslab');
    }

    
    public function submitsalaryslab(Request $request)
   {
       
    $this->validate($request, [
 
        'salary_slab'  => 'required',
      
    ]);
   

    SalarySlab::create([
           
           'salary_slab' => $request->get('salary_slab'),

         
                  
       ]);

     

       return Redirect::to('view-salary-slab')->with('success',' Created Successfully!');
   }



   public function viewsalaryslab(Request $request)
   {

    
       $type = SalarySlab::get();

      return view('salaryslabmaster.viewsalaryslab',compact('type',));
   } 


   
   
   


   public function editsalaryslab($id)
   {

    $type = SalarySlab::findOrFail($id);

     return view('salaryslabmaster.editsalaryslab',compact('type'));
   }


   public function updatesalaryslab($id, Request $request)
   {
       
    

       $type= SalarySlab::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deletesalaryslab(Request $request,$id)
    {

        SalarySlab::where('id',$id)->delete();
        
        return Redirect::back();
    }
}
