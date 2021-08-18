<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshift extends Model
{
    use HasFactory;
    protected $table = 'azhrms_work_shift';
    protected $fillable = ['name','hours_per_day','start_time','end_time',];
}
