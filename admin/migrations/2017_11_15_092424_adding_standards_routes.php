<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingStandardsRoutes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        \DB::table('routes')->delete();

        \DB::table('routes')->insert(array (
            0 =>
            array (
                'id' => 1,
                'method' => 'get',
                'route' => 'users',
                'controller_name' => 'UserController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'index',
            ),
            1 =>
            array (
                'id' => 2,
                'method' => 'get',
                'route' => 'users/new',
                'controller_name' => 'UserController ',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'create',
            ),
            2 =>
            array (
                'id' => 3,
                'method' => 'post',
                'route' => 'users',
                'controller_name' => 'UserController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'store',
            ),
            3 =>
            array (
                'id' => 4,
                'method' => 'get',
                'route' => 'dashboard',
                'controller_name' => 'DashboardController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-15 08:28:55',
                'function_name' => ' index',
            ),
            4 =>
            array (
                'id' => 5,
                'method' => 'get',
                'route' => '/',
                'controller_name' => 'DashboardController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'index',
            ),
            5 =>
            array (
                'id' => 6,
                'method' => 'get',
                'route' => 'user_profile',
                'controller_name' => 'UserController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'profile',
            ),
            6 =>
            array (
                'id' => 7,
                'method' => 'post',
                'route' => 'user_profile/updatepassword',
                'controller_name' => 'UserController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-14 12:29:01',
                'function_name' => 'UpdatePassword',
            ),
            7 =>
            array (
                'id' => 8,
                'method' => 'post',
                'route' => 'user_profile/updateprofilepic',
                'controller_name' => 'UserController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-14 12:29:08',
                'function_name' => 'UpdateProfilePicture',
            ),
            8 =>
            array (
                'id' => 9,
                'method' => 'post',
                'route' => 'user_profile/updateuserdata',
                'controller_name' => 'UserController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-14 12:29:19',
                'function_name' => 'UpdateNameAndEmail',
            ),
            9 =>
            array (
                'id' => 10,
                'method' => 'get',
                'route' => 'users/{id}/delete',
                'controller_name' => 'UserController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-15 08:34:32',
                'function_name' => 'destroy',
            ),
            10 =>
            array (
                'id' => 11,
                'method' => 'get',
                'route' => 'users/{id}/edit',
                'controller_name' => 'UserController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-14 12:29:40',
                'function_name' => 'edit',
            ),
            11 =>
            array (
                'id' => 12,
                'method' => 'post',
                'route' => 'users/{id}/update',
                'controller_name' => 'UserController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-14 12:29:49',
                'function_name' => 'update',
            ),
            12 =>
            array (
                'id' => 14,
                'method' => 'get',
                'route' => 'static_translation',
                'controller_name' => 'StaticTranslationController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-14 12:29:57',
                'function_name' => 'index',
            ),
            13 =>
            array (
                'id' => 15,
                'method' => 'get',
                'route' => 'setting',
                'controller_name' => 'SettingController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'index',
            ),
            14 =>
            array (
                'id' => 16,
                'method' => 'get',
                'route' => 'setting/new',
                'controller_name' => 'SettingController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'create',
            ),
            15 =>
            array (
                'id' => 17,
                'method' => 'get',
                'route' => 'setting/{id}/delete',
                'controller_name' => 'SettingController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'destroy',
            ),
            16 =>
            array (
                'id' => 18,
                'method' => 'get',
                'route' => 'setting/{id}/edit',
                'controller_name' => 'SettingController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'edit',
            ),
            17 =>
            array (
                'id' => 19,
                'method' => 'post',
                'route' => 'setting/{id}/update',
                'controller_name' => 'SettingController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'update',
            ),
            18 =>
            array (
                'id' => 20,
                'method' => 'post',
                'route' => 'setting',
                'controller_name' => 'SettingController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'store',
            ),
            19 =>
            array (
                'id' => 21,
                'method' => 'get',
                'route' => 'file_manager',
                'controller_name' => 'DashboardController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'file_manager',
            ),
            20 =>
            array (
                'id' => 22,
                'method' => 'get',
                'route' => 'upload_items',
                'controller_name' => 'DashboardController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'multi_upload',
            ),
            21 =>
            array (
                'id' => 23,
                'method' => 'post',
                'route' => 'save_items',
                'controller_name' => 'DashboardController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'save_uploaded',
            ),
            22 =>
            array (
                'id' => 24,
                'method' => 'get',
                'route' => 'upload_resize',
                'controller_name' => 'DashboardController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'upload_resize',
            ),
            23 =>
            array (
                'id' => 25,
                'method' => 'post',
                'route' => 'save_image',
                'controller_name' => 'DashboardController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'save_image',
            ),
            24 =>
            array (
                'id' => 26,
                'method' => 'post',
                'route' => 'static_translation/{id}/update',
                'controller_name' => 'StaticTranslationController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-12 12:19:46',
                'function_name' => 'update',
            ),
            25 =>
            array (
                'id' => 27,
                'method' => 'get',
                'route' => 'static_translation/{id}/delete',
                'controller_name' => 'StaticTranslationController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'destroy',
            ),
            26 =>
            array (
                'id' => 28,
                'method' => 'get',
                'route' => 'language/{id}/delete',
                'controller_name' => 'LanguageController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'destroy',
            ),
            27 =>
            array (
                'id' => 29,
                'method' => 'post',
                'route' => 'language/{id}/update',
                'controller_name' => 'LanguageController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'update',
            ),
            28 =>
            array (
                'id' => 30,
                'method' => 'get',
                'route' => 'roles',
                'controller_name' => 'RoleController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'index',
            ),
            29 =>
            array (
                'id' => 31,
                'method' => 'get',
                'route' => 'roles/new',
                'controller_name' => 'RoleController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'create',
            ),
            30 =>
            array (
                'id' => 32,
                'method' => 'post',
                'route' => 'roles',
                'controller_name' => 'RoleController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'store',
            ),
            31 =>
            array (
                'id' => 33,
                'method' => 'get',
                'route' => 'roles/{id}/delete',
                'controller_name' => 'RoleController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'destroy',
            ),
            32 =>
            array (
                'id' => 34,
                'method' => 'get',
                'route' => 'roles/{id}/edit',
                'controller_name' => 'RoleController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'edit',
            ),
            33 =>
            array (
                'id' => 35,
                'method' => 'post',
                'route' => 'roles/{id}/update',
                'controller_name' => 'RoleController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'update',
            ),
            34 =>
            array (
                'id' => 36,
                'method' => 'get',
                'route' => 'language',
                'controller_name' => 'LanguageController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'index',
            ),
            35 =>
            array (
                'id' => 37,
                'method' => 'get',
                'route' => 'language/create',
                'controller_name' => 'LanguageController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'create',
            ),
            36 =>
            array (
                'id' => 38,
                'method' => 'post',
                'route' => 'language',
                'controller_name' => 'LanguageController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'store',
            ),
            37 =>
            array (
                'id' => 39,
                'method' => 'get',
                'route' => 'language/{id}/edit',
                'controller_name' => 'LanguageController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'edit',
            ),
            38 =>
            array (
                'id' => 40,
                'method' => 'get',
                'route' => 'all_routes',
                'controller_name' => 'RouteController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'index',
            ),
            39 =>
            array (
                'id' => 41,
                'method' => 'post',
                'route' => 'all_routes',
                'controller_name' => 'RouteController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'store',
            ),
            40 =>
            array (
                'id' => 42,
                'method' => 'get',
                'route' => 'all_routes/{id}/edit',
                'controller_name' => 'RouteController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'edit',
            ),
            41 =>
            array (
                'id' => 43,
                'method' => 'post',
                'route' => 'all_routes/{id}/update',
                'controller_name' => 'RouteController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'update',
            ),
            42 =>
            array (
                'id' => 44,
                'method' => 'get',
                'route' => 'all_routes/{id}/delete',
                'controller_name' => 'RouteController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'destroy',
            ),
            43 =>
            array (
                'id' => 45,
                'method' => 'get',
                'route' => 'all_routes/create',
                'controller_name' => 'RouteController',
                'created_at' => '2017-11-09 06:13:14',
                'updated_at' => '2017-11-09 06:13:14',
                'function_name' => 'create',
            ),
            44 =>
            array (
                'id' => 57,
                'method' => 'get',
                'route' => 'all_routes/index_v2',
                'controller_name' => 'RouteController',
                'created_at' => '2017-11-12 13:45:15',
                'updated_at' => '2017-11-12 14:04:53',
                'function_name' => 'index_v2',
            ),
            45 =>
            array (
                'id' => 58,
                'method' => 'get',
                'route' => 'roles/{id}/view_access',
                'controller_name' => 'RoleController',
                'created_at' => '2017-11-14 10:56:14',
                'updated_at' => '2017-11-15 08:14:14',
                'function_name' => 'view_access',
            ),
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::table('routes')->delete();
    }
}
