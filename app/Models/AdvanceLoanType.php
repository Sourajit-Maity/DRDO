<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvanceLoanType extends Model
{
    use HasFactory;
    protected $table = 'advance_loan_type';
    protected $fillable = [
        'advance_loan_type_name'
    ];
}
