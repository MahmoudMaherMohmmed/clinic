<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingPriortyFieldToRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         // Schema::table('roles', function($table) {
         //     $table->integer('role_priority');
         // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('roles', function($table) {
        // $table->dropColumn('role_priority');
        // });
    }
}
