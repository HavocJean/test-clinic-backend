<?php

namespace Database\Seeders;

use App\Models\Regional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RegionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regionals = [
            'Alto Tietê', 'Interior', 'ES', 'SP Interior', 'SP', 'SP2', 'MG', 'Nacional',
            'SP CAV', 'RJ', 'SP1', 'NE1', 'NE2', 'SUL', 'Norte'
        ];

        foreach ($regionals as $regional) {
            Regional::create([
                'uuid' => (string) Str::uuid(),
                'name' => $regional
            ]);
        }
    }
}