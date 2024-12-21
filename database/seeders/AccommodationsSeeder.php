<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccommodationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('accommodations')->insert([
            ['name' => 'Sencilla', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Doble', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Triple', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cuádruple', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
