<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            'role' => 'Admin'
        ];

        \App\UserRole::create($values);

        $values = [
            'role_id' => 1,
            'email' => 'accost_global@yopmail.com',
            'password' => bcrypt('12345678')
        ];

        \App\User::create($values);
    }
}
