<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTansBodiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tans_bodies', function(Blueprint $table)
		{
			$table->foreign('language_id')->references('id')->on('languages')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('translatable_id')->references('id')->on('translatables')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tans_bodies', function(Blueprint $table)
		{
			$table->dropForeign('tans_bodies_language_id_foreign');
			$table->dropForeign('tans_bodies_translatable_id_foreign');
		});
	}

}
