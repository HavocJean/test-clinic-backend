<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
            'Cardiologia', 'Dermatologia', 'Neurologia', 'Ortopedia', 'Pediatria', 'Psiquiatria'
        ];

        foreach ($specialties as $specialty) {
            Specialty::create([
                'uuid' => Str::uuid(),
                'name' => $specialty
            ]);
        }
    }
}
