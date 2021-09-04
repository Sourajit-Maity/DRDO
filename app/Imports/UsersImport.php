<?php
  
namespace App\Imports;
  
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
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

  
//class UsersImport implements ToModel, WithHeadingRow 
class UsersImport implements ToCollection, WithHeadingRow 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    //public function model(array $row )
    public function collection(Collection $rows)
    {
        DB::beginTransaction();

        try {
            foreach ($rows as $row) 
            {
                $employee = Employee::create([
                        'father_name'     => $row['father_name'],
                        'mother_name'    => $row['mother_name'], 
                        'emp_lastname'    => $row['emp_lastname'], 
                        'emp_firstname'    => $row['emp_firstname'], 
                        'emp_nick_name' => $row['emp_nick_name'],
                        'designation' => $row['designation'], 
                        'operational_company_id'     => $row['operational_company_id'],
                        'emp_code'    => $row['emp_code'], 
                        'operational_company_location_id'    => $row['operational_company_location_id'], 
                        'operational_company_loc_dept_id'    => $row['operational_company_loc_dept_id'], 
                        'emp_pan_num'     => $row['emp_pan_num'],
                        'emp_aadhar_num'    => $row['emp_aadhar_num'], 
                        'emp_street1'    => $row['emp_street1'], 
                        'emp_street2'  => $row['emp_street2'],
                        'emp_mobile'    => $row['emp_mobile'], 
                        'emp_work_telephone'     => $row['emp_work_telephone'],
                        'emp_hm_telephone'    => $row['emp_hm_telephone'], 
                        'emp_work_email'    => $row['emp_work_email'], 
                        'emp_pincode'    => $row['emp_pincode'],
                        // 'city_code'  => $row['city_code'],
                        // 'state_code'  => $row['state_code'],
                        // 'district_code'  => $row['district_code'],
                        'emp_birthday'  => $row['emp_birthday'],
                        'emp_bloodgroup'  => $row['emp_bloodgroup'],
                        'emp_gender'  => $row['emp_gender'],
                        'emp_marital_status'  => $row['emp_marital_status'],
                        // 'emp_religion_id'  => $row['emp_religion_id'],
                        // 'emp_nationality_id'  => $row['emp_nationality_id'],
                        'emp_language'  => $row['emp_language'],
                       // 'reporting_to'  => $row['reporting_to'],
                        'emp_status_type'  => $row['emp_status_type'],
                        //'date_of_superannuation'  => $row['date_of_superannuation'],
                       

                ]);
                Log::debug('read'.print_r($employee->id,true));
                
                    $user = User::create([
                            'name'     => $row['name'],
                            'email'    => $row['email'], 
                            'emp_id'    => $employee->id, 
                            'role'    => $row['role'], 
                            'password' => \Hash::make($row['password']),
                        ]);


                $education = EmployeeEducation::create([
                    'emp_id'    => $employee->id, 
                    // 'emp_education_id'  => $row['emp_education_id'],
                    // 'ins_name'  => $row['ins_name'],
                    // 'degree'  => $row['degree'],
                    // 'grade'  => $row['grade'],
                    // 'year'  => $row['year'],
                ]); 
                $skills = EmployeeSkills::create([
                    'emp_id'    => $employee->id, 
                ]);
                $bank = EmployeeBankDetails::create([
                    'emp_id'    => $employee->id, 
                ]);
                $family = EmployeeFamilyDetails::create([
                    'emp_id'    => $employee->id, 
                ]);
                $salary = EmployeeSalary::create([
                    'emp_id'    => $employee->id, 
                ]);
                $assets = EmployeeAssets::create([
                    'emp_id'    => $employee->id, 
                ]);
                $promotion = EmployeePromotion::create([
                    'emp_id'    => $employee->id, 
                ]);
            }
       
        DB::commit();

    }

    catch ( \Exception $e ) {
        DB::rollback();
        Log::error ( " :: EXCEPTION :: ".$e->getMessage()."\n".$e->getTraceAsString() );

        abort(333);
    }

    } 
}