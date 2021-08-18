<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLanguage extends Model
{
    use HasFactory;
    protected $table = 'employee_language';
    protected $fillable = [
        'emp_id','language_id','proficiency',
    ];
}
