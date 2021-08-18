<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AzhrmsDisciplinaryactiontypemaster extends Model
{
    //use HasFactory;
    protected $table = 'azhrms_corporateactiontypemasters';
    protected $fillable = [
        'description'
      ];
}
