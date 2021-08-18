<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobShift extends Model
{
    use HasFactory; 
    protected $table = 'job_shift';
    protected $fillable = [
        'serial_no','job_id','crm_id','words','shifted_from','shifted_to',
        'shifted_date','delivery_date','payable'
    ];
}
