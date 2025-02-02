<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Load job listings from file
        $jobListings = include database_path('seeders/data/job_listings.php');

        // Get Test User ID
        $testUserId = User::where('email', 'test@test.com')->value('id');

        // Get all OTHER user ids from user model
        $userIds = User::where('email', '!=', 'test@test.com')->pluck('id')->toArray();

        foreach($jobListings as $index => &$listing) {
            if ($index < 2) {
                // Assign the first two listings to Test User
                $listing['user_id'] = $testUserId;
            } else {
                // Assign random user_id to listing
                $listing['user_id'] = $userIds[array_rand($userIds)];
            }
            // Add timestamps
            $listing['created_at'] = now();
            $listing['updated_at'] = now();
        }

        // Insert job listing into DB
        DB::table('job_listings')->insert($jobListings);

        echo 'Jobs created successfully!';
    }
}
