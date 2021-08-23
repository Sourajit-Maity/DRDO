<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
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
use App\Models\Jobtype; 
use App\Models\CompanyLocation;
use App\Models\Assets;
use App\Models\EmployeeAssets;
use App\Models\Workshift;
use App\Models\EmployeeFamilyDetails;
use App\Models\EmployeePromotion;
use App\Models\EmployeeSalary;
use App\Models\FamilyNominations;
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
use App\Notifications\AssetsNotification;
use App\Notifications\AssetsReturnNotification;
use App\Notifications\TaskCompleted;
use Illuminate\Support\Facades\Notification;
use App\Listeners\SendComplainNotification;


class EmployeeController extends Controller
{
   
    public function getlocation($id) 
    {
        $companylocation = DB::table("azhrms_company_location")->where("operational_company_id",$id)->pluck("l_name","id");
        return json_encode($companylocation);
    }
    
    public function getunit($id) 
    {
        $unit= DB::table("azhrms_company_location_department")->where("operational_company_location_id",$id)->get();
        return json_encode($unit);
    }


    public function getdistrict($id) 
    {
        $district= DB::table("azhrms_company_district")->where("state_id",$id)->get();
        return json_encode($district);
    }

    public function getrole($id) 
    {
        $jobrole = DB::table("azhrms_user_role_categories")->where("role_id",$id)->pluck("respname","id");
        return json_encode($jobrole);
    }

    public function submitemployee(Request $request)
   {
       
    }



   public function viewemployee(Request $request)

   {
    $currentuserid = Auth::user()->emp_id;

    $emp_comp_id = Employee::where('azhrms_employee.id',$currentuserid)->value('operational_company_id');

    $comp_id = CompanyGenInfo::where('azhrms_company_gen_info.id',$emp_comp_id)->value('id');

  
    //Log::debug("ids".print_r($comp_id,true));
    if(Auth::user()->role=='1') {

       $employee = DB::table('azhrms_employee')->select('emp_lastname','emp_firstname','emp_middle_name',
       'emp_nick_name','operational_company_id','emp_food_habit','emp_code',
       'operational_company_location_id', 'operational_company_loc_dept_id','emp_gender','emp_marital_status','emp_religion_id',
        'emp_street1','emp_street2','azhrms_company_gen_info.c_name',
        'emp_work_email',
       'emp_img','azhrms_employee.id as id')
       ->join('azhrms_company_gen_info','azhrms_employee.operational_company_id','=','azhrms_company_gen_info.id')
       ->where('azhrms_employee.deleted_at','=',null)
       ->get(); 
    }
    elseif(Auth::user()->role=='2'){
        $employee = DB::table('azhrms_employee')->select('emp_lastname','emp_firstname','emp_middle_name',
        'emp_nick_name','operational_company_id','emp_food_habit','emp_code',
        'operational_company_location_id', 'operational_company_loc_dept_id','emp_gender','emp_marital_status','emp_religion_id',
         'emp_street1','emp_street2','azhrms_company_gen_info.c_name',
         'emp_work_email',
        'emp_img','azhrms_employee.id as id')
        ->join('azhrms_company_gen_info','azhrms_employee.operational_company_id','=','azhrms_company_gen_info.id')
        ->where('azhrms_employee.operational_company_id',$comp_id)
        ->where('azhrms_employee.deleted_at','=',null)
        ->get(); 
    }
    else{
        $employee = DB::table('azhrms_employee')->select('emp_lastname','emp_firstname','emp_middle_name',
        'emp_nick_name','operational_company_id','emp_food_habit','emp_code',
        'operational_company_location_id', 'operational_company_loc_dept_id','emp_gender','emp_marital_status','emp_religion_id',
         'emp_street1','emp_street2','azhrms_company_gen_info.c_name',
         'emp_work_email',
        'emp_img','azhrms_employee.id as id')
        ->join('azhrms_company_gen_info','azhrms_employee.operational_company_id','=','azhrms_company_gen_info.id')
        ->where('azhrms_employee.id',$currentuserid)
        ->where('azhrms_employee.deleted_at','=',null)
        ->get(); 
    }

      return view('employee.viewemployee',compact('employee',));
   } 

  

   public function getldlocation($ld_id) 
   {
       $editcompanylocation = DB::table("azhrms_company_location")->where("operational_company_id",$ld_id)->pluck("l_name","id");
       return json_encode($editcompanylocation);
   }
   
   public function getldunit($ld_id) 
   {
       $editunit= DB::table("azhrms_company_location_department")->where("operational_company_location_id",$ld_id)->pluck("d_name","id");
       return json_encode($editunit);
   }



   public function deleteemployee(Request $request,$id)
    {

        Employee::where('id',$id)->delete();
        
        return Redirect::back();
    }
    


    

