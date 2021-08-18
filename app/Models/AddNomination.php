<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddNomination extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'add_nomination_insurance_employee';
    protected $fillable = [
        'emp_id', 'nomination_type','member_name','member_address','relation','age',
        'amount_share','contingencies','other_details','amount_share_other','deleted_at','is_approved'
       
    
    ];
}
