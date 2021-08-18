<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSkillGrade extends Model
{
    use HasFactory;
    protected $table = 'azhrms_employee_skill_grade';
    protected $fillable = [
        'skill_code','emp_code','grade',
    ];
}