    public function editemployeetab(Request $request,$id)
    {
        //$employee = Employee::findOrFail($id);

        $employee= DB::table('azhrms_employee')->select('emp_status','emp_nationality_id','emp_lastname','emp_firstname','emp_middle_name',
        'emp_nick_name','cadre_id','emp_birthday','operational_company_id','emp_food_habit','emp_language',
        'work_country_code','work_area_code','area_code_home','country_code_home','country_code_mobile','area_code_mobile',
        'operational_company_location_id', 'operational_company_loc_dept_id','emp_gender','emp_marital_status','emp_religion_id',
        'emp_pan_num', 'emp_aadhar_num','emp_other_id','emp_bloodgroup','emp_street1','emp_street2','related_person',
        'district_code', 'emp_pincode','emp_hm_telephone','emp_mobile','emp_work_telephone','emp_work_email','city_code','state_code',
        'emp_status_type','emp_code','org_age', 'joined_date','emp_oth_email','emp_img','reporting_to','shift','designation','job_role',
        'father_name','mother_name','disability','caste','date_of_superannuation','emp_ofc_mobile',
        'azhrms_employee.id as id','azhrms_employee_assets.property_name','azhrms_employee_assets.property_details',
        'azhrms_employee_assets.giving_date','azhrms_employee_assets.return_date','return_property_conditions',
        'acnt_holder_name','bank_name','branch_name','account_number','neft_code','ifsc_code',
        'promotion_date','effective_from','last_designation','last_salary','letters','issuer',
        'committed_amount','ctc_per_month','esi_number','pf_uan_no','pf_no','ctc_per_annum','payroll_org','pf_effective_date',
        'azhrms_employee_edu_details.emp_education_id','azhrms_employee_edu_details.ins_name','azhrms_employee_edu_details.degree',
        'azhrms_employee_edu_details.grade','azhrms_employee_edu_details.notes','azhrms_employee_edu_details.year',    
      'azhrms_employee_skill_details.emp_skill_id','azhrms_employee_skill_details.skill_grade',
      //'gpf_pran_no','gpf_pran_doc','dcr_doc','family_declaration_doc',
      'employee_family_details.addhar_no','employee_family_details.relation','employee_family_details.contact_no',    
      'employee_family_details.dob','employee_family_details.member_name')->
        join('azhrms_employee_assets', 'azhrms_employee.id', '=', 'azhrms_employee_assets.emp_id')->
        join('azhrms_employee_bank_details', 'azhrms_employee.id', '=', 'azhrms_employee_bank_details.emp_id')->
        join('azhrms_employee_edu_details', 'azhrms_employee.id', '=', 'azhrms_employee_edu_details.emp_id')->
        join('employee_family_details', 'azhrms_employee.id', '=', 'employee_family_details.emp_id')->
       // join('azhrms_employee_family_nominations', 'azhrms_employee.id', '=', 'azhrms_employee_family_nominations.emp_id')->

        join('azhrms_employee_salary', 'azhrms_employee.id', '=', 'azhrms_employee_salary.emp_id')->
        join('users', 'azhrms_employee.id', '=', 'users.emp_id')->
        join('azhrms_employee_skill_details', 'azhrms_employee.id', '=', 'azhrms_employee_skill_details.emp_id')->

        join('azhrms_employee_promotion', 'azhrms_employee.id', '=', 'azhrms_employee_promotion.emp_id')->
      
            where('azhrms_employee.id',$id)
            ->first();

          $currentid = Employee::where('azhrms_employee.id',$id)->value('operational_company_id');

          $currentcomid = CompanyGenInfo::where('azhrms_company_gen_info.id',$currentid)->value('id');

          $loc_id = CompanyLocation::where('azhrms_company_location.operational_company_id',$currentcomid)->get();

          $currentdesigid = Employee::where('azhrms_employee.id',$id)->value('designation');

          $desig_id = Role::where('azhrms_user_role.id',$currentdesigid)->value('id');

          $role_hierarchy = Role::where('azhrms_user_role.id',$currentdesigid)->value('role_hierarchy');
   
          $job_role_id = SubRole::where('azhrms_user_role_categories.role_id',$desig_id)->value('id');
   

           Log::debug("id2".print_r($loc_id,true));
        $state= DB::table("azhrms_company_state")->pluck("state_name","id");
        $empstate= DB::table('azhrms_employee')->select('azhrms_company_state.state_name as state_nme','azhrms_employee.state_code as state_code_id')->
        join('azhrms_company_state', 'azhrms_employee.state_code', '=', 'azhrms_company_state.id')
        ->where('azhrms_employee.id',$id)->get();

        $district= DB::table('azhrms_company_district')->get();
        $empdistrict= DB::table('azhrms_employee')->select('azhrms_company_district.district_name as district_nme','azhrms_employee.district_code as district_code_id')->
        join('azhrms_company_district', 'azhrms_employee.district_code', '=', 'azhrms_company_district.id')
        ->where('azhrms_employee.id',$id)->get();

        $country= DB::table('azhrms_company_country')->get();

        $nationality= DB::table('azhrms_nationalities')->get();
        $empnationality= DB::table('azhrms_employee')->select('azhrms_nationalities.name as nation_name','azhrms_employee.emp_nationality_id as emp_nationality')->
        join('azhrms_nationalities', 'azhrms_employee.emp_nationality_id', '=', 'azhrms_nationalities.id')
        ->where('azhrms_employee.id',$id)->get();

        $company= DB::table('azhrms_company_gen_info')->pluck("c_name","id");
        $empcompany= DB::table('azhrms_employee')->select('azhrms_company_gen_info.c_name as company_name','azhrms_employee.operational_company_id as operational_company')->
        join('azhrms_company_gen_info', 'azhrms_employee.operational_company_id', '=', 'azhrms_company_gen_info.id')
        ->where('azhrms_employee.id',$id)->get();


        $companylocation= DB::table('azhrms_company_location')->where('azhrms_company_location.operational_company_id',$currentid)->get();
        $empcompanylocation= DB::table('azhrms_employee')->select('azhrms_company_location.l_name as location_name','azhrms_employee.operational_company_location_id as operational_company_loc')->
        join('azhrms_company_location', 'azhrms_employee.operational_company_location_id', '=', 'azhrms_company_location.id')
        ->where('azhrms_employee.id',$id)->get();



        $locationdepartment= DB::table('azhrms_company_location_department')->pluck("d_name","id");
        $emplocationdepartment= DB::table('azhrms_employee')->select('azhrms_company_location_department.d_name as dept_name','azhrms_employee.operational_company_loc_dept_id as operational_company_loc_dept')->
        join('azhrms_company_location_department', 'azhrms_employee.operational_company_loc_dept_id', '=', 'azhrms_company_location_department.id')
        ->where('azhrms_employee.id',$id)->get();


        $religion= DB::table('azhrms_religion')->get();
        $empreligion= DB::table('azhrms_employee')->select('azhrms_religion.name as reli_name','azhrms_employee.emp_religion_id as emp_religion')->
        join('azhrms_religion', 'azhrms_employee.emp_religion_id', '=', 'azhrms_religion.id')
        ->where('azhrms_employee.id',$id)->get();

        $cadre= Jobtype::get();
        $empcadre= DB::table('azhrms_employee')->select('azhrms_jobtype.job_type as cadre_type_name','azhrms_employee.cadre_id as cadre')->
        join('azhrms_jobtype', 'azhrms_employee.cadre_id', '=', 'azhrms_jobtype.id')
        ->where('azhrms_employee.id',$id)->get();

        $education= DB::table('azhrms_education')->get();
        $educationemployee= DB::table('azhrms_employee_edu_details')-> select('azhrms_education.name','azhrms_employee_edu_details.notes','azhrms_employee_edu_details.id as id',
        'azhrms_employee_edu_details.grade','azhrms_employee_edu_details.degree','azhrms_employee_edu_details.ins_name','azhrms_employee_edu_details.emp_education_id',
        'azhrms_employee_edu_details.year','azhrms_employee_edu_details.emp_id',)->
        join('azhrms_education', 'azhrms_employee_edu_details.emp_education_id', '=', 'azhrms_education.id')->where('emp_id',$id)->get();

        

        $skills= DB::table('azhrms_skill')->get();

        $skillemployee= DB::table('azhrms_employee_skill_details')-> select('azhrms_skill.name','azhrms_skill.description',
        'azhrms_employee_skill_details.id as id',
        'azhrms_employee_skill_details.emp_skill_id',
        'azhrms_employee_skill_details.skill_grade','azhrms_employee_skill_details.emp_id',)->
        join('azhrms_skill', 'azhrms_employee_skill_details.emp_skill_id', '=', 'azhrms_skill.id')->where('emp_id',$id)->get();

        $salary= DB::table('azhrms_employee_salary')->where('emp_id',$id)->get();

        $promotion= DB::table('azhrms_employee_promotion')->where('emp_id',$id)->get();
        $promotionemployee= DB::table('azhrms_employee_promotion')->where('emp_id',$id)->
        select('azhrms_user_role.name','azhrms_employee_promotion.last_designation',
        'azhrms_employee_promotion.id as id','azhrms_employee_promotion.last_salary',
        'azhrms_employee_promotion.promotion_date','azhrms_employee_promotion.letters',
        'azhrms_employee_promotion.effective_from','azhrms_employee_promotion.emp_id',)->
        join('azhrms_user_role', 'azhrms_employee_promotion.last_designation', '=', 'azhrms_user_role.id')
        ->get();

        $empfamily= DB::table('employee_family_details')->where('emp_id',$id)->
        whereNotNull('member_name')->get();
        
        $employeefamily= DB::table('employee_family_details')->
        select('azhrms_employee.emp_nick_name','employee_family_details.member_name',
        'employee_family_details.id as id','employee_family_details.dob',
        'employee_family_details.contact_no','employee_family_details.relation',
        'employee_family_details.addhar_no','employee_family_details.emp_id',)->
        join('azhrms_employee', 'employee_family_details.emp_id', '=', 'azhrms_employee.id')->where('emp_id',$id)
        ->get();

        

       
        $assets= DB::table('azhrms_employee_assets')->select('azhrms_company_assets.assets_name','azhrms_company_assets.assets_details','azhrms_employee_assets.id as id','issuer',
        'azhrms_employee_assets.return_property_conditions','azhrms_employee_assets.return_date','azhrms_employee_assets.giving_date','azhrms_employee_assets.property_details',
        'azhrms_employee_assets.property_name','azhrms_employee_assets.emp_id',)->
        join('azhrms_company_assets', 'azhrms_employee_assets.property_name', '=', 'azhrms_company_assets.id')->where('emp_id',$id)->get();

        

        $type= DB::table('azhrms_employee_type')->get();
        $emptype= DB::table('azhrms_employee')->select('azhrms_employee_type.emp_type_name as emp_type_name_name','azhrms_employee.emp_status as emp_status_id')->
        join('azhrms_employee_type', 'azhrms_employee.emp_status', '=', 'azhrms_employee_type.id')
        ->where('azhrms_employee.id',$id)->get();

        $shift= DB::table('azhrms_work_shift')->get();
        $empshift= DB::table('azhrms_employee')->select('azhrms_work_shift.name as work_name','azhrms_employee.shift as shift_id')->
        join('azhrms_work_shift', 'azhrms_employee.shift', '=', 'azhrms_work_shift.id')
        ->where('azhrms_employee.id',$id)->get();     

        $emp_comp_id = Employee::where('azhrms_employee.id',$id)->value('operational_company_id');
    
        $comp_id = CompanyGenInfo::where('azhrms_company_gen_info.id',$emp_comp_id)->value('id');

        if($currentdesigid==7){
            $role_hierarchy=6;
        }
        else if($currentdesigid==6){
            $role_hierarchy=5;
        }
        else if($currentdesigid==5){
            $role_hierarchy=4;
        }
        else if($currentdesigid==4){
            $role_hierarchy=3;
        }
        else if($currentdesigid==3){
            $role_hierarchy=2;
        }
        else if($currentdesigid==2){
            $role_hierarchy=1;
        }
    
        $reporting= DB::table('azhrms_employee')
        //->join('azhrms_user_role', 'users.role', '=', 'azhrms_user_role.id')
        ->join('azhrms_user_role','azhrms_employee.designation','=','azhrms_user_role.id')
        ->select('azhrms_employee.emp_nick_name as nick_name','azhrms_employee.id as u_id')
        ->where('azhrms_employee.operational_company_id',$comp_id)
        ->where('azhrms_user_role.role_hierarchy','=',$role_hierarchy)
        ->get();

        //$empreporting= DB::table('azhrms_employee')->select('users.name as user_name','azhrms_employee.reporting_to as reporting')->
        //join('users', 'azhrms_employee.reporting_to', '=', 'users.id')
        //->where('azhrms_employee.id',$id)->get();
        $emp_comp_id = Employee::where('azhrms_employee.id',$id)->value('reporting_to');
        $empreporting= DB::table('azhrms_employee')->select('azhrms_employee.emp_nick_name as user_name','azhrms_employee.reporting_to as reporting')
       
        ->where('azhrms_employee.id',$emp_comp_id)->get();
        
        $language= DB::table('azhrms_employee_language')->get();
        $arrlanguages= DB::table('azhrms_employee')->where ('azhrms_employee.id',$id)->value("emp_language");
        
        $lng = explode(',', $arrlanguages); 
       
        $search = $id;
        $data = DB::table("azhrms_employee")
            ->select("azhrms_employee.*")
            ->whereRaw("find_in_set('".$search."',azhrms_employee.emp_language)")
            ->get(); 
        
        $emplanguage= DB::table('azhrms_employee')->select('azhrms_employee_language.lng_name as lang_name','azhrms_employee.emp_language as emp_lng_id')->
        join('azhrms_employee_language', 'azhrms_employee.emp_language', '=', 'azhrms_employee_language.id')
        ->where ('azhrms_employee.id',$id)->get();
       

        $roles= DB::table('azhrms_user_role')->pluck("name","id");
        $emprole= DB::table('azhrms_employee')->select('azhrms_user_role.name as role_name','azhrms_employee.designation as designation_id')->
        join('azhrms_user_role', 'azhrms_employee.designation', '=', 'azhrms_user_role.id')
        ->where('azhrms_employee.id',$id)->get();

        $emprolecategory= DB::table('azhrms_employee')->select('azhrms_user_role_categories.respname as respname_name','azhrms_employee.job_role as job_role_id')->
        join('azhrms_user_role_categories', 'azhrms_employee.job_role', '=', 'azhrms_user_role_categories.id')
        ->where('azhrms_employee.id',$id)->get();
        $rolecategory= DB::table('azhrms_user_role_categories')->where('azhrms_user_role_categories.role_id',$currentdesigid)->get();

        $bankdetails= DB::table('azhrms_employee_bank_details')->where('emp_id',$id)->get();

        //Log::debug("langs   ".print_r($lnginarray,true));

        return view('employee.editemployeetab',compact('company','promotionemployee','empshift','emptype','empreligion',
        'emprole','emprolecategory','empnationality','empstate','empdistrict','emplanguage','arrlanguages',
        'emplocationdepartment','empcompanylocation','empcompany','empreporting','lng','empfamily',
        'language','country','district','state','skillemployee','empcadre','cadre','rolecategory','roles','type','reporting','shift','assets','promotion','salary','educationemployee','bankdetails','education','skills','nationality','employee','companylocation','locationdepartment','religion'));
   }
 

