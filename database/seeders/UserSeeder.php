<?php

namespace Database\Seeders;

use App\Models\TbDetailPembeli;
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
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345'),
                'role' => '1',
                'status' => '1',

            ],
            [
                'name' => 'Pembeli',
                'email' => 'pembeli@gmail.com',
                'password' => Hash::make('12345'),
                'role' => '2',
                'status' => '1',
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $data_user = User::where('role', 2)->first();
        TbDetailPembeli::create([
            'id_user' => $data_user->id,
            'alamat' => "Jalan Gunung Agung",
            'no_wa' => "08287387383",
        ]);
    }
}
