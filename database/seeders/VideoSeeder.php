<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Video::factory()->hasComments(rand(1, 5))->hasLikes(rand(1, 5))->count(15)->create();
    }
}