   public function detailsemployee($id,Request $request)
   {

    
    $employee = Employee::where('id',$id)->get();
       
      
     
      return view('employee.detailsemployee',compact('employee',));
   } 


                public function updateemployeeinfo($id, Request $request)
                {

                    $this->validate($request, [
 
                        'emp_firstname'  => 'required|string|max:120',
                        'emp_lastname'  => 'required|string|max:120',
                        'emp_pan_num'  => 'required|string|max:20', 
                        'city_code'  => 'required',
                        'state_code'  => 'required',
                        'district_code'  => 'required',
                        'emp_pincode'  => 'required|max:6',                      
                        'mother_name' => 'required',
                        'father_name' => 'required',
                        'cadre_id' => 'required',
                        'emp_work_telephone'  => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|between:7,12',
                        'emp_street1'  => 'required',
                       
                       
                   
                    ]);

                    DB::beginTransaction();

                    try {
                    
                $employee= Employee::findOrFail($id);
                $employee->emp_firstname= $request->get('emp_firstname');
                $employee->emp_middle_name= $request->get('emp_middle_name');
                $employee->emp_lastname= $request->get('emp_lastname');
                $employee->emp_nick_name= $request->get('emp_nick_name');
                $employee->work_country_code= $request->get('work_country_code');
                $employee->work_area_code= $request->get('work_area_code');
                $employee->emp_pan_num= $request->get('emp_pan_num');
                $employee->emp_street1= $request->get('emp_street1');
                $employee->emp_street2= $request->get('emp_street2');
                $employee->city_code= $request->get('city_code');
                $employee->state_code= $request->get('state_code');
                $employee->district_code= $request->get('district_code');
                $employee->emp_pincode= $request->get('emp_pincode');
                $employee->emp_ofc_mobile= $request->get('emp_ofc_mobile');
                $employee->father_name= $request->get('father_name');
                $employee->mother_name= $request->get('mother_name');
                $employee->cadre_id= $request->get('cadre_id');
                $employee->emp_work_telephone= $request->get('emp_work_telephone');
                $employee->emp_work_email= $request->get('emp_work_email');

                $employee->update();


                DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }
 

             //Log::debug("all".print_r($request->all(),true));
             return Redirect::back()->with('success','You have successfully Updated.');
             
         }

public function updateemployeeaddress($id, Request $request)
{
    
    $employee= Employee::findOrFail($id);
  

    $employee->update();

    return Redirect::back();
             
}

public function updateemployeesalary($id, Request $request)
{
    DB::beginTransaction();

    try {
                $salary_id= EmployeeSalary::where('emp_id',$id)->value('id');
                $salary = EmployeeSalary::findOrFail($salary_id);

                $salary->committed_amount= $request->get('committed_amount');
                $salary->ctc_per_month= $request->get('ctc_per_month');
                $salary->esi_number= $request->get('esi_number');
                $salary->pf_uan_no= $request->get('pf_uan_no');
                $salary->pf_no= $request->get('pf_no');
                $salary->ctc_per_annum= $request->get('ctc_per_annum');
                $salary->payroll_org= $request->get('payroll_org');
                $salary->pf_effective_date= $request->get('pf_effective_date');
                $salary->emp_id = $id;

                $salary->update();
                DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }
 

    return Redirect::back();
             
}

public function updateemployeenomini($id, Request $request)
{
    DB::beginTransaction();

    try {
                $nomini_id= FamilyNominations::where('emp_id',$id)->value('id');
                $nomini = FamilyNominations::findOrFail($nomini_id);

                $nomini->gpf_pran_no= $request->get('gpf_pran_no');
              
                $nomini->emp_id = $id;


                $pranfile = time().'.'.$request->gpf_pran_doc->extension();  

                $request->gpf_pran_doc->move(public_path('assets/gpf'), $pranfile);
                $nomini->gpf_pran_doc= $pranfile;

                $fileName = time().'.'.$request->dcr_doc->extension();  

                $request->dcr_doc->move(public_path('assets/dcr'), $fileName);
                $nomini->dcr_doc= $fileName;

                $letters = time().'.'.$request->family_declaration_doc->extension();  

                $request->family_declaration_doc->move(public_path('assets/family'), $letters);
                $nomini->family_declaration_doc= $letters;

                $nomini->update();
                DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }
 
           //Log::debug("all".print_r($request->all(),true));
           return Redirect::back()->with('success','You have successfully file uplaod.')
           ->with('file',$letters,$fileName,$pranfile);
             
}

public function updateemployeebank($id, Request $request)
{
    
    DB::beginTransaction();

    try {
    $bankdetail_id = EmployeeBankDetails::where('emp_id',$id)->value('id');
    $bankdetails =EmployeeBankDetails::findOrFail($bankdetail_id);
    $bankdetails->acnt_holder_name= $request->get('acnt_holder_name');
    $bankdetails->bank_name= $request->get('bank_name');
    $bankdetails->branch_name= $request->get('branch_name');
    $bankdetails->account_number= $request->get('account_number');
    $bankdetails->neft_code= $request->get('neft_code');
    $bankdetails->ifsc_code= $request->get('ifsc_code');
    $bankdetails->emp_id = $id;

    $bankdetails->update();
    DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }

    return Redirect::back();
             
}
   public function updateemployeepromotion($id, Request $request)
        {
            DB::beginTransaction();

    try {
            $promotion_id =  EmployeePromotion::where('emp_id',$id)->value('id');
            $promotion = EmployeePromotion::findOrFail($promotion_id);

            $promotion->promotion_date	= $request->get('promotion_date');
            $promotion->effective_from= $request->get('effective_from');
            $promotion->last_designation= $request->get('last_designation');
            $promotion->last_salary= $request->get('last_salary');
            //$promotion->letters= 1;
            $letters = time().'.'.$request->letters->extension();  

            $request->letters->move(public_path('assets/letters'), $letters);
            $promotion->letters= $letters;
            $promotion->emp_id = $id;

            $promotion->update();
            DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }

            //Log::debug("all".print_r($request->all(),true));
            return Redirect::back()->with('success','You have successfully file uplaod.')
            ->with('file',$letters);
        }


       
        
