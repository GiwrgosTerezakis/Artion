<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiTable extends Migration
{
    public function up()
    {
        Schema::create('api', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->longText('text');

            $table->string('author');

            $table->boolean('views');

            $table->date("date_posted");

            $table->timestamps();
        });
    }
}
