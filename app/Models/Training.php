<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'biodata_user_id',
        'name_course',
        'certificated',
        'year_certificate',
    ];

    public function biodataUser()
    {
        return $this->belongsTo(BiodataUser::class);
    }
}
