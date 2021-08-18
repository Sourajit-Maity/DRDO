<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveTravelConcessionType extends Model
{
    use HasFactory;
    protected $table = 'leave_travel_concession_type';
    protected $fillable = [
        'leave_travel_concession'
    ];
} 
