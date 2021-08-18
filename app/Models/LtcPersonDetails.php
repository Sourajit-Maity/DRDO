<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LtcPersonDetails extends Model
{
    use HasFactory; 
    protected $table = 'leave_travel_person_details';
    protected $fillable = [
        'emp_id', 'person_name','ltc_application_id'
    ];
}
