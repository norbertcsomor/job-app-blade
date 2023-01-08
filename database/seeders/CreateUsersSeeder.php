<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Ügyintéző',
                'address' => 'xy',
                'telephone' => 'xy',
                'email' => 'admin@jobapp.com',
                'password' => bcrypt('123456'),
                'role' => 'admin',
            ],
            [
                'name' => 'Munkaadó',
                'address' => 'xy',
                'telephone' => 'xy',
                'email' => 'employer@jobapp.com',
                'password' => bcrypt('123456'),
                'role' => 'employer',
            ],
            [
                'name' => 'Álláskereső',
                'address' => 'xy',
                'telephone' => 'xy',
                'email' => 'jobseeker@jobapp.com',
                'password' => bcrypt('123456'),
                'role' => 'jobseeker',
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