        public function updateemployeepersonal($id, Request $request)
        {

            $this->validate($request, [
 
                'emp_nationality_id'  => 'required',
                'emp_birthday'  => 'required',
                'emp_marital_status'  => 'required', 
                'emp_religion_id'  => 'required',
                'emp_oth_email'  => 'required|email',
                'emp_nationality_id'  => 'required',
                'emp_bloodgroup'  => 'required|max:6',
                'emp_hm_telephone'  => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|between:8,14',
                'emp_gender'  => 'required',
                'disability'  => 'required',
                'caste' => 'required',
                //'date_of_superannuation' => 'required',
                'emp_mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|between:8,14',
               
           
            ]);

            $annutation = $request->get('emp_birthday');
            $annutation_age = Carbon::parse($annutation);
            $annutation_age2 = $annutation_age->addYears(60);

            Log::debug("annutation_age".print_r($annutation_age2,true));


            DB::beginTransaction();

    try {

            


            $employee= Employee::findOrFail($id);
            $arraytostring =  implode(',',$request->input('emp_language'));
            
            $employee->disability= $request->get('disability');
            $employee->caste= $request->get('caste');
            $employee->date_of_superannuation= $annutation_age;

            $employee->emp_birthday= $request->get('emp_birthday');
            $employee->emp_gender= $request->get('emp_gender');
            $employee->emp_marital_status= $request->get('emp_marital_status');
            $employee->emp_religion_id= $request->get('emp_religion_id');
            $employee->emp_oth_email= $request->get('emp_oth_email');
            $employee->emp_hm_telephone= $request->get('emp_hm_telephone');
            $employee->emp_mobile= $request->get('emp_mobile');
            $employee->emp_aadhar_num= $request->get('emp_aadhar_num');
            $employee->emp_other_id= $request->get('emp_other_id');
            $employee->emp_bloodgroup= $request->get('emp_bloodgroup');
            $employee->emp_nationality_id= $request->get('emp_nationality_id');
            $employee->related_person= $request->get('related_person');
            $employee->emp_food_habit= $request->get('emp_food_habit');
          
           
            $employee['emp_language'] = $arraytostring;
        
            $employee->update();
            DB::commit();
              
        } 
        catch (\Exception $e) {
            DB::rollback();
            
        }
        
            return Redirect::back();
                     
        }  
        
