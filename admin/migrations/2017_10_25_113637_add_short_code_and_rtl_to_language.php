<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShortCodeAndRtlToLanguage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('languages', function($table) {
            $table->string('short_code');
            $table->boolean('rtl');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('languages', function($table) {
            $table->dropColumn(['short_code']);
            $table->dropColumn(['rtl']);
        });
    }
}
