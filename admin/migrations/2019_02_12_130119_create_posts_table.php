<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->date('published_date');
            $table->tinyInteger('active');
            $table->string('patch_number');
            $table->string('url');
            $table->integer('content_id')->unsigned();
            $table->foreign('content_id')->references('id')->on('contents')->onUpdate('CASCADE')->onDelete('CASCADE');

            $table->integer('operator_id')->unsigned();
            $table->foreign('operator_id')->references('id')->on('operators')->onUpdate('CASCADE')->onDelete('CASCADE');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');

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
        Schema::drop('posts');
    }
}
