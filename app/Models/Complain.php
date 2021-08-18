<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Hash;

class Complain extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'azhrms_complain';
    protected $fillable = [
        'emp_id','complain','notes','deleted_at','complain_against_id',
    ];
}
