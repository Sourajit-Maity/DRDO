<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimetrackerReview extends Model
{
    use HasFactory;
    protected $table = 'azhrms_time_tracker_review';
    protected $fillable = [
        'review','emp_id',
    ];
}
