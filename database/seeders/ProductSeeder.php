<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Laptop',
                'description' => 'A portable computer',
                'price' => 500.00,
                'category_id' => 1,
            ],
            [
                'name' => 'Smartphone',
                'description' => 'A mobile phone with advanced features',
                'price' => 300.00,
                'category_id' => 1,
            ],
            [
                'name' => 'T-shirt',
                'description' => 'A casual top',
                'price' => 20.00,
                'category_id' => 2,
            ],
            [
                'name' => 'Jeans',
                'description' => 'A pair of denim pants',
                'price' => 40.00,
                'category_id' => 2,
            ],
            [
                'name' => 'Novel',
                'description' => 'A fictional book',
                'price' => 10.00,
                'category_id' => 3,
            ],
            [
                'name' => 'Cookbook',
                'description' => 'A book of recipes',
                'price' => 15.00,
                'category_id' => 3,
            ],
            [
                'name' => 'Sofa',
                'description' => 'A comfortable couch',
                'price' => 300.00,
                'category_id' => 4,
            ],
            [
                'name' => 'Dining table',
                'description' => 'A table for dining',
                'price' => 200.00,
                'category_id' => 4,
            ],
            [
                'name' => 'Microwave',
                'description' => 'A kitchen appliance',
                'price' => 100.00,
                'category_id' => 5,
            ],
            [
                'name' => 'Refrigerator',
                'description' => 'A large appliance for storing food',
                'price' => 500.00,
                'category_id' => 5,
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
