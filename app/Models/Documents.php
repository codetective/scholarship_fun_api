<?php

namespace App\Models;


class Documents extends BaseModel
{

    protected $fillable = [
        'id',
        'scholarship_application_id',
        'certificate_of_origin',
        'birth_certificate_declaration',
        'fee_schedule',
        'fee_receipt',
        'attestation_letter',
        'applicant_picture',
        'admission_letter'
    ];

    public function scholarshipApplication()
    {
        return $this->belongsTo(ScholarshipApplication::class, 'scholarship_application_id');
    }
}
