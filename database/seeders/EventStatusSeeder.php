<?php

namespace Database\Seeders;

use App\Models\EventStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EventStatus::create([
            'name' => 'На согласовании'
        ]);

        EventStatus::create([
            'name' => 'Согласовано'
        ]);

        EventStatus::create([
            'name' => 'Отменено'
        ]);

        EventStatus::create([
            'name' => 'Активно'
        ]);

        EventStatus::create([
            'name' => 'Проведено'
        ]);
    }
}
