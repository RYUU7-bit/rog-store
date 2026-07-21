<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Only seed once — skip if categories already exist
        if (\App\Models\Category::count() > 0) {
            $this->command->info('Database already seeded, skipping.');
            return;
        }

        $this->call(RogSeeder::class);
    }
}
