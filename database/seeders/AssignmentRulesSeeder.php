<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignmentRulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $standardId = DB::table('room_types')->where('name', 'Estandard')->value('id');
        $juniorId = DB::table('room_types')->where('name', 'Junior')->value('id');
        $suiteId = DB::table('room_types')->where('name', 'Suite')->value('id');

        $singleId = DB::table('accommodations')->where('name', 'Sencilla')->value('id');
        $doubleId = DB::table('accommodations')->where('name', 'Doble')->value('id');
        $tripleId = DB::table('accommodations')->where('name', 'Triple')->value('id');
        $quadId = DB::table('accommodations')->where('name', 'Cuádruple')->value('id');

        DB::table('assignment_rules')->insert([
            // Estandard
            ['room_type_id' => $standardId, 'accommodation_id' => $singleId, 'created_at' => now(), 'updated_at' => now()],
            ['room_type_id' => $standardId, 'accommodation_id' => $doubleId, 'created_at' => now(), 'updated_at' => now()],

            // Junior
            ['room_type_id' => $juniorId, 'accommodation_id' => $tripleId, 'created_at' => now(), 'updated_at' => now()],
            ['room_type_id' => $juniorId, 'accommodation_id' => $quadId, 'created_at' => now(), 'updated_at' => now()],

            // Suite
            ['room_type_id' => $suiteId, 'accommodation_id' => $singleId, 'created_at' => now(), 'updated_at' => now()],
            ['room_type_id' => $suiteId, 'accommodation_id' => $doubleId, 'created_at' => now(), 'updated_at' => now()],
            ['room_type_id' => $suiteId, 'accommodation_id' => $tripleId, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
