<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {


            $table->foreign('user_id', 'user_fk_360714')->references('id')->on('users');

            $table->foreign('doctor_id', 'doctor_fk_360715')->references('id')->on('doctors');
        });
    }
}
