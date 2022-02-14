<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserHasRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_has_roles', function(Blueprint $table)
		{
			$table->integer('role_id')->unsigned();
			$table->integer('user_id')->unsigned()->index('user_has_roles_user_id_foreign');
			$table->primary(['role_id','user_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_has_roles');
	}

}
