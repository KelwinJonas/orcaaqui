<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Comprador(a)',
            'email' => 'comprador@comprador.com',
            'role' => User::ROLE_ENUM['comprador'],
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Fornecedor(a)',
            'email' => 'fornecedor@fornecedor.com',
            'role' => User::ROLE_ENUM['fornecedor'],
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);
    }
}
