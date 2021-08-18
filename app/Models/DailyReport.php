<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyReport extends Model
{
    use HasFactory;
    use SoftDeletes; 

    protected $table = 'azhrms_daily_report';
    protected $fillable = [
        'report_date','report_time','job_type_id','job_category_id',
        'crm_id','words','job_id','deleted_at','emp_id','job_description',
    ];
}
