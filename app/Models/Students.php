<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'name',
        'rombel_id',
        'rayon_id',
    ];

    public function rombel()
    {
        return $this->belongsTo(Rombels::class, 'rombel_id');
    }

    public function rayon()
    {
        return $this->belongsTo(Rayons::class, 'rayon_id');
    }

    public function lates()
    {
        return $this->hasMany(Lates::class, 'student_id');
    }
}
