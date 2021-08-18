<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineMaster extends Model
{
    use HasFactory;
    protected $table = 'vaccine_master';
    protected $fillable = [
        'vaccine_name', 'vaccine_dose','others'
    ];
}
