<?php

namespace Database\Seeders;

use App\Models\Chat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chats')->delete();
        Chat::factory()->count(1000)->create();
    }
}
