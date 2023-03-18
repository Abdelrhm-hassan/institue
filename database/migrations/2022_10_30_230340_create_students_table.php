<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('code');
            $table->string('password');
            $table->string('token');
            $table->string('photo');
            $table->string('phone');
            $table->string('gender');
            $table->string('level');
            $table->string('gba');
            $table->integer("class_id");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
