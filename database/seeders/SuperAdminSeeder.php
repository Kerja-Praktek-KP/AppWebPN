<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'nip' => '1234567890',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('123456789'), // Ganti dengan password yang aman
            'role' => 'Super Admin',
            'bidang' => null,
        ]);
    }
}
