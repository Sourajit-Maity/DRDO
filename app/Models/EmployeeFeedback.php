<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeFeedback extends Model
{
    use HasFactory;
    protected $table = 'azhrms_employee_feedback';
    protected $fillable = [
        'feedback_category','feedback_type','emp_id','feedback_to_id','feedback_comment','deleted_at',
    ];
}
