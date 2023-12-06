<?php

namespace Database\Seeders;

use App\Models\Assignment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('es_ES');
        $status = ['Iniciada', 'Pendiente', 'Completada'];
        for($i = 0; $i < 10; $i++) {
            Assignment::create([
                'name' => $faker->name,
                'description' => $faker->text,
                'status' => $faker->randomElement($status),
            ]);
        }
    }
}
