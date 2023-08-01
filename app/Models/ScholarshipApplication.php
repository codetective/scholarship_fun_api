<?php

namespace App\Models;


class ScholarshipApplication extends BaseModel
{
    protected $fillable = [
        'id',
        'application_code',
        'status',
        'review_status',
        'name',
        'gender',
        'email',
        'dob',
        'disability',
        'programme_of_study',
        'course_of_study',
        'lga',

    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function documents()
    {
        return $this->hasOne(Documents::class, 'scholarship_application_id', 'id');
    }

    public function review()
    {
        return $this->hasOne(Reviews::class);
    }
}
