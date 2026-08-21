<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DusunAdminSeeder extends Seeder
{
    /**
     * Seed the 6 dusun admin accounts and update super admin password.
     */
    public function run(): void
    {
        // ── Update existing super admin password to a stronger one ────────────
        User::where('role', 'super_admin')
            ->orWhereNull('role')
            ->update(['role' => 'super_admin']);

        // Update the first (main) super admin password
        $superAdmin = User::where('email', 'admin@desategalrejo.id')->first()
                  ?? User::where('role', 'super_admin')->first();

        if ($superAdmin) {
            $superAdmin->update([
                'role'     => 'super_admin',
                'dusun'    => null,
                'password' => Hash::make('D3sa@Tgl4rj0#S4per!'),
            ]);
            $this->command->info("✅ Super admin password updated: {$superAdmin->email}");
        }

        // ── Create 6 dusun admin accounts ─────────────────────────────────────
        $dusunAccounts = [
            [
                'name'     => 'Admin Dusun Tegalrejo',
                'email'    => 'admin.tegalrejo@desategalrejo.id',
                'dusun'    => 'Dusun Tegalrejo',
                'password' => 'Tglrj0@2025',
            ],
            [
                'name'     => 'Admin Dusun Ngesrep',
                'email'    => 'admin.ngesrep@desategalrejo.id',
                'dusun'    => 'Dusun Ngesrep',
                'password' => 'Ngsrp@2025',
            ],
            [
                'name'     => 'Admin Dusun Kalisoko Lor',
                'email'    => 'admin.kalisokolol@desategalrejo.id',
                'dusun'    => 'Dusun Kalisoko Lor',
                'password' => 'KlsokoL@2025',
            ],
            [
                'name'     => 'Admin Dusun Kalisoko Kidul',
                'email'    => 'admin.kalisokokdl@desategalrejo.id',
                'dusun'    => 'Dusun Kalisoko Kidul',
                'password' => 'KlsokoK@2025',
            ],
            [
                'name'     => 'Admin Dusun Tlatar',
                'email'    => 'admin.tlatar@desategalrejo.id',
                'dusun'    => 'Dusun Tlatar',
                'password' => 'Tltr@2025',
            ],
            [
                'name'     => 'Admin Dusun Dosowarung',
                'email'    => 'admin.dosowarung@desategalrejo.id',
                'dusun'    => 'Dusun Dosowarung',
                'password' => 'Dswrng@2025',
            ],
        ];

        foreach ($dusunAccounts as $account) {
            $user = User::updateOrCreate(
                ['email' => $account['email']],
                [
                    'name'     => $account['name'],
                    'role'     => 'dusun_admin',
                    'dusun'    => $account['dusun'],
                    'password' => Hash::make($account['password']),
                ]
            );
            $this->command->info("✅ Akun dusun admin: {$account['email']} | Password: {$account['password']}");
        }

        $this->command->newLine();
        $this->command->warn('⚠️  Simpan data password di atas di tempat yang aman!');
    }
}
