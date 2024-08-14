<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Country;
use App\Models\Organization;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Jose Pinto',
            'email' => 'josepinto.8.26@gmail.com',
            'password' => bcrypt('26.Agosto')
        ]);

        Country::factory(400)->create();
        Organization::factory(200)->create();
        Contact::factory(1000)->create();
    }
}