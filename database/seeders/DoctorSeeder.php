<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Database\Factories\DoctorFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = [
            [
                'full_name' => 'Dr. Alice Johnson',
                'specialty' => 'Cardiology',
                'phone_number' => '0128532654'
            ],
            [
                'full_name' => 'Dr. Bob Smith',
                'specialty' => 'Neurology',
                'phone_number' => '088656595'
            ],
            [
                'full_name' => 'Dr. Carol Williams',
                'specialty' => 'General',
                'phone_number' => '0965685665'
            ]
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }

        // generate dummy data
        DoctorFactory::new()->count(100)->create();
    }
}
