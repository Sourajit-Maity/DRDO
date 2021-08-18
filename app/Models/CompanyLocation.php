<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyLocation extends Model
{
    use HasFactory;
    protected $table = 'azhrms_company_location';
    protected $fillable = [
        'l_name', 'operational_company_id','district','city','address',
        'zip_code', 'phone','fax','notes','state','country_code','area_code',
    
    ];
}
