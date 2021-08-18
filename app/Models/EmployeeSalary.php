<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    use HasFactory;
    protected $table = 'azhrms_employee_salary';
    protected $fillable = [
        'emp_id','committed_amount','ctc_per_month','esi_number',
        'pf_uan_no','pf_no','ctc_per_annum','payroll_org','pf_effective_date',
    ];
}
