<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'id',
        'name',
        'gender',
        'birthday',
        'address',
        'phone',
        'image',
        'reception_date',
        'insurance_number',
        'expiration_date',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}
