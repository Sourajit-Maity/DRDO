<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Project extends Model
{
    protected $table = 'projects';
    // protected $guarded = [];
    protected $fillable = ['project_name','project_description','planned_start_date',
    'emp_id','company_id','location_id','deleted_at',
    'planned_end_date','actual_start_date','actual_end_date'];
}
