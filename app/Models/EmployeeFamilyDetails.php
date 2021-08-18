<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeFamilyDetails extends Model
{
    use HasFactory;
    protected $table = 'employee_family_details';
    protected $fillable = [
        'emp_id','member_name','dob','contact_no','relation','addhar_no','maritial_status',
       
    ];
}
