<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyLocationDepartment extends Model
{
    use HasFactory;
    protected $table = 'azhrms_company_location_department';
    protected $fillable = [
        'd_name', 'operational_company_location_id',
         'phone','fax','notes','type','country_code','area_code',
    
    ];
}
