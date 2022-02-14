<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRelationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('relations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('scaffoldinterface_id')->unsigned()->index('relations_scaffoldinterface_id_foreign');
			$table->string('to', 191);
			$table->string('having', 191);
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
		Schema::drop('relations');
	}

}
