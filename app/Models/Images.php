<?php

namespace App\Models;

class Images extends BaseModel
{


    protected $fillable = ['scholarship_application_id', 'url', 'image_for'];

    public function scholarshipApplication()
    {
        return $this->belongsTo(ScholarshipApplication::class);
    }
}
