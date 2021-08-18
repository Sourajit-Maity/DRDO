<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeClaim extends Model 
{
    use HasFactory;  
    protected $table = 'azhrms_claim_details';
    protected $fillable = [
        'designation_id','emp_id','cas_id','directorate','telephone_no','bank_account_no','landline_no',
        'landline_amount','landline_service_tax','landline_total','approved_by'
    ];


   
}
