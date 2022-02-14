<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('migrations')->delete();

        \DB::table('migrations')->insert(array (
            0 =>
            array (
                'id' => 1,
                'migration' => '2014_10_12_000000_create_users_table',
                'batch' => 1,
            ),
            1 =>
            array (
                'id' => 2,
                'migration' => '2014_10_12_100000_create_password_resets_table',
                'batch' => 1,
            ),
            2 =>
            array (
                'id' => 3,
                'migration' => '2015_10_31_162633_scaffoldinterfaces',
                'batch' => 1,
            ),
            3 =>
            array (
                'id' => 4,
                'migration' => '2017_08_01_141233_create_permission_tables',
                'batch' => 1,
            ),
            4 =>
            array (
                'id' => 5,
                'migration' => '2017_09_20_131500_create_first_user',
                'batch' => 1,
            ),
            5 =>
            array (
                'id' => 6,
                'migration' => '2017_10_16_084836_create_settings_table',
                'batch' => 1,
            ),
            6 =>
            array (
                'id' => 7,
                'migration' => '2017_10_25_094626_create_translatable_table',
                'batch' => 1,
            ),
            7 =>
            array (
                'id' => 8,
                'migration' => '2017_10_25_095102_create_language_table',
                'batch' => 1,
            ),
            8 =>
            array (
                'id' => 9,
                'migration' => '2017_10_25_095200_create_translate_body',
                'batch' => 1,
            ),
            9 =>
            array (
                'id' => 10,
                'migration' => '2017_10_25_113637_add_short_code_and_rtl_to_language',
                'batch' => 1,
            ),
            10 =>
            array (
                'id' => 11,
                'migration' => '2017_10_31_091358_create_static_translations_table',
                'batch' => 1,
            ),
            11 =>
            array (
                'id' => 12,
                'migration' => '2017_10_31_091835_create_static_body_table',
                'batch' => 1,
            ),
            12 =>
            array (
                'id' => 13,
                'migration' => '2017_11_09_081714_create_role_route_table',
                'batch' => 1,
            ),
            13 =>
            array (
                'id' => 14,
                'migration' => '2017_11_09_081714_create_routes_table',
                'batch' => 1,
            ),
            14 =>
            array (
                'id' => 15,
                'migration' => '2017_11_09_081715_add_foreign_keys_to_role_route_table',
                'batch' => 1,
            ),
            15 =>
            array (
                'id' => 16,
                'migration' => '2017_11_14_115606_isolate_controller_from_method',
                'batch' => 1,
            ),
            16 =>
            array (
                'id' => 17,
                'migration' => '2017_11_15_092424_adding_standards_routes',
                'batch' => 1,
            ),
            17 =>
            array (
                'id' => 18,
                'migration' => '2017_12_19_092552_add_type_field_to_settings',
                'batch' => 1,
            ),
            18 =>
            array (
                'id' => 19,
                'migration' => '2018_01_04_081336_adding_priorty_field_to_role_table',
                'batch' => 1,
            ),
            19 =>
            array (
                'id' => 20,
                'migration' => '2018_01_08_074915_phone_col_null',
                'batch' => 1,
            ),
            20 =>
            array (
                'id' => 21,
                'migration' => '2018_01_28_075912_add_type_table_to_template',
                'batch' => 1,
            ),
            21 =>
            array (
                'id' => 22,
                'migration' => '2018_01_28_080917_rename_type_coloumn_in_settings',
                'batch' => 1,
            ),
            22 =>
            array (
                'id' => 23,
                'migration' => '2018_01_28_081429_add_foriegn_keys_to_settings_table',
                'batch' => 1,
            ),
            23 =>
            array (
                'id' => 24,
                'migration' => '2018_01_28_090855_add_order_coloumn_to_settings_table',
                'batch' => 1,
            ),
            24 =>
            array (
                'id' => 25,
                'migration' => '2018_02_04_080901_create_delete_all_table',
                'batch' => 1,
            ),
            25 =>
            array (
                'id' => 26,
                'migration' => '2019_02_10_073431_create_countries_table',
                'batch' => 1,
            ),
            26 =>
            array (
                'id' => 27,
                'migration' => '2019_02_10_073454_create_operators_table',
                'batch' => 1,
            ),
            27 =>
            array (
                'id' => 28,
                'migration' => '2019_02_12_124621_create_categories_table',
                'batch' => 1,
            ),
            28 =>
            array (
                'id' => 29,
                'migration' => '2019_02_12_124712_create_content_types_table',
                'batch' => 1,
            ),
            29 =>
            array (
                'id' => 30,
                'migration' => '2019_02_12_124731_create_contents_table',
                'batch' => 1,
            ),
            30 =>
            array (
                'id' => 31,
                'migration' => '2019_02_12_130119_create_posts_table',
                'batch' => 1,
            ),
            31 =>
            array (
                'id' => 32,
                'migration' => '2019_02_20_073231_change_contnent_path_type',
                'batch' => 1,
            ),
            32 =>
            array (
                'id' => 33,
                'migration' => '2019_02_24_104532_add_parent_id_to_category',
                'batch' => 1,
            ),
        ));


    }
}
