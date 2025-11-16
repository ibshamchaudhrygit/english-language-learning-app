<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear the table first
        DB::table('badges')->truncate();

        Badge::create([
            'name' => 'First Quiz Completed!',
            'description' => 'You completed your first quiz.',
            'icon_url' => 'https://placehold.co/100x100/a29bfe/ffffff?text=1st'
        ]);

        Badge::create([
            'name' => 'Perfectionist',
            'description' => 'Get a 100% score on any quiz.',
            'icon_url' => 'https://placehold.co/100x100/fdcb6e/ffffff?text=100%25'
        ]);

        Badge::create([
            'name' => 'Grammar Guru',
            'description' => 'Complete 5 grammar quizzes.',
            'icon_url' => 'https://placehold.co/100x100/00b894/ffffff?text=G'
        ]);

        Badge::create([
            'name' => 'Word Wizard',
            'description' => 'Master 100 vocabulary words.',
            'icon_url' => 'https://placehold.co/100x100/6c5ce7/ffffff?text=W'
        ]);
    }
}