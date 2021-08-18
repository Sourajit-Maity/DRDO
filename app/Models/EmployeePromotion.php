<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePromotion extends Model
{
    use HasFactory;
    protected $table = 'azhrms_employee_promotion';
    protected $fillable = [
        'emp_id','promotion_date','effective_from','last_designation',
        'last_salary','letters','ctc_per_annum','payroll_org','pf_effective_date',
    ];
}
