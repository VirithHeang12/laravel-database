<?php

namespace Database\Seeders;

use App\Models\Customer;
use Database\Factories\CustomerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $customers = [
        //     ['name' => 'Kim Mana', 'phone' => '012345678'],
        //     ['name' => 'Jimmy Na', 'phone' => '0998765432'],
        //     ['name' => 'Laravel God', 'phone' => '011111111']
        // ];

        // foreach($customers as $customer){
        //     Customer::create($customer);
        // }

        CustomerFactory::new()->count(10)->create();
    }
}
