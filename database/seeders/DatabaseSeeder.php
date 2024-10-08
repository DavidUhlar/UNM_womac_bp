<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Komentar;
use App\Models\Oznam;
use App\Models\Tag;
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

        Tag::factory(5)->create();
        Oznam::factory(30)->create();
        Komentar::factory(20)->create();

    }
}
