<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Pizza', 'Pasta', 'Desserts'];

        foreach ($categories as $category) {
            $newCategory = Category::create([
                'name' => $category,
                'restaurant_id' => 1
            ]);

            Product::factory()
                ->state([
                    'category_id' => $newCategory->id,
                ])
                ->count(3)
                ->create();
        }
    }
}
