<?php

namespace Database\Seeders;
use App\Models\Product;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Product::create([
            'name' => 'Shera High Performance Board',
            'category' => 'SHERA PRO',
            'description' => 'Seamless blend of luxury & functionality—perfect for quick installs.',
            'applications' => json_encode([
                'External Cladding / Façade',
                'Wall Solution',
                'Landscaping',
                'Roof Underlay',
                'External Ceiling',
                'Flooring',
                'CNC Cutting'
            ])
        ]);
    }
}
