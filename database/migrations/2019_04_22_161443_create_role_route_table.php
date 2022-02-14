<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoleRouteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('role_route', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('role_id')->unsigned()->index('role_id_2');
			$table->integer('route_id')->index('route_id_2');
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
		Schema::drop('role_route');
	}

}
