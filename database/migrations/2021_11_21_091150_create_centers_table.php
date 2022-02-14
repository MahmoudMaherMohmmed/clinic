<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centers', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->text('working_days');
            $table->text('from');
            $table->text('to');
            $table->string('email');
            $table->string('contact_email');
            $table->string('phone_1');
            $table->string('phone_2');
            $table->text('facebook_link');
            $table->text('whatsapp_link');
            $table->text('instagram_link');
            $table->string('lat');
            $table->string('lng');
            $table->string('logo'); 
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
        Schema::dropIfExists('centers');
    }
}
