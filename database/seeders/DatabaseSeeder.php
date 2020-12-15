<?php

namespace Database\Seeders;

use App\Models\Section;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Section::factory()
            ->times(15)
            ->hasTasks(3)
            ->create();
    }
}
