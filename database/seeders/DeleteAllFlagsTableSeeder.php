<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DeleteAllFlagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('delete_all_flags')->delete();



    }
}
