<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDeleteAllFlagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('delete_all_flags', function(Blueprint $table)
		{
			$table->foreign('route_id')->references('id')->on('routes')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('delete_all_flags', function(Blueprint $table)
		{
			$table->dropForeign('delete_all_flags_route_id_foreign');
		});
	}

}
