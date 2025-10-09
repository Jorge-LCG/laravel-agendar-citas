<?php

namespace Database\Seeders;

use App\Models\Speciality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
            'Odontología General',
            'Ortodoncia',
            'Endodoncia',
            'Periodoncia',
            'Odontopediatría',
            'Rehabilitación Oral',
            'Cirugía Bucal',
            'Odontología Estética',
            'Implantología Oral',
            'Patología Bucal',
            'Maxilofacial',
            'Medicina Oral',
            'Odontología Forense',
            'Gerodontología',
        ];

        foreach($specialties as $speciality)
        {
            Speciality::create([
                'name' => $speciality
            ]);
        }
    }
}
