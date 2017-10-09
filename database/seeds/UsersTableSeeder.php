<?php

use AbleTo\User;
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
        User::create([
           'name' => 'Jonathan Rodriguez',
           'email' => 'jon.j.rodriguez@gmail.com',
           'password' => bcrypt('password')
        ]);

        factory(User::class, 50)->create();
    }
}
