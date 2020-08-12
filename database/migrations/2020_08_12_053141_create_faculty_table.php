<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('first_slot_id'); 
            $table->foreign('first_slot_id')->references('id')->on('slots');
            $table->unsignedBigInteger('second_slot_id'); 
            $table->foreign('second_slot_id')->references('id')->on('slots');
            $table->unsignedBigInteger('third_slot_id'); 
            $table->foreign('third_slot_id')->references('id')->on('slots');
            $table->unsignedBigInteger('forth_slot_id'); 
            $table->foreign('forth_slot_id')->references('id')->on('slots');
            $table->unsignedBigInteger('fifth_slot_id'); 
            $table->foreign('fifth_slot_id')->references('id')->on('slots');
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
        Schema::dropIfExists('faculties');
    }
}
