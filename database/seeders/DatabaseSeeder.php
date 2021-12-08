<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
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
        
        //User
        User::factory()->create([
            'email'=>'admin@admin.com',
            'password'=>bcrypt('password')  
        ]);

        User::factory(10)->create();


        //Category
        Category::factory(50)->create();

        //Tags
        Tag::factory(15)->create();

        //Post
        Post::factory(20)->create()->each(function($post){
            $post->tags()->attach($this->tagValue(rand(1,15)));
        });
    }
    
    protected function tagValue($value)
    {
        $tags = [];
        
        for ($i=1; $i< $value; $i++){
            $tags[] = $i;
        };
        return $tags;
    }
}