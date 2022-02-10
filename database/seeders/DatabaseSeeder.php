<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
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
        // \App\Models\User::factory(10)->create();
        $this->call([
                 ImageSeeder::class,
                GenderSeeder::class,
                 UserSeeder::class,
                CategorySeeder::class,
                 ProductSeeder::class,
                 ChatsSeeder::class,
                 OrderSeeder::class,
                  OrderDetailSeeder::class,
        ]);
    }
}
