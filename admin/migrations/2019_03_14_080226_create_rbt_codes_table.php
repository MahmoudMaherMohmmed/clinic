<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRbtcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rbt_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('rbt_code');
            $table->integer('content_id')->unsigned();
            $table->foreign('content_id')->references('id')->on('contents')->onUpdate('CASCADE')->onDelete('CASCADE');

            $table->integer('operator_id')->unsigned();
            $table->foreign('operator_id')->references('id')->on('operators')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('rbt_codes');
    }
}
