<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeVaccine extends Model
{
    use HasFactory; 
    use SoftDeletes; 
    protected $table = 'employee_vaccine';
    protected $fillable = [
        'vaccine_id', 'dose_taken','others_dose','emp_id','date_taken','vaccine_certificate'
    ];
}
