<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeWarning extends Model
{
    use HasFactory;
    protected $table = 'azhrms_employee_warning';
    protected $fillable = [
        'emp_id','warning_given_id','date','reason','deleted_at','warning_header','warning_emp_name','issuer_name',
    ];
}
