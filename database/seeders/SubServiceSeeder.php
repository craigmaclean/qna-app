<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_services')->delete();

        $sub_services = [
            [
                'service_id' => 1,
                'sub_service_name' => 'Floor Material',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
            [
                'service_id' => 1,
                'sub_service_name' => 'Scope Outside of Standard Demo',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
            [
                'service_id' => 2,
                'sub_service_name' => '1-5/8" 20-gauge Built to the Deck - 20\'',
                'sub_service_description' => '',
                'default_unit_cost' => 40.00,
            ],
            [
                'service_id' => 2,
                'sub_service_name' => '1-5/8" 20-gauge Built to the Deck - 20\' w/ insulation',
                'sub_service_description' => '',
                'default_unit_cost' => 45.00,
            ],
            [
                'service_id' => 2,
                'sub_service_name' => '3-5/8" 20-gauge Built to the Deck - 20\'',
                'sub_service_description' => '',
                'default_unit_cost' => 60.00,
            ],
            [
                'service_id' => 2,
                'sub_service_name' => '3-5/8" 20-gauge Built to the Deck - 20\' w/ Insulation',
                'sub_service_description' => '',
                'default_unit_cost' => 65.00,
            ],
            [
                'service_id' => 2,
                'sub_service_name' => 'Add for Sound Board Insulation',
                'sub_service_description' => '',
                'default_unit_cost' => 5.00,
            ],
            [
                'service_id' => 2,
                'sub_service_name' => '3-5/8" Ceiling Framing',
                'sub_service_description' => '',
                'default_unit_cost' => 75.00,
            ],
            [
                'service_id' => 2,
                'sub_service_name' => '3-5/8" Built to 12\'',
                'sub_service_description' => '',
                'default_unit_cost' => 40.00,
            ],
            [
                'service_id' => 2,
                'sub_service_name' => '3-5/8" Built to 12\' w/ Insulation',
                'sub_service_description' => '',
                'default_unit_cost' => 45.00,
            ],
            [
                'service_id' => 2,
                'sub_service_name' => '3-5/8" Walls Built Under Existing Grid or New Grid',
                'sub_service_description' => '',
                'default_unit_cost' => 40.00,
            ],
            [
                'service_id' => 2,
                'sub_service_name' => '3-5/8" Walls Built Under Existing/New Grid w/ Insulation',
                'sub_service_description' => '',
                'default_unit_cost' => 45.00,
            ],
            [
                'service_id' => 2,
                'sub_service_name' => '6" 20-gauge Built to the Deck - 20\'',
                'sub_service_description' => '',
                'default_unit_cost' => 80.00,
            ],
            [
                'service_id' => 2,
                'sub_service_name' => '6" 20-gauge Built to the Deck - 20 w/ Insulation',
                'sub_service_description' => '',
                'default_unit_cost' => 85.00,
            ],
            [
                'service_id' => 2,
                'sub_service_name' => '6" Ceiling Framing',
                'sub_service_description' => '',
                'default_unit_cost' => 95.00,
            ],
            [
                'service_id' => 2,
                'sub_service_name' => 'Column Wraps',
                'sub_service_description' => '',
                'default_unit_cost' => 450.00,
            ],
            [
                'service_id' => 2,
                'sub_service_name' => 'Hard Lids in The Bathrooms',
                'sub_service_description' => '',
                'default_unit_cost' => 95.00,
            ],
            [
                'service_id' => 2,
                'sub_service_name' => 'Lift Rental',
                'sub_service_description' => '',
                'default_unit_cost' => 600.00,
            ],
            [
                'service_id' => 2,
                'sub_service_name' => 'Misc Items',
                'sub_service_description' => '',
                'default_unit_cost' => 500.00,
            ],
            [
                'service_id' => 3,
                'sub_service_name' => 'One Layer Demising Wall',
                'sub_service_description' => '',
                'default_unit_cost' => 1.50,
            ],
            [
                'service_id' => 3,
                'sub_service_name' => 'Two Layers the Sound Wall',
                'sub_service_description' => '',
                'default_unit_cost' => 3.50,
            ],
            [
                'service_id' => 3,
                'sub_service_name' => 'Hang Rock on Both Sides of 3-5/8" Walls ',
                'sub_service_description' => '',
                'default_unit_cost' => 3.50,
            ],
            [
                'service_id' => 3,
                'sub_service_name' => 'X-Ray Rooms',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
            [
                'service_id' => 3,
                'sub_service_name' => 'Column Wraps',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
            [
                'service_id' => 3,
                'sub_service_name' => 'Touch Up Perimeter Walls',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
            [
                'service_id' => 3,
                'sub_service_name' => 'Hard Lid',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
            [
                'service_id' => 3,
                'sub_service_name' => 'Lift Rental',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
            [
                'service_id' => 3,
                'sub_service_name' => 'Total Rock From Sub',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
            [
                'service_id' => 4,
                'sub_service_name' => 'ACT',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
            [
                'service_id' => 4,
                'sub_service_name' => 'Sheetrock',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
            [
                'service_id' => 4,
                'sub_service_name' => 'Insulation Above ACT',
                'sub_service_description' => '',
                'default_unit_cost' => 12620,
            ],
            [
                'service_id' => 5,
                'sub_service_name' => 'Walls Up To 14 Feet',
                'sub_service_description' => '',
                'default_unit_cost' => 1.50,
            ],
            [
                'service_id' => 5,
                'sub_service_name' => 'Walls Up To 10 Feet',
                'sub_service_description' => '',
                'default_unit_cost' => 1.50,
            ],
            [
                'service_id' => 5,
                'sub_service_name' => 'Open Ceiling',
                'sub_service_description' => '',
                'default_unit_cost' => 2.00,
            ],
            [
                'service_id' => 5,
                'sub_service_name' => 'Hard Lids',
                'sub_service_description' => '',
                'default_unit_cost' => 1.50,
            ],
            [
                'service_id' => 5,
                'sub_service_name' => 'Doors',
                'sub_service_description' => '',
                'default_unit_cost' => 200.00,
            ],
            [
                'service_id' => 5,
                'sub_service_name' => 'Lift Rental',
                'sub_service_description' => '',
                'default_unit_cost' => 600.00,
            ],
            [
                'service_id' => 5,
                'sub_service_name' => 'Misc Items',
                'sub_service_description' => '',
                'default_unit_cost' => 250.00,
            ],
            [
                'service_id' => 6,
                'sub_service_name' => 'Lake Number',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
            [
                'service_id' => 6,
                'sub_service_name' => 'Make Safe',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
            [
                'service_id' => 7,
                'sub_service_name' => 'Misc',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
            [
                'service_id' => 8,
                'sub_service_name' => 'Misc',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
            [
                'service_id' => 9,
                'sub_service_name' => 'Misc',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
            [
                'service_id' => 10,
                'sub_service_name' => 'Misc',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
            [
                'service_id' => 11,
                'sub_service_name' => 'Misc',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
            [
                'service_id' => 12,
                'sub_service_name' => 'Misc',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
            [
                'service_id' => 13,
                'sub_service_name' => 'Misc',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
            [
                'service_id' => 14,
                'sub_service_name' => 'Misc',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
            [
                'service_id' => 15,
                'sub_service_name' => 'Misc',
                'sub_service_description' => '',
                'default_unit_cost' => null,
            ],
        ];

        DB::table('sub_services')->insert($sub_services);
    }
}
