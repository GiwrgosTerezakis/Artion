<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->string('email')->nullable();

            $table->string('phone')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
