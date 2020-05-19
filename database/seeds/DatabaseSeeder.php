<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(IndoRegionSeeder::class);
        $this->call(DeliverySeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(ReceiverSeeder::class);
    }
}
