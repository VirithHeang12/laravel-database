<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // CategorySeeder::class,
            // ProductSeeder::class,
            // TeacherSeeder::class,
            CustomerSeeder::class,
            // DoctorSeeder::class,
            // BookSeeder::class,
            //CarSeeder::class
            // SupplierSeeder::class,
        ]);
    }
}
