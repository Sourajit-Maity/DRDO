<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leave extends Model 
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use HasFactory;
    protected $table = 'leaves';
    protected $fillable = [
        'emp_id',
        'leave_type',
        'date_from',
        'date_to',
        'days',
        'reason',
        'personal_id',
        'designation_id',
        'dept_id',
        'dept_phone_no',
        'sunday_holiday',
        'leave_address',
        'phone_no',
        'employee_type'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'emp_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved',true);
    }
}
