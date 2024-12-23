<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table(('hotels'))->insert([
            ['name' => 'Decameron Cartagena','address' => 'Carrera 1A # 10 -10 Bocagrande',
             'city'=>150,'tax_id'=>'123456789','max_rooms'=>42,'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Decameron Panaca','address' => 'Kilometro 7 Vereda Kerman Quimbaya',
             'city'=>828,'tax_id'=>'987654321','max_rooms'=>2,'created_at' => now(), 'updated_at' => now()],

        ]);

    }
}
