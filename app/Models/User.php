<?php

namespace App\Models;

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

    public function setPassword($value)
    {
        return $this->attributes['password'] = brypt($value);
    }

    public function setIdAttribute($value)
    {
        $pre = config('settings.pre_id.staff');
        $numberOf = $this->all()->count() + 1;
        $length = 10 - strlen($pre . $numberOf);
        for ($i = 0; $i < $length; $i++) {
            $pre .= 0;
        }

        return $this->attributes['id'] = $pre . $numberOf;
    }
}
