<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageProfile extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Otomatis mengkonversi segala jenis format link YouTube (biasa, share, shorts, embed, ataupun kode iframe)
     * menjadi URL embed yang valid dan siap tayang di website.
     */
    public function getYoutubeEmbedUrlAttribute(): string
    {
        $url = trim($this->video_url ?? '');

        if (empty($url)) {
            return 'https://www.youtube-nocookie.com/embed/dQw4w9WgXcQ';
        }

        // 1. Jika admin menempelkan seluruh tag <iframe src="...">
        if (preg_match('/src=["\']([^"\']+)["\']/', $url, $matches)) {
            $url = $matches[1];
        }

        // 2. Jika URL sudah berformat embed murni
        if (str_contains($url, 'youtube.com/embed/') || str_contains($url, 'youtube-nocookie.com/embed/')) {
            if (preg_match('/embed\/([a-zA-Z0-9_-]{11})/', $url, $matches)) {
                return 'https://www.youtube-nocookie.com/embed/' . $matches[1];
            }
            return $url;
        }

        // 3. Tangani link YouTube standar:
        //    - https://www.youtube.com/watch?v=VIDEO_ID
        //    - https://youtu.be/VIDEO_ID
        //    - https://www.youtube.com/shorts/VIDEO_ID
        //    - https://m.youtube.com/watch?v=VIDEO_ID
        if (preg_match('/(?:youtube(?:-nocookie)?\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/|youtube\.com\/shorts\/)([a-zA-Z0-9_-]{11})/i', $url, $matches)) {
            return 'https://www.youtube-nocookie.com/embed/' . $matches[1];
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
}
