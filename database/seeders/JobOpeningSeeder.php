<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JobOpeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\JobOpening::factory(20)->create();
    }
}
