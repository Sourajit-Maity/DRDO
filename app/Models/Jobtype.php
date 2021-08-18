<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobtype extends Model
{
    use HasFactory;
    protected $table = 'azhrms_jobtype';
    protected $fillable = [
        'job_type',
    ];
}
