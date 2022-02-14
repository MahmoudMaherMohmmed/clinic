<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('languages')->delete();

        \DB::table('languages')->insert(array (
            0 =>
            array (
                'id' => 1,
                'title' => 'Arabic',
                'created_at' => '2019-02-11 13:12:04',
                'updated_at' => '2019-02-11 13:12:04',
                'short_code' => 'ar',
                'rtl' => '1',
            ),
            1 =>
            array (
                'id' => 2,
                'title' => 'English',
                'created_at' => '2019-02-11 13:12:04',
                'updated_at' => '2019-02-11 13:12:04',
                'short_code' => 'en',
                'rtl' => '0',
            ),
        ));

    }
}
