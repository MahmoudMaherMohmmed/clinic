<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScaffoldinterfacesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scaffoldinterfaces', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('package', 191);
			$table->string('migration', 191);
			$table->string('model', 191);
			$table->string('controller', 191);
			$table->string('views', 191);
			$table->string('tablename', 191);
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
		Schema::drop('scaffoldinterfaces');
	}

}