        public function updateemployeeteaminfo($id, Request $request)
        {
            DB::beginTransaction();

    try {
            $employee= Employee::findOrFail($id);

            $current = Carbon::now();
            $age = $request->get('joined_date');
            
            $org_age = $current->diffInDays($age);

            
            $employee->operational_company_id= $request->get('operational_company_id');
            $employee->operational_company_location_id= $request->get('operational_company_location_id');
            $employee->operational_company_loc_dept_id= $request->get('operational_company_loc_dept_id');
            $employee->emp_status_type= $request->get('emp_status_type');
            $employee->joined_date= $request->get('joined_date');
            $employee->emp_status= $request->get('emp_status');
            $employee->reporting_to= $request->get('reporting_to');
            $employee->shift= $request->get('shift');
            $employee->designation= $request->get('designation');
            $employee->job_role= $request->get('job_role');
            $employee->org_age= $org_age;
            $employee->emp_code= $request->get('emp_code');
        
            $employee->update();
            DB::commit();
              
        } 
        catch (\Exception $e) {
            DB::rollback();
            
        }
            Log::debug("all".print_r($request->all(),true));
            return Redirect::back();
                     
        } 



        public function addemployeeassets($id)
        {
     
            $empassets = Assets::get();
            $assets = Employee::findOrFail($id);
     
          return view('employee.addemployeeassets',compact('assets','empassets'));
        }
     
     
        public function submitemployeeassets($id, Request $request)
        {
            
           
     
            $assets = new EmployeeAssets();

                $assets->property_name	= $request->get('property_name');
                $assets->property_details= $request->get('property_details');
                $assets->giving_date= $request->get('giving_date');
                $assets->return_date= $request->get('return_date');
                $assets->emp_id = $id;
                $assets->issuer = Auth::user()->name;

                $assets->save();

                $emp_id = User::where('emp_id',$id)->value('id');
                $emp = User::find($emp_id);
                $admins = User::find(1);
                $issuerid = Auth::user()->id;

                $issuer = User::find($issuerid);

                Notification::send($admins, new AssetsNotification($admins)); 
                Notification::send($issuer, new AssetsNotification($issuer)); 
                Notification::send($emp, new AssetsNotification($emp)); 
          
           
            return Redirect::back()->with('success','Successfully Updated!');
        }


