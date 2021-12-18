<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $name = $this->faker->sentence(2);
        $category = Category::all()->random();
        $seller = $this->faker->sentence(2);
        $quantity = 50;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomElement([19.99, 29.99, 39.99]),
            'quantity' => $quantity ,
            'status' => 2,
            'category_id' => $category->id,
            'seller' => $seller
        ];
    }
}
