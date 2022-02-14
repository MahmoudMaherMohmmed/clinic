<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeleteAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delete_all_flags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('route_id');
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('CASCADE')->onUpdate('CASCADE') ;
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
        Schema::drop('delete_all_flags');
    }
}
