<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getImageUrlAttribute(): string
    {
        if (empty($this->thumbnail)) {
            return 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=800&q=80';
        }

        if (str_starts_with($this->thumbnail, 'http://') || str_starts_with($this->thumbnail, 'https://')) {
            return $this->thumbnail;
        }

        return asset('storage/' . $this->thumbnail);
    }

    /**
     * Pastikan semua link gambar inline di dalam artikel selalu menggunakan path relatif /storage/ yang valid
     */
    public function getContentAttribute($value): string
    {
        if (empty($value)) {
            return '';
        }

        return str_replace(
            ['http://localhost/storage/', 'https://localhost/storage/', 'http://127.0.0.1:8000/storage/'],
            '/storage/',
            $value
        );
    }

    public function setContentAttribute($value): void
    {
        $this->attributes['content'] = str_replace(
            ['http://localhost/storage/', 'https://localhost/storage/', 'http://127.0.0.1:8000/storage/'],
            '/storage/',
            $value ?? ''
        );
    }
}
