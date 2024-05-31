<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = Category::factory()->count(5)->create();

        $categories->each(function ($category) {
            $subcategories = Subcategory::factory()->count(3)->create([
                'category_id' => $category->id,
            ]);

            $subcategories->each(function ($subcategory) {
                $childcategories = Childcategory::factory()->count(2)->create([
                    'subcategory_id' => $subcategory->id,
                ]);

                $childcategories->each(function ($childcategory) {
                    Product::factory()->count(10)->create([
                        'childcat_id' => $childcategory->id,
                        'subcat_id' => $childcategory->subcategory_id,
                        'cat_id' => $childcategory->subcategory->category_id,
                    ]);
                });
            });
        });
    }
}
