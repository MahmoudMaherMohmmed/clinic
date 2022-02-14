<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRelationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('relations', function(Blueprint $table)
		{
			$table->foreign('scaffoldinterface_id')->references('id')->on('scaffoldinterfaces')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('relations', function(Blueprint $table)
		{
			$table->dropForeign('relations_scaffoldinterface_id_foreign');
		});
	}

}
