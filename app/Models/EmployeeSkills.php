<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSkills extends Model
{
    use HasFactory;
    protected $table = 'azhrms_employee_skill_details';
    protected $fillable = [
        'emp_id','emp_skill_id','skill_grade',
    ];
}
