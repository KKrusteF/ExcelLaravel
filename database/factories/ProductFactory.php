<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'vendor_product_id' => $this->faker->unique()->numerify('#####'),
            'ean' => $this->faker->ean13(),
            'model' => $this->faker->word,
            'warranty' => $this->faker->numberBetween(12, 36),
            'handling_time' => $this->faker->numberBetween(1, 5),
            'name' => $this->faker->words(3, true),
            'brand' => $this->faker->company,
            'cat_id' => Category::factory(),
            'subcat_id' => Subcategory::factory(),
            'childcat_id' => Childcategory::factory(),
            'sale_price' => $this->faker->randomFloat(2, 10, 100),
            'original_sale_price' => $this->faker->optional()->randomFloat(2, 20, 150),
            'vat_rate' => $this->faker->randomFloat(2, 5, 20),
            'stock' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->boolean,
        ];
    }
}
