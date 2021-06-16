<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name' => 'Business',
            'price' => 49.90,
            'url' => 'business',
            'description' => 'Plano Empresarial',
        ]);
    }
}
