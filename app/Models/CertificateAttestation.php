<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CertificateAttestation extends Model
{
    use HasFactory; 
    use SoftDeletes;
    protected $table = 'drdo_certificate_attestation';
    protected $fillable = [
        'emp_id', 'medical_exam_no','medical_exam_date','medical_exam_certificate','character_no','character_certificate',
        'allegiance_no','allegiance_certificate','secrecy_no','secrecy_certificate','confirmation_no','confirmation_details',
        'confirmation_certificate','deleted_at','is_approved'
    
    ]; 
}
