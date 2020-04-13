<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Profile;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Tsukasa',
            'email' => 'tsukasa@email.com',
            'password' => bcrypt('password'),
            // 'admin' => 1
        ]);

        Profile::create([
            'user_id' => $user->id,
            'avatar' => secure_asset('storage/avatar/sample.JPG'),
            'about' => 'Loremewaoiheoiwahgoihewioag',
            'facebook' => 'https://www.facebook.com/tsukasa',
            'youtube' => 'https://www.youtube.com/tsukasa'
        ]);
    }
}
