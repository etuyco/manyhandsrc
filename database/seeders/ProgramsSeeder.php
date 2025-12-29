<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use Illuminate\Support\Str;

class ProgramsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programs = [
            [
                'title' => 'Manitoba Community Food Currency Program',
                'slug' => 'food-currency-program',
                'description' => 'Access to fresh, local produce at affordable prices through our Food Currency Program.',
                'content' => 'The Food Currency Program provides community members with access to fresh, locally-sourced produce at reduced prices. Registration opens at the end of May and runs throughout the summer at the Morden Farmers Market.',
                'schedule' => 'Summer - Morden Farmers Market, 4:00 to 6:00pm (Registration opens end of May)',
                'location' => 'Morden Farmers Market',
                'icon' => 'shop',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Community Kitchen',
                'slug' => 'community-kitchen',
                'description' => 'Cooking together, sharing meals, and building community connections.',
                'content' => 'Join us for our Community Kitchen program where we cook together, share meals, and build lasting friendships. This program runs on the second and last Tuesday of each month.',
                'schedule' => 'Second and last Tuesday mornings, 10:00 to 1:00pm',
                'location' => 'Morden Alliance Church',
                'icon' => 'house-heart',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'BAG Program (Better Access to Groceries)',
                'slug' => 'bag-program',
                'description' => 'Buy $15 worth of fruits and vegetables for just $10.',
                'content' => 'Our BAG Program makes fresh produce more accessible to everyone. For just $10, you can get $15 worth of fresh fruits and vegetables.',
                'schedule' => 'Fourth Monday of the Month, 4:30 to 5:30pm',
                'location' => '500 Stephen St',
                'icon' => 'bag',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Community Gardens',
                'slug' => 'community-gardens',
                'description' => 'Summer program from May to October for community gardening.',
                'content' => 'Join our Community Gardens program and grow your own fresh produce while connecting with neighbors. This program runs from May to October.',
                'schedule' => 'May to October',
                'location' => 'Various locations',
                'icon' => 'flower1',
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}
