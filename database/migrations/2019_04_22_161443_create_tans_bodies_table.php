<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTansBodiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tans_bodies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('language_id')->unsigned()->index('tans_bodies_language_id_foreign');
			$table->integer('translatable_id')->unsigned()->index('tans_bodies_translatable_id_foreign');
			$table->text('body');
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
