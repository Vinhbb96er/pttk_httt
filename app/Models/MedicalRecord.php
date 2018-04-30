<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = [
        'id',
        'patient_id',
        'faculty_id',
        'user_id',
        'create_date',
        'patient_status',
        'bed_number',
        'status',
        'note',
    ];

    public $incrementing = false;

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setIdAttribute($value)
    {
        $pre =  config('settings.pre_id.medical_record');
        $numberOf = $this->all()->count() + 1;
        $length = 10 - strlen($pre . $numberOf);
        for ($i = 0; $i < $length; $i++) {
            $pre .= 0;
        }

        return $this->attributes['id'] = $pre . $numberOf;
    }
}
