<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalarySlab extends Model
{
    use HasFactory; 
    
    protected $table = 'salary_slab_master';
    protected $fillable = [
        'salary_slab'
    ];
}
