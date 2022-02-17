<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class SubCategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::factory()->count(5)->create([
            'parent_id' => $this->getRandomParentId(),
        ]);

    }

    private function getRandomParentId(){
      $parent=   \App\Models\Category::inRandomOrder()->first();

      return $parent ;
    }
}
