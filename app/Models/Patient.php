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

    public $incrementing = false;

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function setIdAttribute($value)
    {
        $pre =  config('settings.pre_id.patient');
        $numberOf = $this->all()->count() + 1;
        $length = 10 - strlen($pre . $numberOf);
        for ($i = 0; $i < $length; $i++) {
            $pre .= 0;
        }

        return $this->attributes['id'] = $pre . $numberOf;
    }
}
