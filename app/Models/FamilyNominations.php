<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyNominations extends Model
{
    use HasFactory;
    protected $table = 'azhrms_employee_family_nominations';
    protected $fillable = [
        'emp_id','gpf_pran_no','gpf_pran_doc','dcr_doc','family_declaration_doc','is_approved'
        
    ];
}
