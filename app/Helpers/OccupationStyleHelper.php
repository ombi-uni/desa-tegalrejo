<?php

namespace App\Helpers;

class OccupationStyleHelper
{
    /**
     * Returns icon, gradient, bg color, and text color for a given job label.
     * Supports Indonesian job names with keyword-based matching.
     */
    public static function getStyle(string $label): array
    {
        $l = strtolower($label);

        // ── Pertanian & Peternakan ───────────────────────────────────────────
        if (self::has($l, ['petani', 'pertanian', 'sawah', 'ladang', 'perkebunan']))
            return self::make('fa-wheat-awn', 'from-lime-500 to-green-600', 'bg-lime-50', 'text-lime-700');
        if (self::has($l, ['pekebun', 'kebun', 'berkebun']))
            return self::make('fa-seedling', 'from-green-400 to-emerald-500', 'bg-green-50', 'text-green-700');
        if (self::has($l, ['peternak', 'ternak', 'sapi', 'kambing', 'ayam', 'unggas']))
            return self::make('fa-cow', 'from-amber-400 to-yellow-500', 'bg-amber-50', 'text-amber-700');
        if (self::has($l, ['nelayan', 'perikanan', 'ikan', 'tambak', 'udang']))
            return self::make('fa-fish', 'from-cyan-400 to-blue-500', 'bg-cyan-50', 'text-cyan-700');

        // ── Buruh & Tenaga Kasar ─────────────────────────────────────────────
        if (self::has($l, ['buruh harian', 'kuli', 'pekerja lepas', 'harian lepas']))
            return self::make('fa-person-digging', 'from-orange-400 to-amber-500', 'bg-orange-50', 'text-orange-700');
        if (self::has($l, ['buruh tani', 'tani upah']))
            return self::make('fa-tractor', 'from-lime-400 to-green-500', 'bg-lime-50', 'text-lime-700');
        if (self::has($l, ['buruh pabrik', 'pekerja pabrik', 'manufaktur', 'produksi']))
            return self::make('fa-industry', 'from-zinc-400 to-slate-500', 'bg-zinc-50', 'text-zinc-700');
        if (self::has($l, ['buruh', 'tukang', 'bangunan', 'konstruksi', 'batu', 'kayu', 'las']))
            return self::make('fa-helmet-safety', 'from-amber-400 to-orange-500', 'bg-amber-50', 'text-amber-700');

        // ── Perdagangan & Jasa Komersial ─────────────────────────────────────
        if (self::has($l, ['pedagang', 'berdagang', 'warung', 'lapak', 'berjualan']))
            return self::make('fa-cart-shopping', 'from-emerald-400 to-teal-500', 'bg-emerald-50', 'text-emerald-700');
        if (self::has($l, ['perdagangan', 'ekspor', 'impor', 'distribusi', 'supplier']))
            return self::make('fa-handshake', 'from-teal-400 to-cyan-500', 'bg-teal-50', 'text-teal-700');
        if (self::has($l, ['wiraswasta', 'wirausaha', 'pengusaha', 'usaha sendiri', 'enterpreneur']))
            return self::make('fa-store', 'from-blue-400 to-indigo-500', 'bg-blue-50', 'text-blue-700');

        // ── Pendidikan ────────────────────────────────────────────────────────
        if (self::has($l, ['guru', 'pengajar', 'pendidik', 'instruktur', 'fasilitator']))
            return self::make('fa-chalkboard-user', 'from-violet-400 to-purple-500', 'bg-violet-50', 'text-violet-700');
        if (self::has($l, ['dosen', 'profesor', 'lektor', 'akademisi']))
            return self::make('fa-user-graduate', 'from-purple-400 to-fuchsia-500', 'bg-purple-50', 'text-purple-700');
        if (self::has($l, ['pelajar', 'mahasiswa', 'siswa', 'murid']))
            return self::make('fa-graduation-cap', 'from-sky-400 to-blue-500', 'bg-sky-50', 'text-sky-700');

        // ── Kesehatan ─────────────────────────────────────────────────────────
        if (self::has($l, ['dokter', 'physician', 'medis spesialis']))
            return self::make('fa-user-doctor', 'from-red-400 to-rose-500', 'bg-red-50', 'text-red-700');
        if (self::has($l, ['perawat', 'bidan', 'tenaga medis', 'ners', 'mantri']))
            return self::make('fa-user-nurse', 'from-rose-400 to-pink-500', 'bg-rose-50', 'text-rose-700');
        if (self::has($l, ['apoteker', 'farmasi', 'obat']))
            return self::make('fa-pills', 'from-pink-400 to-rose-500', 'bg-pink-50', 'text-pink-700');
        if (self::has($l, ['kesehatan', 'puskesmas', 'klinik', 'posyandu']))
            return self::make('fa-kit-medical', 'from-rose-400 to-red-500', 'bg-rose-50', 'text-rose-700');

        // ── Pemerintahan & TNI/Polri ─────────────────────────────────────────
        if (self::has($l, ['perangkat desa', 'aparat desa', 'pamong desa', 'kepala dusun', 'rt', 'rw', 'staf desa']))
            return self::make('fa-landmark', 'from-indigo-400 to-blue-500', 'bg-indigo-50', 'text-indigo-700');
        if (self::has($l, ['pns', 'asn', 'pegawai negeri', 'aparatur sipil', 'pegawai pemerintah']))
            return self::make('fa-building-user', 'from-blue-500 to-indigo-600', 'bg-blue-50', 'text-blue-700');
        if (self::has($l, ['tni', 'tentara', 'prajurit', 'militer', 'angkatan']))
            return self::make('fa-shield-halved', 'from-green-600 to-green-800', 'bg-green-50', 'text-green-800');
        if (self::has($l, ['polri', 'polisi', 'polsek', 'polres', 'bhayangkara']))
            return self::make('fa-shield-halved', 'from-sky-500 to-blue-700', 'bg-sky-50', 'text-sky-800');

        // ── Karyawan Swasta ───────────────────────────────────────────────────
        if (self::has($l, ['karyawan swasta', 'pegawai swasta', 'karyawan perusahaan']))
            return self::make('fa-user-tie', 'from-slate-400 to-slate-600', 'bg-slate-50', 'text-slate-700');

        // ── Transportasi & Logistik ──────────────────────────────────────────
        if (self::has($l, ['sopir', 'supir', 'pengemudi', 'driver']))
            return self::make('fa-car-side', 'from-orange-400 to-amber-500', 'bg-orange-50', 'text-orange-700');
        if (self::has($l, ['ojek', 'ojol', 'gojek', 'grab', 'kurir', 'delivery']))
            return self::make('fa-motorcycle', 'from-amber-400 to-orange-500', 'bg-amber-50', 'text-amber-700');
        if (self::has($l, ['angkutan', 'transportasi', 'truk', 'ekspedisi', 'logistik']))
            return self::make('fa-truck-fast', 'from-orange-400 to-red-500', 'bg-orange-50', 'text-orange-700');

        // ── Jasa Rumah Tangga ─────────────────────────────────────────────────
        if (self::has($l, ['asisten rumah tangga', 'pembantu', 'prt', 'art']))
            return self::make('fa-broom', 'from-teal-400 to-cyan-500', 'bg-teal-50', 'text-teal-700');
        if (self::has($l, ['ibu rumah tangga', 'irt', 'rumah tangga', 'mengurus rumah']))
            return self::make('fa-house-user', 'from-pink-400 to-rose-500', 'bg-pink-50', 'text-pink-700');

        // ── Pensiun ───────────────────────────────────────────────────────────
        if (self::has($l, ['pensiun', 'purnawirawan', 'purna tugas']))
            return self::make('fa-user-clock', 'from-slate-300 to-slate-500', 'bg-slate-100', 'text-slate-600');

        // ── Tidak / Belum Bekerja ─────────────────────────────────────────────
        if (self::has($l, ['belum bekerja', 'tidak bekerja', 'penganggur', 'belum/tidak', 'nganggur']))
            return self::make('fa-user-xmark', 'from-red-400 to-red-500', 'bg-red-50', 'text-red-700');

        // ── Teknologi & Kreatif ───────────────────────────────────────────────
        if (self::has($l, ['programmer', 'developer', 'it ', 'teknisi komputer', 'teknologi informasi']))
            return self::make('fa-laptop-code', 'from-sky-400 to-blue-500', 'bg-sky-50', 'text-sky-700');
        if (self::has($l, ['teknisi', 'montir', 'mekanik', 'servis', 'reparasi', 'elektronik']))
            return self::make('fa-screwdriver-wrench', 'from-zinc-400 to-gray-500', 'bg-zinc-50', 'text-zinc-700');
        if (self::has($l, ['seniman', 'seni', 'desainer', 'fotografer', 'content creator', 'kreator']))
            return self::make('fa-palette', 'from-fuchsia-400 to-purple-500', 'bg-fuchsia-50', 'text-fuchsia-700');

        // ── Agama & Sosial ────────────────────────────────────────────────────
        if (self::has($l, ['ustadz', 'kyai', 'ulama', 'imam', 'rohaniwan', 'pendeta', 'pastor', 'biksu', 'pemuka agama']))
            return self::make('fa-mosque', 'from-green-400 to-emerald-600', 'bg-green-50', 'text-green-700');

        // ── Hukum & Keuangan ─────────────────────────────────────────────────
        if (self::has($l, ['pengacara', 'notaris', 'hakim', 'jaksa', 'advokat', 'hukum']))
            return self::make('fa-scale-balanced', 'from-amber-500 to-yellow-600', 'bg-amber-50', 'text-amber-800');
        if (self::has($l, ['akuntan', 'keuangan', 'bankir', 'bank', 'kasir', 'pajak', 'koperasi']))
            return self::make('fa-coins', 'from-yellow-400 to-amber-500', 'bg-yellow-50', 'text-yellow-700');

        // ── Default (rotating by label hash) ─────────────────────────────────
        $defaults = [
            self::make('fa-briefcase',  'from-cyan-400 to-cyan-500',    'bg-cyan-50',    'text-cyan-700'),
            self::make('fa-id-card',    'from-fuchsia-400 to-fuchsia-500', 'bg-fuchsia-50', 'text-fuchsia-700'),
            self::make('fa-user-tag',   'from-zinc-400 to-zinc-500',    'bg-zinc-50',    'text-zinc-700'),
            self::make('fa-star',       'from-yellow-400 to-amber-500', 'bg-yellow-50',  'text-yellow-700'),
        ];
        return $defaults[abs(crc32($l)) % count($defaults)];
    }

