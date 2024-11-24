<?php

namespace Database\Seeders;

use Database\Factories\CarFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CarFactory::new()->count(50)->create();
    }
}
