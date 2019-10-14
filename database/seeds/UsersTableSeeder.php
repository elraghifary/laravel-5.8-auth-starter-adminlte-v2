<?php

use App\User;
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
            'name' => 'Elra Ghifary',
            'email' => 'elraghifary@gmail.com',
            'password' => bcrypt('admin'),
            'status' => true
        ]);
    }
}
