<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
use File;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

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
        'role',
        'account',
        'password',
        'status',
    ];

    public $incrementing = false;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'role_content',
        'image_path',
        'gender_content',
        'birthday_format',
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

    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = Hash::make($value);
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

    public function getRoleContentAttribute()
    {
        if (!$this->attributes['status']) {
            return $this->attributes['role_content'] = 'Bị khóa';
        }

        switch ($this->attributes['role']) {
            case config('settings.staff_role.super_admin'):
                return $this->attributes['role_content'] = 'Super Admin';
            case config('settings.staff_role.admin'):
                return $this->attributes['role_content'] = 'Admin';
            case config('settings.staff_role.front_desk_staff'):
                return $this->attributes['role_content'] = 'Nv Tiếp nhận';
            case config('settings.staff_role.faculty_staff'):
                $faculty = $this->find($this->attributes['id'])->faculty->name;
                return $this->attributes['role_content'] = 'Nv Khoa ' . $faculty;
        }
    }

    public function getImagePathAttribute()
    {
        if (!File::exists(public_path($this->attributes['image'])) || empty($this->attributes['image'])) {
            return config('settings.image_default.no_image');
        }

        return $this->attributes['image']; 
    }

    public function getGenderContentAttribute()
    {
        return $this->attributes['gender'] ? 'Nam' : 'Nữ'; 
    }

    public function getBirthdayFormatAttribute()
    {
        if (!empty($this->attributes['birthday'])) {
            return Carbon::parse($this->attributes['birthday'])->format('d/m/Y');
        }
    }
}
