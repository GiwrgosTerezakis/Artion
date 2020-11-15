<?php

namespace Database\Seeders;
use App\Models\Api;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;

class ApiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Api::class,250)->create();


    }
}
