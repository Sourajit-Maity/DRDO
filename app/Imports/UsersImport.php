<?php
  
namespace App\Imports;
  
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Http\Request;

use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\CompanyGenInfo;
use App\Models\EmployeeLanguage;
use App\Models\Employee;
use App\Models\Usermanagement;
use App\Models\FamilyNominations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Datatables;
use Response,Config;
use App\Models\LeavePeriodHistory;
use App\Models\LeaveType;
use App\Models\WorkWeek;
use App\Models\Skills;
use App\Models\LeaveEntitlement;
use App\Models\EmployeeSkillGrade;
use App\Models\EmployeeSkills;
use App\Models\EmployeeEducation;
use App\Models\EmployeeType;
use App\Models\EmployeeFamilyDetails;
use App\Models\EmployeeAssets;
use App\Models\Workshift;
use App\Models\EmployeePromotion;
use App\Models\EmployeeSalary;
use App\Models\EmployeeBankDetails;

  
class UsersImport implements ToModel, WithHeadingRow 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row )
    {
       

        return new User([
            'name'     => $row['name'],
            'email'    => $row['email'], 
            'emp_id'    => $row['emp_id'], 
            'role'    => $row['role'], 
            'password' => \Hash::make($row['password']),
        ]);
          
        // return new Employee([
        //     'father_name'     => $row['father_name'],
        //     'mother_name'    => $row['mother_name'], 
        //     'emp_lastname'    => $row['emp_lastname'], 
        //     'emp_firstname'    => $row['emp_firstname'], 
        //     'emp_nick_name' => $row['emp_nick_name'],
        //     'designation' => $row['designation'], 
        //     'operational_company_id'     => $row['operational_company_id'],
        //     'emp_code'    => $row['emp_code'], 
        //     'operational_company_location_id'    => $row['operational_company_location_id'], 
        //     'operational_company_loc_dept_id'    => $row['operational_company_loc_dept_id'], 
        //     'emp_pan_num'     => $row['emp_pan_num'],
        //     'emp_aadhar_num'    => $row['emp_aadhar_num'], 
        //     'emp_street1'    => $row['emp_street1'], 
        //     'emp_mobile'    => $row['emp_mobile'], 
        //     'emp_work_telephone'     => $row['emp_work_telephone'],
        //     'emp_hm_telephone'    => $row['emp_hm_telephone'], 
        //     'emp_work_email'    => $row['emp_work_email'], 
        //     'emp_pincode'    => $row['emp_pincode'], 
        // ]);
       
 

    } 
}