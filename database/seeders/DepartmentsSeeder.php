<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('departments')->insert([
        	['divipola_code' => '05' , 'name' => 'ANTIOQUIA','created_at' => now(), 'updated_at' => now()],
            ['divipola_code' => '08' , 'name' => 'ATLANTICO','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '11' , 'name' => 'BOGOTA','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '13' , 'name' => 'BOLIVAR','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '15' , 'name' => 'BOYACA','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '17' , 'name' => 'CALDAS','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '18' , 'name' => 'CAQUETA','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '19' , 'name' => 'CAUCA','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '20' , 'name' => 'CESAR','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '23' , 'name' => 'CORDOBA','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '25' , 'name' => 'CUNDINAMARCA','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '27' , 'name' => 'CHOCO','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '41' , 'name' => 'HUILA','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '44' , 'name' => 'LA GUAJIRA','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '47' , 'name' => 'MAGDALENA','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '50' , 'name' => 'META','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '52' , 'name' => 'NARIÑO','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '54' , 'name' => 'N. DE SANTANDER','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '63' , 'name' => 'QUINDIO','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '66' , 'name' => 'RISARALDA','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '68' , 'name' => 'SANTANDER','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '70' , 'name' => 'SUCRE','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '73' , 'name' => 'TOLIMA','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '76' , 'name' => 'VALLE DEL CAUCA','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '81' , 'name' => 'ARAUCA','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '85' , 'name' => 'CASANARE','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '86' , 'name' => 'PUTUMAYO','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '88' , 'name' => 'SAN ANDRES','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '91' , 'name' => 'AMAZONAS','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '94' , 'name' => 'GUAINIA','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '95' , 'name' => 'GUAVIARE','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '97' , 'name' => 'VAUPES','created_at' => now(), 'updated_at' => now()],
        	['divipola_code' => '99' , 'name' => 'VICHADA','created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
