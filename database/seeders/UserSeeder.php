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
            'email' => 'jorge.2003.26.12@gmail.com',
            'password' => Hash::make('123123123'),
            'dni' => '60609561',
            'phone' => '933084277',
            'address' => 'Av. Paraiso Lomo Largo'
        ])->assignRole('Doctor');
    }
}
