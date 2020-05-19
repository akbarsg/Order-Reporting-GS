<?php

use Illuminate\Database\Seeder;

class ReceiverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('receivers')->insert([
            'name' => 'Pondok Gede',
        ]);
        DB::table('receivers')->insert([
            'name' => 'Pondok Cabe',
        ]);
        DB::table('receivers')->insert([
            'name' => 'Pondok Pesantren',
        ]);
    }
}
