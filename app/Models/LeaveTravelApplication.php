<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveTravelApplication extends Model
{
    use HasFactory;
    use SoftDeletes; 
    protected $table = 'leave_travel_application';
    protected $fillable = [
        'emp_id', 'designation_id','date_of_joining','present_pay_npa_si','employee_type',
        'home_town', 'spouse_ltc','hometown_ltc','destination_ltc','single_fare',
        'advance', 'declare_check','total_person_availed','ticket_file','leave_travel_type_id','deleted_at',
        'is_approved','date_from','date_to','days','reason','leave_type_offer'
    ];
}
