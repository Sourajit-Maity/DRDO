<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkWeek extends Model
{
    
    use HasFactory;
    protected $table = 'azhrms_work_week';
    protected $fillable = [
        'operational_company_id', 'operational_company_location_id','operational_company_loc_dept_id','mon',
        'tue','wed','thu','fri','sat','sun',
    ];
}