    /**
     * Returns JS object string for client-side (admin preview) use.
     * Format: { icon: 'fa-wheat-awn', color: '#4ade80', bg: '#f0fdf4' }
     */
    public static function getJsMapping(): string
    {
        return json_encode([
            // Agriculture
            ['keywords' => ['petani','pertanian','sawah','ladang','perkebunan'], 'icon' => 'fa-wheat-awn', 'color' => '#16a34a'],
            ['keywords' => ['pekebun','kebun','berkebun'], 'icon' => 'fa-seedling', 'color' => '#16a34a'],
            ['keywords' => ['peternak','ternak','sapi','kambing','ayam','unggas'], 'icon' => 'fa-cow', 'color' => '#d97706'],
            ['keywords' => ['nelayan','perikanan','ikan','tambak','udang'], 'icon' => 'fa-fish', 'color' => '#0891b2'],
            // Labor
            ['keywords' => ['buruh harian','kuli','pekerja lepas','harian lepas'], 'icon' => 'fa-person-digging', 'color' => '#ea580c'],
            ['keywords' => ['buruh tani','tani upah'], 'icon' => 'fa-tractor', 'color' => '#65a30d'],
            ['keywords' => ['buruh pabrik','pekerja pabrik','manufaktur','produksi'], 'icon' => 'fa-industry', 'color' => '#52525b'],
            ['keywords' => ['buruh','tukang','bangunan','konstruksi','batu','kayu'], 'icon' => 'fa-helmet-safety', 'color' => '#d97706'],
            // Commerce
            ['keywords' => ['pedagang','berdagang','warung','lapak','berjualan'], 'icon' => 'fa-cart-shopping', 'color' => '#0d9488'],
            ['keywords' => ['perdagangan','ekspor','impor','distribusi','supplier'], 'icon' => 'fa-handshake', 'color' => '#0f766e'],
            ['keywords' => ['wiraswasta','wirausaha','pengusaha','usaha sendiri'], 'icon' => 'fa-store', 'color' => '#3b82f6'],
            // Education
            ['keywords' => ['guru','pengajar','pendidik','instruktur'], 'icon' => 'fa-chalkboard-user', 'color' => '#7c3aed'],
            ['keywords' => ['dosen','profesor','lektor','akademisi'], 'icon' => 'fa-user-graduate', 'color' => '#9333ea'],
            ['keywords' => ['pelajar','mahasiswa','siswa','murid'], 'icon' => 'fa-graduation-cap', 'color' => '#0284c7'],
            // Health
            ['keywords' => ['dokter'], 'icon' => 'fa-user-doctor', 'color' => '#dc2626'],
            ['keywords' => ['perawat','bidan','tenaga medis','ners','mantri'], 'icon' => 'fa-user-nurse', 'color' => '#e11d48'],
            ['keywords' => ['apoteker','farmasi'], 'icon' => 'fa-pills', 'color' => '#db2777'],
            ['keywords' => ['kesehatan','puskesmas','klinik','posyandu'], 'icon' => 'fa-kit-medical', 'color' => '#e11d48'],
            // Government
            ['keywords' => ['perangkat desa','aparat desa','pamong desa','kepala dusun'], 'icon' => 'fa-landmark', 'color' => '#4338ca'],
            ['keywords' => ['pns','asn','pegawai negeri','aparatur sipil'], 'icon' => 'fa-building-user', 'color' => '#1d4ed8'],
            ['keywords' => ['tni','tentara','prajurit','militer'], 'icon' => 'fa-shield-halved', 'color' => '#166534'],
            ['keywords' => ['polri','polisi'], 'icon' => 'fa-shield-halved', 'color' => '#075985'],
            // Private employee
            ['keywords' => ['karyawan swasta','pegawai swasta','karyawan perusahaan'], 'icon' => 'fa-user-tie', 'color' => '#475569'],
            ['keywords' => ['karyawan','pegawai'], 'icon' => 'fa-user-tie', 'color' => '#475569'],
            // Transport
            ['keywords' => ['sopir','supir','pengemudi','driver'], 'icon' => 'fa-car-side', 'color' => '#ea580c'],
            ['keywords' => ['ojek','ojol','gojek','grab','kurir','delivery'], 'icon' => 'fa-motorcycle', 'color' => '#d97706'],
            ['keywords' => ['angkutan','transportasi','truk','ekspedisi'], 'icon' => 'fa-truck-fast', 'color' => '#ea580c'],
            // Home
            ['keywords' => ['asisten rumah tangga','pembantu','prt','art'], 'icon' => 'fa-broom', 'color' => '#0f766e'],
            ['keywords' => ['ibu rumah tangga','irt','rumah tangga'], 'icon' => 'fa-house-user', 'color' => '#db2777'],
            // Retired / not working
            ['keywords' => ['pensiun','purnawirawan','purna tugas'], 'icon' => 'fa-user-clock', 'color' => '#64748b'],
            ['keywords' => ['belum bekerja','tidak bekerja','penganggur','belum/tidak'], 'icon' => 'fa-user-xmark', 'color' => '#dc2626'],
            // Tech & Creative
            ['keywords' => ['programmer','developer','it ','teknologi informasi'], 'icon' => 'fa-laptop-code', 'color' => '#0284c7'],
            ['keywords' => ['teknisi','montir','mekanik','servis','reparasi'], 'icon' => 'fa-screwdriver-wrench', 'color' => '#52525b'],
            ['keywords' => ['seniman','seni','desainer','fotografer','kreator'], 'icon' => 'fa-palette', 'color' => '#c026d3'],
            // Religion
            ['keywords' => ['ustadz','kyai','ulama','imam','rohaniwan','pendeta','pastor'], 'icon' => 'fa-mosque', 'color' => '#15803d'],
            // Finance & Law
            ['keywords' => ['pengacara','notaris','hakim','jaksa','advokat'], 'icon' => 'fa-scale-balanced', 'color' => '#b45309'],
            ['keywords' => ['akuntan','keuangan','bankir','bank','kasir','koperasi'], 'icon' => 'fa-coins', 'color' => '#ca8a04'],
        ]);
    }

    private static function has(string $label, array $keywords): bool
    {
        foreach ($keywords as $kw) {
            if (str_contains($label, $kw)) return true;
        }
        return false;
    }

    private static function make(string $icon, string $grad, string $bg, string $tc): array
    {
        return ['icon' => $icon, 'grad' => $grad, 'bg' => $bg, 'tc' => $tc];
    }
}
