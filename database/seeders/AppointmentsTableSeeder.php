<?php

namespace Database\Seeders;
use App\Models\Appointment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Appointment::create([
            'start_time' => "2020-11-16 03:00:00",
            'finish_time' => "2020-11-16 03:45:00",
            'user_id' => 1,
            'doctor_id' => 2,
            'comments' => "Arm Injury",
            'created_at' => now(),
            'updated_at' => null,
            'deleted_at' => null,

        ]);

        Appointment::create([
            'start_time' => "2020-11-15 01:00:00",
            'finish_time' => "2020-11-15 01:45:00",
            'user_id' => 2,
            'doctor_id' => 4,
            'comments' => "Head Injury",
            'created_at' => now(),
            'updated_at' => null,
            'deleted_at' => null,

        ]);
        Appointment::create([
            'start_time' => "2020-11-15 04:00:00",
            'finish_time' => "2020-11-15 04:45:00",
            'user_id' => 1,
            'doctor_id' => 2,
            'comments' => "Foot Injury",
            'created_at' => now(),
            'updated_at' => null,
            'deleted_at' => null,

        ]);
        Appointment::create([
            'start_time' => "2020-11-18 05:00:00",
            'finish_time' => "2020-11-18 05:45:00",
            'user_id' => 2,
            'doctor_id' => 1,
            'comments' => "Arm Injury",
            'created_at' => now(),
            'updated_at' => null,
            'deleted_at' => null,

        ]);

    }
}
