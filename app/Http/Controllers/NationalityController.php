<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nationality;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class NationalityController extends Controller
{



    public function addNationality()
    {
        return view('nationality.add-nationality');
    }


    public function registerNationality(Request $request)
   {
       
        $this->validate($request, [
    
            'name'  => 'required|string|max:120',
            
            
        ]);

        Nationality::create([
           
           'name' => $request->get('name'),
           
         
       ]);

     

       return Redirect::to('all-nationality')->with('success','Nationality Created Successfully!');
   }


   public function viewnationality(Request $request)
   {

    
        $nationalities = DB::table('azhrms_nationalities')->get();
            
        return view('nationality.viewallnationality',compact('nationalities',));
   } 


   public function editNationality($id)
   {
       $nationalityedit = Nationality::findOrFail($id);

       return view('nationality.edit-nationality', compact('nationalityedit') );
   }


   public function updateNationality($id, Request $request)
   {
       
        $this->validate($request, [
 
        'name'  => 'required|string|max:120',
       
        
        ]);

       $role= Nationality::findOrFail($id);
       $role->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deletenationality(Request $request,$id)
    {

        Nationality::where('id',$id)->delete();
        
        return Redirect::back();
    }
    function Conform_Delete()
    {
        return confirm("Are You Sure Want to Delete?");

    }
}


