<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apparatus extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->photo)) {
            return null;
        }

        if (str_starts_with($this->photo, 'http://') || str_starts_with($this->photo, 'https://')) {
            return $this->photo;
        }

        return asset('storage/' . $this->photo);
    }
}
