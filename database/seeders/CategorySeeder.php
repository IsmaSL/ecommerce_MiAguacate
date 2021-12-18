<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Frutas',
                'slug' => Str::slug('Frutas'),
                'icon' => '<i class="fas fa-apple-alt"></i>'
            ],
            [
                'name' => 'Verduras',
                'slug' => Str::slug('Verduras'),
                'icon' => '<i class="fas fa-carrot"></i>'
            ]
        ];

        foreach ($categories as $category) {
            Category::factory(1)->create($category);
        }
    }
}
