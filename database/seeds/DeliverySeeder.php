<?php

use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deliveries')->insert([
            'name' => 'Ambil sendiri',
        ]);
        DB::table('deliveries')->insert([
            'name' => 'Ninja',
        ]);
        DB::table('deliveries')->insert([
            'name' => 'JNE Reg',
        ]);
        DB::table('deliveries')->insert([
            'name' => 'JNE OKE',
        ]);
        DB::table('deliveries')->insert([
            'name' => 'TIKI',
        ]);
        DB::table('deliveries')->insert([
            'name' => 'JNT',
        ]);
        DB::table('deliveries')->insert([
            'name' => 'Anteraja',
        ]);
        DB::table('deliveries')->insert([
            'name' => 'SiCepat',
        ]);
    }
}
