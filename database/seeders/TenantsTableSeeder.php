<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();

        $plan->tenants()->create([
            'cnpj' => '34690155000119',
            'name' => 'Nicollas Silva Soluctions',
            'url' => 'nicollas-silva-soluctions',
            'email' => 'lyod.hp@gmail.com'
        ]);
    }
}
