<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeTaDaDetails extends Model
{
    use HasFactory; 
    use SoftDeletes; 
    protected $table = 'employee_ta_da_details';
    protected $fillable = [
        'emp_id', 'dir_id','hod_id','ta_da_advance','hall_ordinary_da',
        'travel_by', 'ta_entitlement_id','location_from','location_to','date_from',
        'date_to', 'days','reason','remarks','dir_aproval','hod_aproval',
        'deleted_at',
        'hod_name', 'hod_department','hod_designation',
        'emp_name', 'emp_dept','cas_no','phone_no','emp_designation',
        'emp_gpf', 'basic_pay','grade_pay','authority_move','temp_move','dir_name',
    ];
}
