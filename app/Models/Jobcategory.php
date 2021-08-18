<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobcategory extends Model
{
    use HasFactory;
    protected $table = 'azhrms_jobcategory';
    protected $fillable = [
        'job_category',
    ];
}
