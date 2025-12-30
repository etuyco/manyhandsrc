<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use App\Models\Event;

class TestRegistrationSeeder extends Seeder
{
    public function run()
    {
        // Create a test program with registration plugin
        Program::create([
            'title' => 'Youth Development Workshop',
            'slug' => 'youth-development-workshop',
            'description' => 'A comprehensive workshop designed to help young people develop essential life skills.',
            'content' => '<p>Join our Youth Development Workshop where participants will learn valuable life skills, leadership techniques, and community engagement strategies.</p>
            
            <p>This program is designed for young people aged 16-25 who want to make a positive impact in their community.</p>
            
            <h4>Program Highlights:</h4>
            <ul>
                <li>Leadership development sessions</li>
                <li>Communication skills training</li>
                <li>Community project planning</li>
                <li>Networking opportunities</li>
            </ul>
            
            <registration></registration>
            
            <p>Space is limited, so please register early to secure your spot!</p>',
            'schedule' => 'Saturdays 9:00 AM - 3:00 PM',
            'location' => 'Morden Alliance Church',
            'icon' => 'mortarboard',
            'is_active' => true,
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        // Create a test event with registration plugin
        Event::create([
            'title' => 'Community Health Fair',
            'description' => 'A health-focused community event with free screenings and wellness activities.',
            'content' => '<p>Our annual Community Health Fair brings together healthcare professionals, wellness experts, and community members for a day focused on health and well-being.</p>
            
            <p>This free event offers health screenings, educational workshops, and fun activities for the whole family.</p>
            
            <h4>What to Expect:</h4>
            <ul>
                <li>Free health screenings (blood pressure, diabetes, vision)</li>
                <li>Wellness workshops and demonstrations</li>
                <li>Kids health activities and games</li>
                <li>Healthy eating samples and recipes</li>
                <li>Information booths from local health organizations</li>
            </ul>
            
            <registration></registration>
            
            <p><strong>Registration helps us plan for the right number of participants and ensures you receive updates about the event.</strong></p>',
            'event_date' => '2024-06-15',
            'start_time' => '09:00:00',
            'end_time' => '15:00:00',
            'location' => 'Morden Community Center',
            'is_active' => true,
            'is_featured' => true,
        ]);
    }
}