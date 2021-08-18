<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Team;
use App\Models\ProjectManager; 
use App\Models\LeavePeriodHistory;
use App\Models\LeaveType;
use App\Models\WorkWeek;
use App\Models\Skills;
use App\Models\SubRole;
use App\Models\CompanyGenInfo;
use App\Models\EmployeeLanguage;
use App\Models\Employee;
use App\Models\LeaveEntitlement;
use App\Models\EmployeeSkillGrade;
use App\Models\EmployeeSkills;
use App\Models\EmployeeEducation;
use App\Models\EmployeeType;
use App\Models\User; 
use App\Models\CompanyLocation;
use App\Models\Assets;
use App\Models\EmployeeAssets;
use App\Models\Workshift;
use App\Models\EmployeePromotion;
use App\Models\EmployeeSalary;
use App\Models\EmployeeBankDetails; 
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
use App\Models\Role;
use App\Models\File;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(10);
        
        $employees = User::where('role', 'employee')->get();
        $projectManager = ProjectManager::join('users','users.id','=', 'project_managers.user_id')
        ->select('users.first_name','users.last_name','project_managers.project_id')->get();

        $userproject = ProjectManager::join('users','users.id','=', 'project_managers.user_id')
        ->join('team_members', 'team_members.employee_id', 'users.id')
        ->join('projects', 'projects.id', 'project_managers.project_id')
        ->join('teams', 'teams.id', 'team_members.team_id')
        ->where('project_managers.user_id', auth()->user()->id)
        ->select('users.first_name','users.last_name','project_managers.project_id',
         'teams.team_name', 'projects.project_name')->get();




        // dd( $check_on_going_project);

       return view('admin.projects.index', compact('employees','projectManager'))->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addproject()
    {
        $company= DB::table('azhrms_company_gen_info')->get();
        $location= DB::table('azhrms_company_location')->get();
        $user= DB::table('azhrms_employee')->get();
        
     
        return view('projects.addproject',compact('company','location','user',));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
       $save_project = Project::updateOrCreate(['id'=>$request->project_id],['project_name' => $request->project_name,'project_description' => $request->project_description,
       'planned_start_date' => $request->planned_start_date,'planned_end_date' => $request->planned_end_date,'actual_start_date' => $request->actual_start_date,
       'actual_end_date'=> $request->actual_end_date]);
       
       if ($save_project) {

            }else {
                Toastr::success('Project Fail to Create!','Error');
                return redirect()->route('user');
                // ->with('error','Employee Fail to add!');
            }

                Toastr::success('Project successfully Created!','Success');
                return redirect()->route('project.index');
                // ->with('success','Employee successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function submitproject(Request $request)
    {
        $this->validate($request, [
 
            'project_name'  => 'required|string|max:120',
            'company_id'  => 'required',
            'location_id'  => 'required',
            'emp_id'  => 'required',

            'project_description'  => 'required|string|max:120',
            'actual_end_date'  => 'required',
            'actual_start_date'  => 'required',
            'planned_end_date'  => 'required',
            'planned_start_date'  => 'required',
           
           
        ]);
        
    
        Project::create([
               
               'project_name' => $request->get('project_name'),
               'company_id' => $request->get('company_id'), 
               'location_id' => $request->get('location_id'),
               'emp_id' => $request->get('emp_id'),
               'planned_start_date' => $request->get('planned_start_date'),
               'project_description' => $request->get('project_description'),
               'actual_end_date' => $request->get('actual_end_date'), 
               'actual_start_date' => $request->get('actual_start_date'),
               'planned_end_date' => $request->get('planned_end_date'),
                      
           ]);
    
           Log::debug("all".print_r($request->all(),true));
    
           return Redirect::to('view-project')->with('success',' Created Successfully!');
       }
    
    
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function viewproject()
    {
        if(Auth::user()->role=='1') {
   
            $projects = DB::table('projects')->select('emp_id','project_name','azhrms_employee.emp_nick_name',
            'projects.id as id','azhrms_company_gen_info.c_name','azhrms_company_location.l_name')
            ->join('azhrms_company_gen_info','projects.company_id','=','azhrms_company_gen_info.id')
            ->join('azhrms_company_location','projects.location_id','=','azhrms_company_location.id')
            ->join('azhrms_employee','projects.emp_id','=','azhrms_employee.id')
            ->where('projects.deleted_at','=',null)
            ->get(); 
         }
         return view('projects.viewproject',compact('projects',));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::count();
        // $project = Project::where();

        $check_exist_team = ProjectManager::join('users','users.id','=', 'project_managers.user_id')
        // ->join('team_members', 'team_members.employee_id', 'users.id')
        ->join('projects', 'projects.id', 'project_managers.project_id')
        ->join('teams', 'teams.user_id', 'users.id')
        ->where('project_managers.project_id', $id)
        ->select('teams.id as team_id')->first();

        $check_on_going_project = ProjectManager::join('users','users.id','=', 'project_managers.user_id')
        // ->join('team_members', 'team_members.employee_id', 'users.id')
        ->join('projects', 'projects.id', 'project_managers.project_id')
        ->join('teams', 'teams.user_id', 'users.id')
        ->where('project_managers.project_id', $id)->count();



        // dd($check_exist_team->team_id);

        if ( $check_on_going_project > 0) {
            $removeProject = Project::where('id',$id)->delete();
            $removeTeam = Team::where('id',$check_exist_team->team_id)->delete();
            // Toastr::success('Project Removal successful!','Success');
            // return redirect()->back();
        }else {

            $removeProject = Project::where('id',$id)->delete();
        }
        
        // $removeProject = Project::where('id',$id)->delete();

        

        // if ($project == 0) {
           
        //     Toastr::info('There is no Project! Please add Project.','Info');
        //     return redirect()->route('project.index');
    
        //     }else
            //  if (!$removeProject){
            //     Toastr::error('Attempt to Remove Project Fail try again!','Error');
            //     return redirect()->back();
            //      }

            //      else 
            //      {
                    // Toastr::success('Attempt to Remove Project Fail try again!','Error');
                    // return redirect()->back();
                    // }
    
                    Toastr::success('Project Removal successful!','Success');
                    return redirect()->back();
                
                // }
    }


    public function UserProjectIndex()
    {
        $userProject = auth()->user()->id;
        

        return view('admin.projects.users.project.index')->with('users_project');
    }
}