        public function editemployeeassets($id)
        {
            
    
                $empassets = Assets::get();
    
               // Log::debug("all".print_r($employee,true));
               $oldskill= DB::table('azhrms_employee_assets')->
            select('azhrms_company_assets.assets_details as assets_detail','azhrms_company_assets.assets_name as assets_nme',
            'azhrms_employee_assets.property_name as property_id','azhrms_employee_assets.property_details as details_id',)->  
            join('azhrms_company_assets', 'azhrms_employee_assets.property_name', '=', 'azhrms_company_assets.id')
            ->where('azhrms_employee_assets.id',$id)->get(); 
    
         
            $asset= EmployeeAssets::findOrFail($id);
           
            return view('employee.editemployeeassets',compact('asset','oldskill','empassets'));
       }

        public function updateemployeeassets($id, Request $request)
        {
              
            DB::beginTransaction();

    try {// $emp_id = Employee::where('emp_id',$id)->value('id');
                $assets = EmployeeAssets::findOrFail($id);

                $assets->property_name	= $request->get('property_name');
                $assets->property_details= $request->get('property_details');
                $assets->giving_date= $request->get('giving_date');
                $assets->return_date= $request->get('return_date');
                $assets->return_property_conditions= $request->get('return_property_conditions');
                $assets->emp_id = $request->get('emp_id');
                $assets->issuer = Auth::user()->name;

                $assets->update();
                DB::commit();


               $admins = User::find(1);
               $issuerid = Auth::user()->id;

               $issuer = User::find($issuerid);

                Notification::send($admins, new AssetsReturnNotification($admins)); 
                Notification::send($issuer, new AssetsReturnNotification($issuer)); 
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }


            Log::debug("all".print_r($request->all(),true));
            return Redirect::back()->with('success','Successfully Updated!');
            
        }

        public function addemployeeskills($id)
        {
     
            $employeeskill = Employee::findOrFail($id);
            $skills= DB::table('azhrms_skill')->get();
     
          return view('employee.addemployeeskills',compact('skills','employeeskill'));
        }
     
     
        public function submitemployeeskills($id, Request $request)
        {
            DB::beginTransaction();

            try {
            
         
            $skills = new EmployeeSkills();
            $skills->emp_id = $id;
            $skills->emp_skill_id= $request->get('emp_skill_id');
            $skills->skill_grade= $request->get('skill_grade');
            $skills->save();
            DB::commit();
              
        } 
        catch (\Exception $e) {
            DB::rollback();
            
        }
           
        return Redirect::back()->with('success','Successfully Updated!');
        }

        public function editemployeeskills($id)
        {
            $oldskill= DB::table('azhrms_employee_skill_details')->
            select('azhrms_skill.name as skill_name','azhrms_employee_skill_details.emp_skill_id as skill_id')->  
            join('azhrms_skill', 'azhrms_employee_skill_details.emp_skill_id', '=', 'azhrms_skill.id')
            ->where('azhrms_employee_skill_details.id',$id)->get(); 
            
            $empskills= DB::table('azhrms_skill')->get();
    
               // Log::debug("all".print_r($employee,true));
    
         
            $skills= EmployeeSkills::findOrFail($id);
           
            return view('employee.editemployeeskills',compact('skills','oldskill','empskills'));
       }

        public function updateemployeeskills($id, Request $request)
        {
            DB::beginTransaction();

            try {
                $skills = EmployeeSkills::findOrFail($id);
               
                $skills->emp_skill_id= $request->get('emp_skill_id');
                $skills->skill_grade= $request->get('skill_grade');
               
                $skills->emp_id = $request->get('emp_id');

                $skills->update();
                DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }

           // Log::debug("all".print_r($request->all(),true));
           return Redirect::back()->with('success','Successfully Updated!');
            
        }


        public function editemployeeeducation($id)
        {
            
            $azheducation= DB::table('azhrms_education')->get();
    
            $oldeducation = DB::table('azhrms_employee_edu_details')->
            select('azhrms_education.name as edu_name','azhrms_employee_edu_details.emp_education_id as edu_id')->  
            join('azhrms_education', 'azhrms_employee_edu_details.emp_education_id', '=', 'azhrms_education.id')
            ->where('azhrms_employee_edu_details.id',$id)->get();
    
         
            $eduemployee= EmployeeEducation::findOrFail($id);
           
            return view('employee.editemployeeeducation',compact('eduemployee','oldeducation','azheducation'));
       }

        public function updateemployeeeducation($id, Request $request)
        {
            DB::beginTransaction();

            try {
            
            $education =EmployeeEducation::findOrFail($id);

            $education->emp_id = $request->get('emp_id');
 
             $education->emp_education_id= $request->get('emp_education_id');
             $education->ins_name= $request->get('ins_name');
             $education->degree= $request->get('degree');
             $education->grade= $request->get('grade');
             $education->notes= $request->get('notes');
             $education->year= $request->get('year');

            $education->update();
            DB::commit();
              
        } 
        catch (\Exception $e) {
            DB::rollback();
            
        }

           // Log::debug("all".print_r($request->all(),true));
           return Redirect::back()->with('success','Successfully Updated!');
            
        }


