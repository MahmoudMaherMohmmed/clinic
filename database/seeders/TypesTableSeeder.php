<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('types')->delete();

        \DB::table('types')->insert(array (
            0 =>
            array (
                'id' => 1,
                'title' => 'Advanced Editor',
                'created_at' => '2018-01-28 08:30:05',
                'updated_at' => '2018-01-28 08:30:05',
            ),
            1 =>
            array (
                'id' => 2,
                'title' => 'Normal Editor',
                'created_at' => '2018-01-28 08:30:14',
                'updated_at' => '2018-01-28 08:30:14',
            ),
            2 =>
            array (
                'id' => 3,
                'title' => 'Image',
                'created_at' => '2018-01-28 08:30:29',
                'updated_at' => '2018-01-28 08:30:29',
            ),
            3 =>
            array (
                'id' => 4,
                'title' => 'Video',
                'created_at' => '2018-01-28 08:30:39',
                'updated_at' => '2018-01-28 08:30:39',
            ),
            4 =>
            array (
                'id' => 5,
                'title' => 'Audio',
                'created_at' => '2018-01-28 08:30:47',
                'updated_at' => '2018-01-28 08:30:47',
            ),
            5 =>
            array (
                'id' => 6,
                'title' => 'File Manager Uploads Extensions',
                'created_at' => '2018-01-28 08:30:57',
                'updated_at' => '2018-01-28 08:30:57',
            ),
            6 =>
            array (
                'id' => 7,
                'title' => 'selector',
                'created_at' => '2019-02-11 13:18:52',
                'updated_at' => '2019-02-11 13:18:52',
            ),
        ));


    }
}
