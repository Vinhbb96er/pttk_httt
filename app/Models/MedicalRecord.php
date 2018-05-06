<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class MedicalRecord extends Model
{
    use SoftDeletes;
    
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
    
    protected $dates = ['deleted_at'];

    protected $appends = [
        'create_date_format',
        'status_content',
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

    public function getCreateDateFormatAttribute()
    {
        if (!empty($this->attributes['create_date'])) {
            return Carbon::parse($this->attributes['create_date'])->format('d/m/Y');
        }
    }

    public function getStatusContentAttribute()
    {
        switch ($this->attributes['status']) {
            case config('settings.medical_record.status.leave'):
                return 'Xuất viện';
            case config('settings.medical_record.status.stay'):
                return 'Điều trị';
                break;
            case config('settings.medical_record.status.move'):
                return 'Chuyển viện';
            case config('settings.medical_record.status.other'):
                return 'Khác';
            default:
                break;
        }
    }
}
