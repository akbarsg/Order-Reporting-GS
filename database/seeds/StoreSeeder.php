<?php

use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stores')->insert([
            'name' => 'MUSLIM STYLE FASHION',
            'phone' => '08123456789',
        ]);
        DB::table('stores')->insert([
            'name' => 'SHIDDIEQ STORE',
            'phone' => '08112233445',
        ]);
        DB::table('stores')->insert([
            'name' => 'SHOBIRIN STORE',
            'phone' => '0876543210',
        ]);
    }
}
