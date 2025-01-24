<?php

namespace Database\Seeders;

use App\Models\Seat;
use App\Models\Zone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = [Zone::find(3), Zone::find(4)];
        foreach ($zones as $zone) {
            for ($num = 1; $num <= $zone->count_tickets; $num++) {
                Seat::create([
                    'zone_id' => $zone->id,
                    'designation' => "$num"
                ]);
            }
        }
    }
}
