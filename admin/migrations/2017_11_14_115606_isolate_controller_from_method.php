<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IsolateControllerFromMethod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('routes',function(Blueprint $table){
            $table->string('function_name')->nullable();  
            $table->renameColumn('controller_method','controller_name') ; 
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('routes',function(Blueprint $table){
            $table->dropColumn(['function_name']) ;  
            $table->renameColumn('controller_name','controller_method') ; 
        });         
    }
}
