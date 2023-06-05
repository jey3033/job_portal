<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = new User();
        $user->name = "HR Recruit";
        $user->email = "hr.recruit@planetgadget.store";
        $user->email_verified_at = now();
        $user->password = bcrypt('recruitment123456789');
        $user->remember_token = Str::random(10);
        $user->backend = 1;

        $user->save();
    }
}
