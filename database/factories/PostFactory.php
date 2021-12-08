<?php

namespace Database\Factories;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=> User::all()->random()->id, 
            'category_id'=> Category::all()->random()->id,
            'title'=> $this->faker->realText(10), 
            'slug'=> $this->faker->slug, 
            'description'=> $this->faker->text(200), 
            'content'=> $this->faker->paragraphs(1,2), 
            'published'=> true, 
        ];
    }
}
