<?php

namespace Database\Seeders;

//use Faker\Provider\UserAgent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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
        Storage::deleteDirectory('categories');
        Storage::deleteDirectory('products');

        Storage::makeDirectory('categories');
        Storage::makeDirectory('products');
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(DepartmentSeeder::class);
    }
}
