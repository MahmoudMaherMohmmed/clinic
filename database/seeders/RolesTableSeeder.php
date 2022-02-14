<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('roles')->delete();

        \DB::table('roles')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'super_admin',
                'role_priority' => 3,
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
            ),
            1 =>
            array (
                'id' => 6,
                'name' => 'admin',
                'role_priority' => 2,
                'created_at' => '2018-01-08 14:40:19',
                'updated_at' => '2018-01-08 14:40:19',
            ),
        ));


    }
}
