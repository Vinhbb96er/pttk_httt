<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'id',
        'patient_id',
        'faculty_id',
        'create_date',
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

    public function setIdAttribute($value)
    {
        $pre = config('settings.pre_id.registration');
        $numberOf = $this->all()->count() + 1;
        $length = 10 - strlen($pre . $numberOf);
        for ($i = 0; $i < $length; $i++) {
            $pre .= 0;
        }

        return $this->attributes['id'] = $pre . $numberOf;
    }
}
