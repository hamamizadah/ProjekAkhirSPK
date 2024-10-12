<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    $users = [
        [
            'name' => 'Min',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'level' => '0',
        ],
        [
            'name' => 'Guru',
            'username' => 'user',
            'password' => bcrypt('user'),
            'level' => '1',
        ],
    ];

    foreach ($users as $user) {
        User::create($user);
    }
    }
}