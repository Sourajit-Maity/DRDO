<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubRole extends Model
{
    protected $table = 'azhrms_user_role_categories';
    protected $fillable = [
        'respname', 'role_id','resp_display_name','is_assignable','is_predefined',
    ];
}