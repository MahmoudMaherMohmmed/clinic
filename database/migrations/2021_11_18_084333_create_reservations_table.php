<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned();
            $table->date('date');
            $table->string('from');
            $table->string('to');
            $table->string('patient_name');
            $table->string('phone_number');
            $table->integer('age');
            $table->integer('gender')->default(0)->comment('0=>Male, 1=>Female');
            $table->text('description');
            $table->integer('payment_type')->default(0)->comment('0=>Cash, 1=>Bank transfer');
            $table->integer('status')->default(1)->comment('0=>unacceptable | 1=>Pending | 2=>approved');

            $table->foreign('client_id')->references('id')->on('clients')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('reservations');
    }
}
