<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("class_id");
            $table->integer("sub_id");
            $table->integer("doctor_id");
            $table->integer("student_id");
            $table->string('status');
            $table->string('grade');

           
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
        Schema::dropIfExists('scheduls');
    }
}
