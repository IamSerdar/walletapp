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
                'username' => 'admin',
                'password' => 'secretpass',
                'role' => $roles[0],
            ],
        ];
        foreach ($data as $item) {
            $user = User::query()->firstOrNew([
                'username' => $item['username'],
            ]);
            $user->role_code = $item['role'];
            $user->password = Hash::make($item['password']);
            $user->save();
        }
    }
}
