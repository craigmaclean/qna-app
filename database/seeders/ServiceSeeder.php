<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->delete();

        $services = [
            [
                'id' => 1,
                'service_name' => 'Demo',
                'service_description' => fake()->sentence(),
            ],
            [
                'id' => 2,
                'service_name' => 'Framing',
                'service_description' => fake()->sentence(),
            ],
            [
                'id' => 3,
                'service_name' => 'Hang and Finish Rock',
                'service_description' => fake()->sentence(),
            ],
            [
                'id' => 4,
                'service_name' => 'Ceiling',
                'service_description' => fake()->sentence(),
            ],
            [
                'id' => 5,
                'service_name' => 'Paint',
                'service_description' => fake()->sentence(),
            ],
            [
                'id' => 6,
                'service_name' => 'Electrical',
                'service_description' => fake()->sentence(),
            ],
            [
                'id' => 7,
                'service_name' => 'Doors',
                'service_description' => fake()->sentence(),
            ],
            [
                'id' => 8,
                'service_name' => 'Flooring',
                'service_description' => fake()->sentence(),
            ],
            [
                'id' => 9,
                'service_name' => 'Cabinetry',
                'service_description' => fake()->sentence(),
            ],
            [
                'id' => 10,
                'service_name' => 'HVAC',
                'service_description' => fake()->sentence(),
            ],
            [
                'id' => 11,
                'service_name' => 'Sprinkler',
                'service_description' => fake()->sentence(),
            ],
            [
                'id' => 12,
                'service_name' => 'Fire',
                'service_description' => fake()->sentence(),
            ],
            [
                'id' => 13,
                'service_name' => 'Plumbing',
                'service_description' => fake()->sentence(),
            ],
            [
                'id' => 14,
                'service_name' => 'FRP',
                'service_description' => fake()->sentence(),
            ],
            [
                'id' => 15,
                'service_name' => 'Blocking',
                'service_description' => fake()->sentence(),
            ],
        ];

        DB::table('services')->insert($services);
    }
}
