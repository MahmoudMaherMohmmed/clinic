<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRoleRouteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('role_route', function(Blueprint $table)
		{
			$table->foreign('route_id', 'role_route_ibfk_1')->references('id')->on('routes')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('role_id', 'role_route_ibfk_2')->references('id')->on('roles')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('role_route', function(Blueprint $table)
		{
			$table->dropForeign('role_route_ibfk_1');
			$table->dropForeign('role_route_ibfk_2');
		});
	}

}
