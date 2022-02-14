<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('settings')->delete();

        \DB::table('settings')->insert(array (
            0 =>
            array (
                'id' => 25,
                'key' => 'uploadAllow',
                'value' => 'video',
                'created_at' => '2018-02-04 12:04:09',
                'updated_at' => '2019-02-11 15:09:42',
                'type_id' => 6,
                'order' => 0,
            ),
            1 =>
            array (
                'id' => 27,
                'key' => 'enable_testing',
                'value' => '0',
                'created_at' => '2019-02-11 15:14:30',
                'updated_at' => '2019-02-11 15:15:45',
                'type_id' => 7,
                'order' => 0,
            ),
            2 =>
            array (
                'id' => 28,
                'key' => 'content_type_flag',
                'value' => '0',
                'created_at' => '2019-03-07 10:50:04',
                'updated_at' => '2019-03-14 08:54:06',
                'type_id' => 7,
                'order' => 0,
            ),
        ));


    }
}
