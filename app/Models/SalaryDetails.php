<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryDetails extends Model
{
    use HasFactory; 
    use SoftDeletes;
    protected $table = 'salary_details';
    protected $fillable = [
        'emp_id','salary_issuer_id','paid_amount','payment_date','salary_for_month',
        'salary_status','remarks','deleted_at','payment_bank','due'
    ];
}