        public function addemployeeeducation($id)
        {
            $azheducation= DB::table('azhrms_education')->get();
            $educationemp = Employee::findOrFail($id);
     
          //return view('employee.addemployeeeducation',compact('educationemp','azheducation'));
          return view('employee.addemployeeedu',compact('educationemp','azheducation'));
        }
     
     
        public function submitemployeeeducation($id, Request $request)
        {
            $request->validate([
                'moreFields.*.emp_education_id' => 'required',
                'moreFields.*.ins_name' => 'required',
                'moreFields.*.grade' => 'required',
                'moreFields.*.year' => 'required',
                'moreFields.*.emp_id' => 'required',
                'moreFields.*.degree' => 'required',
              
            ]); 

            DB::beginTransaction();

            try {
     
           // $education = new EmployeeEducation();

            //$education->emp_education_id= $request->get('emp_education_id');
           // $education->ins_name= $request->get('ins_name');
            //$education->degree= $request->get('degree');
           // $education->grade= $request->get('grade');
           // $education->notes= $request->get('notes');
            //$education->year= $request->get('year');
             //   $education->emp_id = $id;

              //  $education->save();
         
              
        
                foreach ($request->moreFields as $key => $value) {
                    EmployeeEducation::create($value);
                }
                DB::commit();
              
             } 
             catch (\Exception $e) {
                 DB::rollback();
                
             }
            Log::debug("all".print_r($id,true));
           
            return Redirect::back()->with('success','Successfully Updated!');
        }
        public function addemployeblooddoc($id)
        {
     
            $employeeblood = Employee::findOrFail($id);
     
          return view('employee.addemployeeblooddoc',compact('employeeblood'));
        }
     
     
        public function submitemployeeblooddoc($id, Request $request)
        {
            
          $request->validate([
      'blood_doc' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
           ]);
     
            $employee = Employee::findOrFail($id);

            
            $fileName = time().'.'.$request->blood_doc->extension();  

            $request->blood_doc->move(public_path('assets/blooddoc'), $fileName);
            $employee->blood_doc= $fileName;
        
            $employee->save();
        
            Log::debug("all".print_r($request->all(),true));
            return Redirect::to('view-employee')->with('success','You have successfully file uplaod.')
            ->with('file',$fileName); 
           
            return Redirect::to('view-employee')->with('success','Successfully Updated!');
        }

        public function addemployeimage($id)
        {
     
            $employeeimg = Employee::findOrFail($id);
     
          return view('employee.addemployeeimage',compact('employeeimg'));
        }
     
     
        public function submitemployeeimage($id, Request $request)
        {
            
            $request->validate([
                'emp_img' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
                     ]);
     
            $employee = Employee::findOrFail($id);

            
            $fileName = time().'.'.$request->emp_img->extension();  

            $request->emp_img->move(public_path('assets/images'), $fileName);
            $employee->emp_img= $fileName;
        
            $employee->save();
        
            Log::debug("all".print_r($request->all(),true));
            return Redirect::to('view-employee')->with('success','You have successfully file uplaod.')
            ->with('file',$fileName); 
           
            return Redirect::to('view-employee')->with('success','Successfully Updated!');
        }

        public function updateemployeeimage($id, Request $request)
        {

            

            $employee= Employee::findOrFail($id);
            $fileName = time().'.'.$request->emp_img->extension();  

            $request->emp_img->move(public_path('assets/images'), $fileName);
            $employee->emp_img= $fileName;
        
            $employee->update();
        
            Log::debug("all".print_r($request->all(),true));
            return Redirect::to('view-employee')->with('success','You have successfully file uplaod.')
            ->with('file',$fileName); 
                     
        }      
        

        public function addemployepancard($id)
        {
     
            $employeepan = Employee::findOrFail($id);
     
          return view('employee.addemployeepandoc',compact('employeepan'));
        }
     
     
        public function submitemployeepancard($id, Request $request)
        {
            
            $request->validate([
                'pan_doc' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
                     ]);
     
            $employee = Employee::findOrFail($id);

            
            $fileName = time().'.'.$request->pan_doc->extension();  

            $request->pan_doc->move(public_path('assets/pandoc'), $fileName);
            $employee->pan_doc= $fileName;
        
            $employee->save();
        
            Log::debug("all".print_r($request->all(),true));
            return Redirect::to('view-employee')->with('success','You have successfully file uplaod.')
            ->with('file',$fileName); 
           
            return Redirect::to('view-employee')->with('success','Successfully Updated!');
        }

        public function addemployeepromotion($id)
        {
     
            
            $promotion = Employee::findOrFail($id);
            $roles= DB::table('azhrms_user_role')->pluck("name","id");
            
     
          return view('employee.addemployeepromotion',compact('promotion','roles'));
        }
     
     
        public function submitemployeepromotion($id, Request $request)
        {
            $this->validate($request, [
 
                'promotion_date'  => 'required',
                'effective_from'  => 'required',
                'last_designation'  => 'required', 
                'last_salary'  => 'required',
                'letters' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',

            ]);
            
            DB::beginTransaction();

            try {
     
            $promotion = new EmployeePromotion();

           

            $promotion->promotion_date	= $request->get('promotion_date');
           $promotion->effective_from= $request->get('effective_from');
           $promotion->last_designation= $request->get('last_designation');
           $promotion->last_salary= $request->get('last_salary');
        
           $letters = time().'.'.$request->letters->extension();  

           $request->letters->move(public_path('assets/letters'), $letters);
           $promotion->letters= $letters;
                $promotion->emp_id = $id;

                $promotion->save();
                DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }
           
            Log::debug("all".print_r($request->all(),true));
            return Redirect::back()->with('success','You have successfully file uplaod.')
            ->with('file',$letters);
        }


        public function editemployeepromotion($id)
        {

            $promotion= EmployeePromotion::findOrFail($id);
            $roles= DB::table('azhrms_user_role')->pluck("name","id");
            $emprole= DB::table('azhrms_employee_promotion')->select('azhrms_user_role.name as role_name','azhrms_employee_promotion.last_designation as designation_id')->
            join('azhrms_user_role', 'azhrms_employee_promotion.last_designation', '=', 'azhrms_user_role.id')
            ->where('azhrms_employee_promotion.id',$id)->get();
           
            return view('employee.editemployeepromotion',compact('promotion','roles','emprole'));
        }


