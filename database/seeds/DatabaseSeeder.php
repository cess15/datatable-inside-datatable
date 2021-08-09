<?php

use App\Category;
use App\SubCategory;
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
        Category::create([
            'name' => 'Belleza',
            'status' => 'A'
        ]);

        SubCategory::create([
            'category_id' => 1,
            'name' => 'Shampoo'
        ]);

        SubCategory::create([
            'category_id' => 1,
            'name' => 'Acondicionador'
        ]);

        SubCategory::create([
            'category_id' => 1,
            'name' => 'Maquillaje'
        ]);

        // $this->call(UsersTableSeeder::class);
    }
}
