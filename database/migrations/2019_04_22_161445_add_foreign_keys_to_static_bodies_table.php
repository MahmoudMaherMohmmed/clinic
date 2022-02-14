<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToStaticBodiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('static_bodies', function(Blueprint $table)
		{
			$table->foreign('language_id')->references('id')->on('languages')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('static_translation_id')->references('id')->on('static_translations')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('static_bodies', function(Blueprint $table)
		{
			$table->dropForeign('static_bodies_language_id_foreign');
			$table->dropForeign('static_bodies_static_translation_id_foreign');
		});
	}

}
