<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'first_name'        => 'User',
                'last_name'         => 'ITclanBD',
                'email'             => 'user@app.com',
                'password'          => Hash::make('12345678'),
                'type'              => 'user',
                'status'            => 'active',
                'phone'             => '+880 1301055093',
                'email_verified_at' => \Carbon\Carbon::now(),
            ],
            [
                'first_name'        => 'ITclan',
                'last_name'         => 'Admin',
                'email'             => 'itclanadmin@app.com',
                'password'          => Hash::make('12345678'),
                'type'              => 'admin',
                'status'            => 'active',
                'phone'             => '+880 1391055093',
                'email_verified_at' => \Carbon\Carbon::now(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
