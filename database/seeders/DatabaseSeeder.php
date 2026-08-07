<?php

namespace Database\Seeders;

use App\Models\Apparatus;
use App\Models\Banner;
use App\Models\BudgetTransparency;
use App\Models\News;
use App\Models\Statistic;
use App\Models\Umkm;
use App\Models\User;
use App\Models\VillageProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. User Admin Filament
        User::updateOrCreate(
            ['email' => 'admin@tegalrejo.desa.id'],
            [
                'name' => 'Admin Desa Tegalrejo',
                'password' => Hash::make('admin123'),
            ]
        );

        // 2. Hero Banners
        Banner::truncate();
        Banner::create([
            'title' => 'Selamat Datang di Website Resmi Desa Tegalrejo',
            'subtitle' => 'Kecamatan Tengaran, Kabupaten Semarang, Jawa Tengah. Pusat informasi publik, layanan digitalisasi desa, dan pemberdayaan ekonomi UMKM lokal.',
            'image' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1600&q=80',
            'button_text' => 'Jelajahi Produk UMKM',
            'button_link' => '/belanja',
            'is_active' => true,
            'order' => 1,
        ]);
        Banner::create([
            'title' => 'Pendampingan Digitalisasi & Sertifikasi Halal UMKM',
            'subtitle' => 'Program Kerja KKN dalam membantu penataan NIB, PIRT, Sertifikasi Halal, serta integrasi Toko Online & Google Maps UMKM Tegalrejo.',
            'image' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=1600&q=80',
            'button_text' => 'Lihat Portal Berita',
            'button_link' => '/berita',
            'is_active' => true,
            'order' => 2,
        ]);

        // 3. Profil Desa & Visi Misi
        VillageProfile::truncate();
        VillageProfile::create([
            'visi' => 'Terwujudnya Desa Tegalrejo yang Mandiri, Sejahtera, Transparan, Berbudaya, dan Berdaya Saing Berbasis Teknologi Informasi dan Ekonomi Kerakyatan.',
            'misi' => "1. Mewujudkan tata kelola pemerintahan desa yang bersih, transparan, dan akuntabel.\n2. Mengembangkan potensi ekonomi desa melalui pendigitalisasian UMKM lokal dan sektor pertanian.\n3. Meningkatkan kualitas sarana, prasarana publik, dan tempat ibadah di seluruh dusun.\n4. Mempererat kebersamaan dan kegiatan kemasyarakatan yang harmonis.",
            'kades_name' => 'Bpk. H. Ahmad Slamet, S.Sos.',
            'kades_photo' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=600&q=80',
            'kades_welcome_text' => '<p>Assalamu’alaikum Warahmatullahi Wabarakatuh.</p><p>Selamat datang di portal informasi resmi Desa Tegalrejo, Kecamatan Tengaran. Website ini hadir sebagai bentuk komitmen transparansi publik, keterbukaan informasi anggaran, serta sarana promosi produk-produk UMKM kebanggaan desa kita. Terima kasih atas kerja keras mahasiswa KKN yang telah mendampingi pendigitalisasian desa ini.</p>',
            'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
        ]);

        // 4. Statistik Desa
        Statistic::truncate();
        Statistic::create([
            'population_count' => 4850,
            'building_count' => 1240,
            'facility_count' => 18,
            'worship_place_count' => 14,
        ]);

        // 5. Perangkat Desa
        Apparatus::truncate();
        $apparatuses = [
            [
                'name' => 'Bpk. H. Ahmad Slamet, S.Sos.',
                'position' => 'Kepala Desa Tegalrejo',
                'photo' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=500&q=80',
                'order_level' => 1,
            ],
            [
                'name' => 'Bpk. Muhammad Ridwan, S.E.',
                'position' => 'Sekretaris Desa',
                'photo' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=500&q=80',
                'order_level' => 2,
            ],
            [
                'name' => 'Ibu Siti Aminah, S.Ak.',
                'position' => 'Kaur Keuangan',
                'photo' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=500&q=80',
                'order_level' => 3,
            ],
            [
                'name' => 'Bpk. Bambang Sutrisno',
                'position' => 'Kaur Umum & Perencanaan',
                'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=500&q=80',
                'order_level' => 4,
            ],
            [
                'name' => 'Ibu Nur Hidayah',
                'position' => 'Kasi Pelayanan & Kesejahteraan',
                'photo' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=500&q=80',
                'order_level' => 5,
            ],
        ];
        foreach ($apparatuses as $app) {
            Apparatus::create($app);
        }

        // 6. UMKM Dampingan KKN Tegalrejo
        Umkm::truncate();
        $umkms = [
            [
                'store_name' => 'Omah Keripik Tegalrejo',
                'owner_name' => 'Ibu Sri Wahyuni',
                'product_name' => 'Keripik Singkong & Pisang Lumer Caramel',
                'category' => 'Kuliner',
                'description' => 'Keripik tradisional olahan olahan petani lokal Tegalrejo dengan varian rasa gurih, pedas manis, dan cokelat lumer. Produk telah mengantongi NIB, PIRT, dan sertifikat Halal.',
                'price_range' => 'Rp 12.000 - Rp 25.000',
                'whatsapp_number' => '6281234567890',
                'google_maps_url' => 'https://maps.google.com/?q=-7.3654,110.4901',
                'shopee_url' => 'https://shopee.co.id',
                'tokopedia_url' => 'https://tokopedia.com',
                'has_nib' => true,
                'has_pirt' => true,
                'has_halal' => true,
                'image' => 'https://images.unsplash.com/photo-1566478989037-eec170784d0b?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
            ],
            [
                'store_name' => 'Kopi Robusta Lereng Tengaran',
                'owner_name' => 'Pak Joko Widodo (Tegalrejo)',
                'product_name' => 'Kopi Bubuk Original Robusta Tegalrejo',
                'category' => 'Kuliner',
                'description' => 'Biji kopi pilihan yang dipetik langsung dari perkebunan lereng pedesaan Tegalrejo. Diproses roasting medium-to-dark dengan aroma khas dan nikmat.',
                'price_range' => 'Rp 30.000 - Rp 75.000',
                'whatsapp_number' => '6289876543210',
                'google_maps_url' => 'https://maps.google.com/?q=-7.3660,110.4920',
                'shopee_url' => 'https://shopee.co.id',
                'tokopedia_url' => 'https://tokopedia.com',
                'has_nib' => true,
                'has_pirt' => true,
                'has_halal' => true,
                'image' => 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
            ],
            [
                'store_name' => 'Batik Tulis & Cap Tegalrejo',
                'owner_name' => 'Ibu Endang Rahayu',
                'product_name' => 'Kain & Kemeja Batik Motif Khas Desa',
                'category' => 'Kerajinan',
                'description' => 'Kerajinan batik khas buatan tangan pengrajin wanita Desa Tegalrejo dengan pewarna alam ramah lingkungan dan motif flora lereng gunung.',
                'price_range' => 'Rp 150.000 - Rp 450.000',
                'whatsapp_number' => '6282134567891',
                'google_maps_url' => 'https://maps.google.com/?q=-7.3640,110.4890',
                'shopee_url' => 'https://shopee.co.id',
                'tokopedia_url' => 'https://tokopedia.com',
                'has_nib' => true,
                'has_pirt' => false,
                'has_halal' => false,
                'image' => 'https://images.unsplash.com/photo-1606760227091-3dd858d97240?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
            ],
            [
                'store_name' => 'Madu Murni Hydroponik Tegalrejo',
                'owner_name' => 'Mas Hendra Setiawan',
                'product_name' => 'Madu Murni Multiflora Tegalrejo 500ml',
                'category' => 'Pertanian & Peternakan',
                'description' => 'Madu ternak lebah kelulut dan Apis Mellifera murni tanpa campuran gula. Dipanen langsung dari kebun bunga desa.',
                'price_range' => 'Rp 85.000 - Rp 160.000',
                'whatsapp_number' => '6287712345678',
                'google_maps_url' => 'https://maps.google.com/?q=-7.3670,110.4950',
                'shopee_url' => 'https://shopee.co.id',
                'tokopedia_url' => 'https://tokopedia.com',
                'has_nib' => true,
                'has_pirt' => true,
                'has_halal' => true,
                'image' => 'https://images.unsplash.com/photo-1587049352847-4a222e784d38?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
            ],
        ];
        foreach ($umkms as $u) {
            Umkm::create($u);
        }

        // 7. Portal Berita & Kegiatan KKN
        News::truncate();
        $newsItems = [
            [
                'title' => 'Pendampingan Pembuatan NIB & Sertifikasi Halal UMKM oleh Mahasiswa KKN di Desa Tegalrejo',
                'slug' => 'pendampingan-pembuatan-nib-sertifikasi-halal-umkm-desa-tegalrejo',
                'category' => 'Kegiatan KKN',
                'thumbnail' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=800&q=80',
                'content' => '<p><strong>Tegalrejo, Tengaran</strong> — Tim Mahasiswa KKN sukses menyelenggarakan sosialisasi dan pendampingan pembuatan Nomor Induk Berusaha (NIB), PIRT, serta pendaftaran Sertifikat Halal gratis bagi para pelaku Usaha Mikro, Kecil, dan Menengah (UMKM) di Desa Tegalrejo.</p><p>Tidak hanya pengurusan legalitas, tim KKN juga membantu pendaftaran produk UMKM ke Marketplace nasional seperti Shopee & Tokopedia, pembuatan desain logo kemasan modern, serta mendaftarkan titik jualan warga ke Google Maps agar semakin mudah ditemukan konsumen luar daerah.</p>',
                'author' => 'Tim KKN Tegalrejo',
                'status' => 'published',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Peluncuran Website Resmi Desa Tegalrejo Sebagai Sarana Transparansi & Digitalisasi UMKM',
                'slug' => 'peluncuran-website-resmi-desa-tegalrejo-sarana-transparansi-digitalisasi-umkm',
                'category' => 'Berita Utama',
                'thumbnail' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80',
                'content' => '<p><strong>Tegalrejo</strong> — Dalam rangka meningkatkan keterbukaan publik dan aksesibilitas ekonomi warga, Pemerintah Desa Tegalrejo bekerja sama dengan Mahasiswa Sistem Informasi meluncurkan Website Resmi Desa Tegalrejo.</p><p>Website ini memuat profil desa, struktur aparatur, portal berita terupdate, transparansi APBDES, serta fitur unggulan Section Belanja yang menampilkan katalog seluruh produk UMKM dampingan desa dengan pemesanan langsung ke WhatsApp penjual.</p>',
                'author' => 'Admin Desa Tegalrejo',
                'status' => 'published',
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Kerja Bakti Warga Tegalrejo Pembersihan Fasilitas Umum dan Tempat Ibadah Desa',
                'slug' => 'kerja-bakti-warga-tegalrejo-pembersihan-fasilitas-umum-tempat-ibadah',
                'category' => 'Kegiatan Desa',
                'thumbnail' => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?auto=format&fit=crop&w=800&q=80',
                'content' => '<p><strong>Tegalrejo</strong> — Warga Desa Tegalrejo bersama perangkat desa dan mahasiswa KKN bergotong royong membersihkan area makam desa, lapangan olahraga, serta area seputar masjid dan gereja lokal untuk mempererat rasa kebersamaan antar warga.</p>',
                'author' => 'Kaur Umum Tegalrejo',
                'status' => 'published',
                'published_at' => now()->subDays(4),
            ],
        ];
        foreach ($newsItems as $n) {
            News::create($n);
        }

        // 8. Transparansi Anggaran Desa (APBDES 2026)
        BudgetTransparency::truncate();
        $budgets = [
            ['year' => '2026', 'category' => 'Pendapatan', 'title' => 'Dana Desa (DD) APBN', 'amount' => 985000000.00],
            ['year' => '2026', 'category' => 'Pendapatan', 'title' => 'Alokasi Dana Desa (ADD) Kabupaten', 'amount' => 450000000.00],
            ['year' => '2026', 'category' => 'Pendapatan', 'title' => 'Bagi Hasil Pajak & Retribusi Daerah', 'amount' => 65000000.00],
            ['year' => '2026', 'category' => 'Belanja', 'title' => 'Bidang Penyelenggaraan Pemerintahan Desa', 'amount' => 480000000.00],
            ['year' => '2026', 'category' => 'Belanja', 'title' => 'Bidang Pelaksanaan Pembangunan Desa', 'amount' => 620000000.00],
            ['year' => '2026', 'category' => 'Belanja', 'title' => 'Bidang Pembinaan & Pemberdayaan Masyarakat (UMKM)', 'amount' => 310000000.00],
            ['year' => '2026', 'category' => 'Pembiayaan', 'title' => 'Sisa Lebih Perhitungan Anggaran (SILPA)', 'amount' => 90000000.00],
        ];
        foreach ($budgets as $b) {
            BudgetTransparency::create($b);
        }
    }
}
