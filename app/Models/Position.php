<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];

    public function users()
    {
        $this->hasMany(User::class);
    }
}
