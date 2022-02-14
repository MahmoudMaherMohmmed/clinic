<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('countries')->delete();
        
        \DB::table('countries')->insert(array (
            0 => 
            array (
                'id' => 3,
                'title' => 'dfgdfgdfg',
                'created_at' => '2021-07-08 09:23:39',
                'updated_at' => '2021-07-08 09:23:39',
            ),
            1 => 
            array (
                'id' => 4,
                'title' => 'asdasd',
                'created_at' => '2021-07-08 09:24:55',
                'updated_at' => '2021-07-08 09:24:55',
            ),
            2 => 
            array (
                'id' => 5,
                'title' => 'asdasdasd',
                'created_at' => '2021-07-08 09:24:57',
                'updated_at' => '2021-07-08 09:24:57',
            ),
            3 => 
            array (
                'id' => 6,
                'title' => 'asdasdasdasd',
                'created_at' => '2021-07-08 09:25:06',
                'updated_at' => '2021-07-08 09:25:06',
            ),
        ));
        
        
    }
}