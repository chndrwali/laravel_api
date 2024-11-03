<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BiodataUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'name',
        'birthday',
        'no_ktp',
        'gender',
        'religion',
        'blood_type',
        'status',
        'address_ktp',
        'current_address',
        'email_address',
        'phone_number',
        'emergency_phone_number',
        'skill'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function education()
    {
        return $this->hasMany(Education::class);
    }
    public function training()
    {
        return $this->hasMany(Training::class);
    }
    public function work()
    {
        return $this->hasMany(Work::class);
    }
}
