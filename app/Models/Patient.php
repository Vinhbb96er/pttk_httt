<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use File;
use Carbon\Carbon;

class Patient extends Model
{
    use SoftDeletes;

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
    protected $dates = ['deleted_at'];

    protected $appends = [
        'image_path',
        'gender_content',
        'birthday_format',
        'reception_date_format',
        'expiration_date_format',
    ];

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

    public function getExpirationDateFormatAttribute()
    {
        if (!empty($this->attributes['expiration_date'])) {
            return Carbon::parse($this->attributes['expiration_date'])->format('d/m/Y');
        }
    }

    public function getReceptionDateFormatAttribute()
    {
        if (!empty($this->attributes['reception_date'])) {
            return Carbon::parse($this->attributes['reception_date'])->format('d/m/Y');
        }
    }
}
