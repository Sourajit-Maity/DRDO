<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeBankDetails extends Model
{
    use HasFactory;
    protected $table = 'azhrms_employee_bank_details';
    protected $fillable = [
        'acnt_holder_name','emp_id','bank_name','branch_name','account_number','neft_code','ifsc_code',
    ];
}
