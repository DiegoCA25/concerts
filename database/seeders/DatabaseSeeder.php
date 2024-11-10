<?php

namespace Database\Seeders;

use App\Models\Concert;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\City::factory(50)->create();
        \App\Models\Artist::factory(25)->create();
        Concert::factory(15)->create();
        //Table Artist_Concert
        for($i=1; $i<=5; $i++){
            $concert = Concert::find($i);
            $concert->artists()->attach(random_int(1,25));
        }
    }
}
