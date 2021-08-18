<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamHandover extends Model 
{
    use HasFactory; 
    use SoftDeletes;
    protected $table = 'team_handover';
    protected $fillable = [
        'handover_from_date','emp_id','handover_emp_id','handover_reason','handover_to_date','deleted_at'
    ];
}
