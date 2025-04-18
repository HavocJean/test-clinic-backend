<?php

use Illuminate\Database\Seeder;
use App\Models\Regional;
use Illuminate\Support\Str;

class RegionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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