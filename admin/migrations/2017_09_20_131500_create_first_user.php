<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

class CreateFirstUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user['password'] =  Hash::make(123456) ;
        $user['name'] = "super admin" ;
        $user['phone'] = "01234567890" ;
        $user['email'] = "super_admin@ivas.com" ;
        $user['image'] = "person.jpg" ;

        \DB::table('users')->insert([$user]) ;

        $role['name'] = "super_admin" ;
        $role['role_priority'] = 3 ;
        \DB::table('roles')->insert([$role]) ;

        $user_has_role['role_id'] = 1 ;
        $user_has_role['user_id'] = 1 ;
        \DB::table('user_has_roles')->insert([$user_has_role]) ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::table('users')->where('email','=','super_admin@ivas.com')->delete();
        \DB::table('roles')->where('name','=','super_admin')->delete();

    }
}
