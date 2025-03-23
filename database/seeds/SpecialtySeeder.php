<?php
namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use App\Models\Specialty;

class SpecialtySeeder extends Seeder
{
    public function run()
    {
        $specialties = [
            'Cardiologia', 'Dermatologia', 'Neurologia', 'Ortopedia', 'Pediatria', 'Psiquiatria'
        ];

        foreach ($specialties as $specialty) {
            Specialty::create([
                'uuid' => Uuid::uuid4()->toString(),
                'name' => $specialty
            ]);
        }
    }
}