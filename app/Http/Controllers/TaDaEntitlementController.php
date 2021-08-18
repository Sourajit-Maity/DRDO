<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\CRM;
use App\Models\TaDaEntitlement;
use App\Usermanagement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TaDaEntitlementController extends Controller
{
    public function addtadaentitlement()

    {
       
        $travel = CRM::get();
        return view('tadaentitlement.addtadaentitlement',compact('travel'));
    }

    public function submittadaentitlement(Request $request)
    {
        $this->validate($request, [
 
            'entitlement_name'  => 'required|string|max:120',
           
            'travel_by' => 'required'
        ]);
 
        TaDaEntitlement::create([
            'entitlement_name' => $request->get('entitlement_name'),
           
            'travel_by' => $request->get('travel_by'),
            
        ]);
 
 
        return Redirect::to('view-tadaentitlement')->with('success','Subrole Created Successfully!');
    }

    public function viewtadaentitlement(Request $request)
   {

    
       $entitlement = TaDaEntitlement::select('crm','entitlement_name','travel_by','ta_da_entitlement.id as id')
       ->join('azhrms_crm','ta_da_entitlement.travel_by','=','azhrms_crm.id')
       ->get();
      
      
     
      return view('tadaentitlement.viewtadaentitlement',compact('entitlement',));
   }

   public function deletetadaentitlement(Request $request,$id)
    {

        TaDaEntitlement::where('id',$id)->delete();
        
        return Redirect::back();
    }
    


    public function edittadaentitlement($id)

    {
       
        $entitlement = TaDaEntitlement::select('crm','entitlement_name','travel_by','ta_da_entitlement.id as id')
        ->join('azhrms_crm','ta_da_entitlement.travel_by','=','azhrms_crm.id')->findOrFail($id);
        $travel = CRM::get();

 
        return view('tadaentitlement.edittadaentitlement', compact('entitlement','travel') );
    }
 
 
    public function updatetadaentitlement($id, Request $request)
    {
        $this->validate($request, [
 
            'entitlement_name'  => 'required|string|max:120',
           
            'travel_by' => 'required'
        ]);
 
        $entitlement= TaDaEntitlement::findOrFail($id);
        $entitlement->update($request->all());
        return Redirect::back()->with('success','Successfully Updated!');
    }
 
}
 