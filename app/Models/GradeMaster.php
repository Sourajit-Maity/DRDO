<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeMaster extends Model
{
    use HasFactory; 
    protected $table = 'azhrms_grade_master';
    protected $fillable = [
        'grade_master'
    ];
}
