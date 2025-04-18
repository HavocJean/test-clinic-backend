<?php

use Illuminate\Database\Seeder;
use App\Models\Specialty;
use Illuminate\Support\Str;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
