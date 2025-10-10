<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Jorge Luis',
            'email' => 'correo@gmail.com',
            'password' => Hash::make('123123123'),
            'dni' => '66666666',
            'phone' => '999999999',
            'address' => 'Av. calle ejemplo'
        ])->assignRole('Doctor');
    }
}
