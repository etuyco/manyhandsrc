<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = [
            [
                'title' => 'Sit Down Community Meal',
                'slug' => 'community-meal',
                'description' => 'Join us for a community meal and fellowship.',
                'recurrence' => 'Third Tuesday of the Month',
                'start_time' => '17:30:00',
                'location' => 'Morden Alliance Church',
                'is_active' => true,
            ],
            [
                'title' => 'Food Bank and Drop In',
                'slug' => 'food-bank-drop-in',
                'description' => 'Food bank services and drop-in center open to the community.',
                'recurrence' => 'Every Wednesday',
                'start_time' => '12:30:00',
                'end_time' => '16:00:00',
                'location' => '500 Stephen Street',
                'is_active' => true,
            ],
            [
                'title' => 'Drop In',
                'slug' => 'drop-in-evening',
                'description' => 'Evening drop-in sessions for community connection.',
                'recurrence' => 'Thursday Evenings',
                'start_time' => '18:00:00',
                'end_time' => '21:00:00',
                'location' => '500 Stephen Street',
                'is_active' => true,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
