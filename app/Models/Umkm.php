<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'has_nib' => 'boolean',
        'has_pirt' => 'boolean',
        'has_halal' => 'boolean',
        'is_featured' => 'boolean',
    ];
}
