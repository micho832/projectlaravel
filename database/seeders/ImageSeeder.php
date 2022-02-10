<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->delete();
        Image::factory()->count(100)->create();
    }
}
