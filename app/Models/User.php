<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'position_id',
        'faculty_id',
        'name',
        'birthday',
        'gender',
        'address',
        'phone',
        'email',
        'image',
        'participation_date',
        'role',
        'account',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'password',
        'remember_token',
    ];

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
}
