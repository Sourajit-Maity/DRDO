<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;
    protected $table = 'azhrms_leave_type';
    protected $fillable = [
        'name', 'exclude_in_reports_if_no_entitlement','operational_company_id','operational_company_location_id',
    ];
}
