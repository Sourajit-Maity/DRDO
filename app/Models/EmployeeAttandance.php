<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeAttandance extends Model
{
    use HasFactory;
    use SoftDeletes; 

    protected $table = 'azhrms_employee_attandance';
    protected $fillable = [
        'emp_id','date','in_time','status',
        'out_time','shift_id','total_duration','remarks','deleted_at','status_flag',
    ];
}
