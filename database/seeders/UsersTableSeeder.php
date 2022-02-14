<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'super admin',
                'email' => 'super_admin@ivas.com',
                'password' => '$2y$10$u2evAW530miwgUb2jcXkTuqIGswxnSQ3DSmX1Ji5rtO3Tx.MtVcX2',
                'image' => '',
                'phone' => '01234567890',
                'remember_token' => 'Xo89ciaTqGbcUuPS2XLEaGySF3l7N8BC3JNc5qiPIdaju7PFrDPaMtzVziAN',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2018-11-26 08:11:50',
            )

        ));


    }
}
