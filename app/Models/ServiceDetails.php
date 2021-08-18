<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceDetails extends Model
{
    use HasFactory; 
    use SoftDeletes;
    protected $table = 'drdo_details_service';
    protected $fillable = [
        'emp_id', 'dept','period_from','period_to','post_held','pay',
        'additions_pay','details','upload_doc',
        'deleted_at','is_approved'
    
    ];
}
