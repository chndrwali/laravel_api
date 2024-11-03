<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'biodata_user_id',
        'level',
        'institution',
        'major',
        'year_graduation',
        'ipk' 
    ];

    public function biodataUser()
    {
        return $this->belongsTo(BiodataUser::class);
    }
}
