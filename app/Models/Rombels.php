<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rombels extends Model
{
    use HasFactory;

    protected $fillable = [
        'rombel',
    ];

    public function rombel()
    {
        return $this->belongsTo(Rombels::class);
    }

    public function students()
    {
        return $this->hasMany(Students::class, 'rombel_id', 'id');
    }
}
