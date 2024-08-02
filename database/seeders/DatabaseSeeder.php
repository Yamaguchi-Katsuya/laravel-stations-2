<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Screen;
use App\Practice;
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
        $this->call([
            SheetTableSeeder::class,
            ScreenTableSeeder::class,
        ]);
    }
}
