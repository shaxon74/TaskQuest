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

        // 自分用アカウント
        // $user = factory(App\User::class)->make([
        //     'name' => 'shaxon74',
        //     'email' => 'shaxon74@gmail.com',
        //     'password' => bcrypt('longagotq'), // password
        // ]);

        factory(\App\User::class, 5)->create();


    }
}
