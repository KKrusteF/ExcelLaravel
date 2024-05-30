<?php

namespace Database\Factories;

use App\Models\Childcategory;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChildcategoryFactory extends Factory
{
    protected $model = Childcategory::class;

    public function definition(): array
    {
        return [
            'childcategory_name' => $this->faker->word,
            'subcategory_id' => Subcategory::factory(),
        ];
    }
}
