<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Assets;
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

class AssetsController extends Controller
{
    public function addassets()
    {
       

        return view('assets.addassets');
    }

    
    public function submitassets(Request $request)
   {
       
    $this->validate($request, [
 
        'assets_name'  => 'required|string|max:120',
        'assets_details'  => 'required|string',
      
    ]);
   

    Assets::create([
           
           'assets_name' => $request->get('assets_name'),
           'assets_details' => $request->get('assets_details'),

         
                  
       ]);

     

       return Redirect::to('view-assets')->with('success',' Created Successfully!');
   }



   public function viewassets(Request $request)
   {

    
       $type = Assets::get();

      return view('assets.viewassets',compact('type',));
   } 


   
   
   


   public function editassets($id)
   {

    $type = Assets::findOrFail($id);

     return view('assets.editassets',compact('type'));
   }


   public function updateassets($id, Request $request)
   {
       
    

       $type= Assets::findOrFail($id);
       $type->update($request->all());
      
       return Redirect::back()->with('success','Successfully Updated!');
   }

   public function deleteassets(Request $request,$id)
    {

        Assets::where('id',$id)->delete();
        
        return Redirect::back();
    }
    function Confirm_Delete()
    {
        return confirm("Are You Sure Want to Delete?");

    }
}
