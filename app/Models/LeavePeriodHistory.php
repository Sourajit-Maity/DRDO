<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeavePeriodHistory extends Model
{
    use HasFactory;
    protected $table = 'azhrms_leave_period_history';
    protected $fillable = [
        'leave_period_start_month', 'leave_period_start_date','created_at',
    ];
}
