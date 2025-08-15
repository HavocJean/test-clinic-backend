<?php
namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use App\Models\Regional;

class RegionalSeeder extends Seeder
{
    public function run()
    {
        $regionals = [
            'Alto Tietê', 'Interior', 'ES', 'SP Interior', 'SP', 'SP2', 'MG', 'Nacional',
            'SP CAV', 'RJ', 'SP1', 'NE1', 'NE2', 'SUL', 'Norte'
        ];

        foreach ($regionals as $regional) {
            $uuid = Uuid::uuid4()->toString();

            Regional::create([
                'uuid' => $uuid,
                'name' => $regional
            ]);
        }
    }
}