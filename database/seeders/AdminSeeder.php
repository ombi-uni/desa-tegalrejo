<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            ['name' => 'Super Admin', 'email' => 'admin@tegalrejo.desa.id', 'password' => 'Tegalrejo@Super2026!', 'role' => 'super_admin', 'dusun' => null],
            ['name' => 'Admin Dusun Tegalrejo', 'email' => 'admin.tegalrejo@desategalrejo.id', 'password' => 'Tegalrejo@2026!', 'role' => 'dusun_admin', 'dusun' => 'Tegalrejo'],
            ['name' => 'Admin Dusun Ngesrep', 'email' => 'admin.ngesrep@desategalrejo.id', 'password' => 'Ngesrep@2026!', 'role' => 'dusun_admin', 'dusun' => 'Ngesrep'],
            ['name' => 'Admin Dusun Kalisoko Lor', 'email' => 'admin.kalisokolor@desategalrejo.id', 'password' => 'KalisokoLor@2026!', 'role' => 'dusun_admin', 'dusun' => 'Kalisoko Lor'],
            ['name' => 'Admin Dusun Kalisoko Kidul', 'email' => 'admin.kalisokokidul@desategalrejo.id', 'password' => 'KalisokoKidul@2026!', 'role' => 'dusun_admin', 'dusun' => 'Kalisoko Kidul'],
            ['name' => 'Admin Dusun Tlatar', 'email' => 'admin.tlatar@desategalrejo.id', 'password' => 'Tlatar@2026!', 'role' => 'dusun_admin', 'dusun' => 'Tlatar'],
            ['name' => 'Admin Dusun Dosowarung', 'email' => 'admin.dosowarung@desategalrejo.id', 'password' => 'Dosowarung@2026!', 'role' => 'dusun_admin', 'dusun' => 'Dosowarung'],
        ];

        foreach ($admins as $adminData) {
            User::updateOrCreate(
                ['email' => $adminData['email']],
                [
                    'name' => $adminData['name'],
                    'password' => Hash::make($adminData['password']),
                    'role' => $adminData['role'],
                    'dusun' => $adminData['dusun']
                ]
            );
        }
    }
}
