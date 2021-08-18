<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Religion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ReligionController extends Controller
{



    public function addReligion()
    {
        return view('religion.add-religion');
    }


    public function registerReligion(Request $request)
   {
       
        $this->validate($request, [
    
            'name'  => 'required|string|max:100',
            
            
        ]);

        Religion::create([
           
           'name' => $request->get('name'),
           
         
       ]);

     

       return Redirect::to('all-religion')->with('success','Religion added Successfully to Religion Master!');
   }


   public function viewallReligion(Request $request)
   {

    
        $religions = DB::table('azhrms_religion')->get();
            
        return view('religion.viewallreligion',compact('religions',));
   } 


   public function editReligion($id)
   {
       $religionedit = Religion::findOrFail($id);

       return view('religion.edit-religion', compact('religionedit') );
   }


   public function updateReligion($id, Request $request)
   {
       
        $this->validate($request, [
 
        'name'  => 'required|string|max:100',
       
        
        ]);

       $role= Religion::findOrFail($id);
       $role->update($request->all());
      
       return Redirect::back()->with('success','Religion Successfully updated to Religion Master!');
   }

   public function deletereligion(Request $request,$id)
    {

        Religion::where('id',$id)->delete();
        
        return Redirect::back();
    }
    function Conform_Delete()
    {
        return confirm("Are You Sure Want to Delete?");

    }
}


