<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageProfile extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Otomatis mengkonversi segala jenis format link YouTube (biasa, share, shorts, live, embed, ataupun kode iframe)
     * menjadi URL embed yang valid dan siap tayang di website.
     */
    public function getYoutubeEmbedUrlAttribute(): string
    {
        $url = trim($this->video_url ?? '');

        if (empty($url)) {
            return 'https://www.youtube.com/embed/dQw4w9WgXcQ';
        }

        // 1. Jika admin menempelkan tag iframe HTML <iframe src="...">
        if (preg_match('/src=["\']([^"\']+)["\']/', $url, $matches)) {
            $url = $matches[1];
        }

        // 2. Ekstrak Video ID 11 karakter dari segala macam URL YouTube:
        //    - https://www.youtube.com/watch?v=tyG2UYR7JE8
        //    - https://www.youtube.com/live/tyG2UYR7JE8
        //    - https://www.youtube.com/shorts/tyG2UYR7JE8
        //    - https://youtu.be/tyG2UYR7JE8
        //    - https://www.youtube.com/embed/tyG2UYR7JE8
        //    - https://m.youtube.com/watch?v=tyG2UYR7JE8
        if (preg_match('/(?:youtu\.be\/|youtube(?:-nocookie)?\.com\/(?:(?:watch\?.*?v=)|(?:embed\/)|(?:v\/)|(?:e\/)|(?:shorts\/)|(?:live\/)))([\w-]{11})/i', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        // 3. Jika URL sudah diawali https://www.youtube.com/embed/
        if (str_contains($url, 'youtube.com/embed/') || str_contains($url, 'youtube-nocookie.com/embed/')) {
            return $url;
        }

        // 4. Jika hanya diisi ID 11 karakter (contoh: tyG2UYR7JE8)
        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
            return 'https://www.youtube.com/embed/' . $url;
        }

        return $url;
    }

    /**
     * Memastikan URL Logo selalu valid dan dapat diakses publik
     */
    public function getLogoUrlAttribute(): ?string
    {
        if (empty($this->logo)) {
            return null;
        }

        if (str_starts_with($this->logo, 'http://') || str_starts_with($this->logo, 'https://')) {
            return $this->logo;
        }

        return asset('storage/' . $this->logo);
    }

    public function getProfileBannerUrlAttribute(): ?string
    {
        if (empty($this->profile_banner_image)) {
            return null;
        }
        return str_starts_with($this->profile_banner_image, 'http') ? $this->profile_banner_image : asset('storage/' . $this->profile_banner_image);
    }

    public function getNewsBannerUrlAttribute(): ?string
    {
        if (empty($this->news_banner_image)) {
            return null;
        }
        return str_starts_with($this->news_banner_image, 'http') ? $this->news_banner_image : asset('storage/' . $this->news_banner_image);
    }

    public function getUmkmBannerUrlAttribute(): ?string
    {
        if (empty($this->umkm_banner_image)) {
            return null;
        }
        return str_starts_with($this->umkm_banner_image, 'http') ? $this->umkm_banner_image : asset('storage/' . $this->umkm_banner_image);
    }

    public function getBudgetBannerUrlAttribute(): ?string
    {
        if (empty($this->budget_banner_image)) {
            return null;
        }
        return str_starts_with($this->budget_banner_image, 'http') ? $this->budget_banner_image : asset('storage/' . $this->budget_banner_image);
    }

    public function getKependudukanBannerUrlAttribute(): ?string
    {
        if (empty($this->kependudukan_banner_image)) {
            return null;
        }
        return str_starts_with($this->kependudukan_banner_image, 'http') ? $this->kependudukan_banner_image : asset('storage/' . $this->kependudukan_banner_image);
    }
}
