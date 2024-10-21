<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name'      => 'Electronics',
                'description' => 'Electronic devices and accessories',
            ],
            [
                'name'      => 'Clothing',
                'description' => 'Clothing and accessories',
            ],
            [
                'name'      => 'Books',
                'description' => 'Books and other reading materials',
            ],
            [
                'name'      => 'Furniture',
                'description' => 'Furniture and home decor',
            ],
            [
                'name'      => 'Appliances',
                'description' => 'Home and kitchen appliances',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
