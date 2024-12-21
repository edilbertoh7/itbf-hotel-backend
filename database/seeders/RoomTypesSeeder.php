<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('room_types')->insert([
            ['name' => 'Estandard', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Junior', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Suite', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
