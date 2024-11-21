<?php

namespace Database\Seeders;

use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ProductFactory::new()->count(100)->create(); // Create 10 products in the database.\
        $products = [
            [
                'category_id' => 1,
                'name' => 'Product 1',
                'price' => 100.00,
                'description' => 'Description of Product 1',
            ],
            [
                'category_id' => 1,
                'name' => 'Product 2',
                'price' => 200.00,
                'description' => 'Description of Product 2',
            ],
            [
                'category_id' => 2,
                'name' => 'Product 3',
                'price' => 300.00,
                'description' => 'Description of Product 3',
            ],
            [
                'category_id' => 2,
                'name' => 'Product 4',
                'price' => 400.00,
                'description' => 'Description of Product 4',
            ],
            [
                'category_id' => 3,
                'name' => 'Product 5',
                'price' => 500.00,
                'description' => 'Description of Product 5',
            ],
            [
                'category_id' => 3,
                'name' => 'Product 6',
                'price' => 600.00,
                'description' => 'Description of Product 6',
            ],
            [
                'category_id' => 4,
                'name' => 'Product 7',
                'price' => 700.00,
                'description' => 'Description of Product 7',
            ],
            [
                'category_id' => 4,
                'name' => 'Product 8',
                'price' => 800.00,
                'description' => 'Description of Product 8',
            ],
            [
                'category_id' => 5,
                'name' => 'Product 9',
                'price' => 900.00,
                'description' => 'Description of Product 9',
            ],
            [
                'category_id' => 5,
                'name' => 'Product 10',
                'price' => 1000.00,
                'description' => 'Description of Product 10',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
