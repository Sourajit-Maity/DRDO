<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEducation extends Model
{
    use HasFactory;
    protected $table = 'azhrms_employee_edu_details';
    protected $fillable = [
        'emp_id','emp_education_id','ins_name','degree','grade','notes','year',
        'edu_doc',
    ];
}
