<?php

// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Video;
use App\Models\Image;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Posts, Videos, Images with Comments
        Post::factory(100)->create();    
        Video::factory(100)->create();  
        Image::factory(100)->create();  
    }
}