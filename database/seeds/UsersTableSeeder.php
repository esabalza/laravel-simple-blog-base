<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Creates the specified user
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Carlos',
            'email' => 'carlos@askmethod.com',
            'password' => bcrypt('ASKMethod'),
        ]);

        factory(User::class, 50)->create();
    }
}
