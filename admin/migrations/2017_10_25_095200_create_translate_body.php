<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslateBody extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tans_bodies', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('restrict');
            $table->integer('translatable_id')->unsigned();
            $table->foreign('translatable_id')->references('id')->on('translatables')->onDelete('cascade')->onUpdate('restrict');
            
            $table->longText('body');

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
        Schema::drop('tans_bodies');
    }
}
