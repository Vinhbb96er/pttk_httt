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

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
}
