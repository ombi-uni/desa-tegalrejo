<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Umkm extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'has_nib' => 'boolean',
        'has_pirt' => 'boolean',
        'has_halal' => 'boolean',
        'is_featured' => 'boolean',
        'products_list' => 'array',
        'gallery_images' => 'array',
        'featured_order' => 'integer',
    ];

    protected static function booted()
    {
        static::saving(function ($umkm) {
            if (empty($umkm->slug) && !empty($umkm->store_name)) {
                $umkm->slug = Str::slug($umkm->store_name);
            }
        });
    }

    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return 'https://images.unsplash.com/photo-1566478989037-eec170784d0b?auto=format&fit=crop&w=800&q=80';
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }

    public function getGalleryUrlsAttribute(): array
    {
        if (empty($this->gallery_images) || !is_array($this->gallery_images)) {
            return [];
        }

        return array_map(function ($img) {
            if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
                return $img;
            }
            return asset('storage/' . $img);
        }, $this->gallery_images);
    }

    public function getCleanWhatsappAttribute(): string
    {
        $num = preg_replace('/[^0-9]/', '', $this->whatsapp_number ?? '');
        if (str_starts_with($num, '0')) {
            $num = '62' . substr($num, 1);
        }
        return $num;
    }

    public function getWhatsappOrderUrlAttribute(): string
    {
        $phone = $this->clean_whatsapp;
        if (empty($phone)) {
            return '#';
        }
        $store = $this->store_name;
        $msg = "Halo *{$store}*, saya melihat produk Anda di Website Resmi Desa Tegalrejo dan berminat untuk memesan/bertanya produk. Apakah produk masih tersedia?";
        return "https://wa.me/{$phone}?text=" . rawurlencode($msg);
    }

    public function getGoogleMapsEmbedUrlAttribute(): ?string
    {
        $url = trim($this->google_maps_url ?? '');
        if (empty($url)) {
            return null;
        }

        // If iframe tag passed, extract src
        if (preg_match('/src=["\']([^"\']+)["\']/', $url, $matches)) {
            return $matches[1];
        }

        if (str_contains($url, 'google.com/maps/embed')) {
            return $url;
        }

        // Return standard maps search embed or original URL
        return "https://maps.google.com/maps?q=" . urlencode($this->store_name . ' Desa Tegalrejo Tengaran') . "&output=embed";
    }
}

