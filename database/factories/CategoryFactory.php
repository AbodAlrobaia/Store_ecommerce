<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use Faker\Generator as Faker ;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{

    protected $model = \App\Models\Category::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    public function definition()
    {

        return [
            'name' => $this->faker->word(), //   حنتاج كلمة واحده
            'slug' => $this->faker->slug(),
            'is_active' => $this->faker->boolean(),
            // 'parent_id'=>$this->faker(),

        ];
    }
}
