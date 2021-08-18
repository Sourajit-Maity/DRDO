<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankMaster extends Model
{
    use HasFactory; 
    use SoftDeletes;
    protected $table = 'azhrms_banks';
    protected $fillable = [
        'bank_name', 'bank_ifsc_no','branch_name',
    
    ];
}
