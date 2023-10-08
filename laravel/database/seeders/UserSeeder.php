<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Professor Smith',
                'email' => 'teacher@test.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'usertype' => 'teacher',
                'approved_at' => now(),
            ],
            [
                'name' => 'QuantumCyber',
                'email' => 'ip1@test.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'usertype' => 'ip',
                'approved_at' => now(),
            ],
            [
                'name' => 'NextGenTech',
                'email' => 'ip2@test.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'usertype' => 'ip',
                'approved_at' => now(),
            ],
            [
                'name' => 'SmartCloud',
                'email' => 'ip3@test.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'usertype' => 'ip',
                'approved_at' => now(),
            ],
            [
                'name' => 'UltimateNet',
                'email' => 'ip4@test.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'usertype' => 'ip',
                'approved_at' => now(),
            ],
            [
                'name' => 'MegaTech',
                'email' => 'ip5@test.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'usertype' => 'ip',
                'approved_at' => now(),
            ],
            [
                'name' => 'FinTech Motion',
                'email' => 'ip6@test.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'usertype' => 'ip',
                'approved_at' => now(),
            ],
            [
                'name' => 'Giga Technology',
                'email' => 'ip7@test.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'usertype' => 'ip',
                'approved_at' => now(),
            ],
        ];
        DB::table('users')->insert($users);
    }
}
