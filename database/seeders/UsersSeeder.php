<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $roles = User::defaultRoles();
        $data = [
            [
                'phone' => '61616161',
                'username' => 'admin',
                'password' => '12341234',
                'first_name' => 'Admin',
                'role' => $roles[0],
            ],
            // [
            //     'phone' => '62626262',
            //     'username' => 'director',
            //     'password' => '12341234',
            //     'first_name' => 'Director',
            //     'role' => "$roles[1]",
            // ],
        ];
        foreach ($data as $item) {
            $user = User::query()->firstOrNew([
                'phone' => $item['phone'],
            ]);
            $user->username = $item['username'];
            $user->role_code = $item['role'];
            $user->password = Hash::make($item['password']);
            $user->first_name = $item['first_name'];
            $user->save();
        }
    }
}
