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
        // DB::table('accommodations')->insert([
        //     ['name' => 'Sencilla', 'created_at' => now(), 'updated_at' => now()],
        //     ['name' => 'Doble', 'created_at' => now(), 'updated_at' => now()],
        //     ['name' => 'Triple', 'created_at' => now(), 'updated_at' => now()],
        //     ['name' => 'Cuádruple', 'created_at' => now(), 'updated_at' => now()],
        // ]);


        $standardId = DB::table('room_types')->where('name', 'Estandard')->value('id');
        $juniorId = DB::table('room_types')->where('name', 'Junior')->value('id');
        $suiteId = DB::table('room_types')->where('name', 'Suite')->value('id');

        $singleId = DB::table('assignments')->where('name', 'Sencilla')->value('id');
        $doubleId = DB::table('assignments')->where('name', 'Doble')->value('id');
        $tripleId = DB::table('assignments')->where('name', 'Triple')->value('id');
        $quadId = DB::table('assignments')->where('name', 'Cuádruple')->value('id');

        DB::table('accommodations')->insert([
            // Estandard
            ['room_type_id' => $standardId, 'assignment_id' => $singleId, 'created_at' => now(), 'updated_at' => now()],
            ['room_type_id' => $standardId, 'assignment_id' => $doubleId, 'created_at' => now(), 'updated_at' => now()],

            // Junior
            ['room_type_id' => $juniorId, 'assignment_id' => $tripleId, 'created_at' => now(), 'updated_at' => now()],
            ['room_type_id' => $juniorId, 'assignment_id' => $quadId, 'created_at' => now(), 'updated_at' => now()],

            // Suite
            ['room_type_id' => $suiteId, 'assignment_id' => $singleId, 'created_at' => now(), 'updated_at' => now()],
            ['room_type_id' => $suiteId, 'assignment_id' => $doubleId, 'created_at' => now(), 'updated_at' => now()],
            ['room_type_id' => $suiteId, 'assignment_id' => $tripleId, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
