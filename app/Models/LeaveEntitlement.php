<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveEntitlement extends Model
{
    use HasFactory;
    protected $table = 'azhrms_leave_entitlement';
    protected $fillable = [
        'emp_number', 'no_of_days','days_used','leave_type_id',
        'period','credited_date','note','deleted','company_id',
    ];
}
