<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyGenInfo extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'azhrms_company_gen_info';
    protected $fillable = [
        'c_name', 'tax_id','registration_number','note','res_company_name','company_logo',
    
    ];
}
