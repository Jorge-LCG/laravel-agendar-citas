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
            'Ortodoncia y Ortopedia Dentofacial',
            'Endodoncia',
            'Periodoncia',
            'Odontopediatría',
            'Rehabilitación Oral',
            'Cirugía Bucal y Maxilofacial',
            'Odontología Estética',
            'Implantología Oral',
            'Patología Bucal',
            'Radiología Oral y Maxilofacial',
            'Medicina Oral',
            'Odontología Forense',
            'Gerodontología',
            'Odontología Preventiva y Comunitaria'
        ];

        foreach($specialties as $speciality)
        {
            Speciality::create([
                'name' => $speciality
            ]);
        }
    }
}
