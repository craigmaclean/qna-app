<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Bid;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 bids using the factory
        Bid::factory()->count(10)->create();
    }
}
