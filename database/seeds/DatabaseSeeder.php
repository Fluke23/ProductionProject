<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert(
            [
            'username' => '57130500039',
            'group_id' => 'int493',
            'remark' => 'นาย',
            'firstname' => 'นรเสฏฐ์',
            'lastname' => 'พจนศึกษากุล',
            'password' => bcrypt('1807'),
            'change_password' => 'N',
            'passkey' => '1807'
            ]
        );

        DB::table('subject')->insert(
            [
            'subject_id' => 'INT203',
            'subject_name' => 'Database I',
            ]
        );

        DB::table('suiz')->insert(
            [
            'subject_id' => 'INT203',
            'subject_name' => 'Database I',
            ]
        );




    }
}
