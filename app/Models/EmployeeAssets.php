<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAssets extends Model
{
    use HasFactory;
    protected $table = 'azhrms_employee_assets';
    protected $fillable = [
        'emp_id','property_name','property_details','giving_date',
        'return_date','return_property_conditions','issuer',
    ];
}
