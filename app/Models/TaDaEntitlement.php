<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaDaEntitlement extends Model
{
    use HasFactory;
    protected $table = 'ta_da_entitlement';
    protected $fillable = [
        'entitlement_name', 'travel_by',
    ];
}
