<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeExamScore extends Model
{
    use HasFactory;
    protected $table = 'azhrms_exam_score';
    protected $fillable = [
        'emp_id','training_given_by_id','exam_score_date', 'exam_score_time','subject_id','topics',
        'duration_from','duration_to','deleted_at','exam_score',
    ];
}
