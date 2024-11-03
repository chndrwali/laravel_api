<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'biodata_user_id',
        'name_work',
        'position',
        'income',
        'year_work',
    ];

    public function biodataUser()
    {
        return $this->belongsTo(BiodataUser::class);
    }
}
