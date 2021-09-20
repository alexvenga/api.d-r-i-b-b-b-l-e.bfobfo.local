<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'id'             => 9206115,
            'nickname'       => 'visualideas',
            'name'           => 'Alexey Bubnov',
            'avatar'         => 'https://cdn.dribbble.com/users/9206115/avatars/normal/data?1632045146',
            'is_admin'       => true,
            'remember_token' => Str::random(10),
        ]);

        User::factory(100)->create();

    }
}