       public function updateemployepromotion($id, Request $request)
       {
        $this->validate($request, [
 
            'promotion_date'  => 'required',
            'effective_from'  => 'required',
            'last_designation'  => 'required', 
            'last_salary'  => 'required',
            'letters' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',

        ]);
        
           DB::beginTransaction();

         try {
               $promotion = EmployeePromotion::findOrFail($id);

            $promotion->promotion_date	= $request->get('promotion_date');
            $promotion->effective_from= $request->get('effective_from');
            $promotion->last_designation= $request->get('last_designation');
            $promotion->last_salary= $request->get('last_salary');
            $promotion->emp_id = $request->get('emp_id');
           
            $letters = time().'.'.$request->letters->extension();  

            $request->letters->move(public_path('assets/letters'), $letters);
            $promotion->letters= $letters;
            

            $promotion->update();
            DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }

            Log::debug("all".print_r($request->all(),true));
            return Redirect::back()->with('success','You have successfully file uplaod.')
            ->with('file',$letters);
       }

       public function addemployeedudoc($id)
        {
     
            $employeeedudocument = EmployeeEducation::findOrFail($id);
     
          return view('employee.addemployeeedudoc',compact('employeeedudocument'));
        }
     
     
        public function submitemployeeedudoc($id, Request $request)
        {
            
            $request->validate([
                'edu_doc' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
                     ]);
     
            $employee = EmployeeEducation::findOrFail($id);

            
            $fileName = time().'.'.$request->edu_doc->extension();  

            $request->edu_doc->move(public_path('assets/edudoc'), $fileName);
            $employee->edu_doc= $fileName;
        
            $employee->save();
        
            //Log::debug("all".print_r($request->all(),true));
            return Redirect::to('view-employee')->with('success','You have successfully file uplaod.')
            ->with('file',$fileName); 
           
          
        }



        public function addemployeefamilyinfo($id)
        {
     
            
            $family = Employee::findOrFail($id);
     
          return view('employee.addemployeefamily',compact('family'));
        }
     
     
        public function submitemployeefamilyinfo($id, Request $request)
        {
            
           
     
            $request->validate([
                'moreFields.*.member_name' => 'required',
                'moreFields.*.dob' => 'required',
                
                'moreFields.*.emp_id' => 'required',
                'moreFields.*.relation' => 'required',
              
            ]); 
              
        
                foreach ($request->moreFields as $key => $value) {
                    EmployeeFamilyDetails::create($value);
                }
              
           
            return Redirect::back()->with('success','Successfully Uploaded!');
        }


        public function editemployeefamilyinfo($id)
        {

            $family= EmployeeFamilyDetails::findOrFail($id);
           
            return view('employee.editemployeefamily',compact('family'));
       }

        public function updatefamilyinfo($id, Request $request)
        {
              
            DB::beginTransaction();

    try {
                $family = EmployeeFamilyDetails::findOrFail($id);

                $family->member_name	= $request->get('member_name');
                $family->dob= $request->get('dob');
                $family->relation= $request->get('relation');
                $family->contact_no= $request->get('contact_no');
                $family->addhar_no= $request->get('addhar_no');
                $family->emp_id = $request->get('emp_id');
                

                $family->update();
                DB::commit();
              
            } 
            catch (\Exception $e) {
                DB::rollback();
                
            }


            //Log::debug("all".print_r($request->all(),true));
            return Redirect::back()->with('success','Successfully Updated!');
            
        }


        public function addemployeaddhardoc($id)
        {
     
            $employeeaddhar = Employee::findOrFail($id);
     
          return view('employee.addemployeeaddhardoc',compact('employeeaddhar'));
        }
     
     
        public function submitemployeeaddhardoc($id, Request $request)
        {
            
            $request->validate([
                'addhar_certificate' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
                     ]);
     
            $employeeaddhar = Employee::findOrFail($id);

            
            $fileName = time().'.'.$request->addhar_certificate->extension();  

            $request->addhar_certificate->move(public_path('assets/addhar'), $fileName);
            $employeeaddhar->addhar_certificate= $fileName;
        
            $employeeaddhar->save();
        
            Log::debug("all".print_r($request->all(),true));
            return Redirect::back()->with('success','You have successfully file uplaod.')
            ->with('file',$fileName); 
           
            return Redirect::to('view-employee')->with('success','Successfully Updated!');
        }

        public function addemployedisabledoc($id)
        {
     
            $employeedisable = Employee::findOrFail($id);
     
          return view('employee.addemployeedisabledoc',compact('employeedisable'));
        }
     
     
        public function submitemployeedisabledoc($id, Request $request)
        {
            
            $request->validate([
                'disable_certificate' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
                     ]);
     
            $employeedisable = Employee::findOrFail($id);

            
            $fileName = time().'.'.$request->disable_certificate->extension();  

            $request->disable_certificate->move(public_path('assets/disable'), $fileName);
            $employeedisable->disable_certificate= $fileName;
        
            $employeedisable->save();
        
            Log::debug("all".print_r($request->all(),true));
            return Redirect::back()->with('success','You have successfully file uplaod.')
            ->with('file',$fileName); 
           
            return Redirect::to('view-employee')->with('success','Successfully Updated!');
        }

        public function addemployecastedoc($id)
        {
     
            $employeecaste = Employee::findOrFail($id);
     
          return view('employee.addemployeecastedoc',compact('employeecaste'));
        }
     
     
        public function submitemployeecastedoc($id, Request $request)
        {
            
            $request->validate([
                'caste_certificate' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
                     ]);
     
            $employeecaste = Employee::findOrFail($id);

            
            $fileName = time().'.'.$request->caste_certificate->extension();  

            $request->caste_certificate->move(public_path('assets/caste'), $fileName);
            $employeecaste->caste_certificate= $fileName;
        
            $employeecaste->save();
        
            Log::debug("all".print_r($request->all(),true));
            return Redirect::back()->with('success','You have successfully file uplaod.')
            ->with('file',$fileName); 
           
            return Redirect::to('view-employee')->with('success','Successfully Updated!');
        }

      


    }