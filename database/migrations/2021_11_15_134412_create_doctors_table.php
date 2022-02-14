<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('subspecialty')->nullable();
            $table->integer('medical_examination_price');
            $table->string('graduation_university')->nullable();
			$table->string('image')->nullable();
            $table->bigInteger('specialty_id')->unsigned();
            $table->timestamps();

            $table->foreign('specialty_id')->references('id')->on('specialties')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
