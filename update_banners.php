<?php
use App\Models\Banner;
use App\Models\VillageProfile;

$profile = VillageProfile::firstOrCreate([]);
$profile->update([
    'profile_banner_image' => 'banners/banner_profil.png',
    'news_banner_image' => 'banners/banner_berita.png',
    'umkm_banner_image' => 'banners/banner_umkm.png',
    'budget_banner_image' => 'banners/banner_transparansi.png',
    'kependudukan_banner_image' => 'banners/banner_kependudukan.png',
]);

Banner::truncate();
Banner::create([
    'title' => 'Selamat Datang di Desa Tegalrejo',
    'subtitle' => 'Kecamatan Tengaran, Kabupaten Semarang, Jawa Tengah. Temukan informasi lengkap seputar layanan, potensi desa, kependudukan, hingga pesona wisata lokal yang kami miliki.',
    'image' => 'banners/banner_home.png',
    'button_text' => 'Belanja Produk UMKM',
    'button_link' => '/umkm',
    'button_secondary_text' => 'Profil Desa',
    'button_secondary_link' => '/profil',
    'is_active' => true,
    'order' => 1,
    'overlay_dark' => true,
]);
