<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\AzhrmsDisciplinaryactiontypemaster;

class ConfigurationController extends Controller
{
    
    public function index()
    {
        $configurations = AzhrmsDisciplinaryactiontypemaster::latest()->paginate(5);
  
        return view('configurations.index',compact('configurations'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    public function create()
    {
        return view('configurations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            //'title' => 'required',
            'description' => 'required'
        ]);
  
        AzhrmsDisciplinaryactiontypemaster::create($request->all());
   
        return redirect()->route('configurations.index')
                        ->with('success','Configuration created successfully.');
    }

    public function edit(AzhrmsDisciplinaryactiontypemaster $configuration)
    {
        return view('configurations.edit',compact('configuration'));
    }

    public function update(Request $request, AzhrmsDisciplinaryactiontypemaster $configuration)
    {
        $request->validate([
            // 'title' => 'required',
            'description' => 'required'
        ]);
  
        $configuration->update($request->all());
  
        return redirect()->route('configurations.index')
                        ->with('success','Configuration updated successfully');
    }

    public function destroy(AzhrmsDisciplinaryactiontypemaster $configuration)
    {
        $configuration->delete();
  
        return redirect()->route('configurations.index')
                        ->with('success','Configurations deleted successfully');
    }

    public function show(AzhrmsDisciplinaryactiontypemaster $configuration)
    {
        return view('configurations.show',compact('configuration'));
    }

}
