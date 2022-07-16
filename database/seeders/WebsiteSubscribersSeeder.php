<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteSubscribersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++){
            $user_id = User::query()->inRandomOrder()->first()->getAttribute('id');
            /**
             * @var Website $website
             */
            $website = Website::query()->inRandomOrder()->first();
            $website->subscribers()->syncWithoutDetaching($user_id);
        }
    }
}
