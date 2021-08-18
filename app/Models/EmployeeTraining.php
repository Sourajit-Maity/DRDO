<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTraining extends Model
{
    use HasFactory;
    protected $table = 'azhrms_training';
    protected $fillable = [
        'emp_id','training_given_by_id','training_date', 'training_time','subject_id','topics',
        'duration_from','duration_to','deleted_at',
    ];
}
