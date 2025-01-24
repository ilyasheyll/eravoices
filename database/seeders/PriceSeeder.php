<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Price;
use App\Models\Zone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::all();
        $zones = Zone::all();
        foreach ($events as $event) {
            foreach ($zones as $zone) {
                Price::create([
                    'event_id' => $event->id,
                    'zone_id' => $zone->id,
                    'price_value' => fake()->numberBetween(800, 5000)
                ]);
            }
        }
    }
}
