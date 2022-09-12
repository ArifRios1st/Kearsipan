<?php

namespace Database\Seeders;

use App\Models\Servicer;
use Illuminate\Database\Seeder;

class ServicerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Servicer::create([
            'name' => 'Bidang Pelayanan 1',
        ]);
        Servicer::create([
            'name' => 'Bidang Pelayanan 2',
        ]);
    }
}
