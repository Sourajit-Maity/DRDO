<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;
   
    protected $table = 'azhrms_company_assets';
    protected $fillable = [
        'assets_name','assets_details','emp_id',
    ];
}
