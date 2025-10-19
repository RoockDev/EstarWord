<?php

namespace Database\Seeders;

use App\Models\Piloto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PilotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Piloto::factory(30)->create();
    }
}
