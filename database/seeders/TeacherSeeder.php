<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Database\Factories\TeacherFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $teachers = [
        //     ['name' => 'John Doe', 'email' => 'johndoe@gmail.com'],
        //     ['name' => 'Jane Doe', 'email' => 'janedoe@gmail.com']
        // ];

        // foreach ($teachers as $teacher) {
        //     Teacher::create($teacher);
        // }
        TeacherFactory::new()->count(10)->create();
    }
}
