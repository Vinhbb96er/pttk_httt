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
}
