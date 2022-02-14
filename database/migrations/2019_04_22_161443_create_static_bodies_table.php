<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStaticBodiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('static_bodies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('language_id')->unsigned()->index('static_bodies_language_id_foreign');
			$table->integer('static_translation_id')->unsigned()->index('static_bodies_static_translation_id_foreign');
			$table->text('body', 65535);
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
		Schema::drop('static_bodies');
	}

}
