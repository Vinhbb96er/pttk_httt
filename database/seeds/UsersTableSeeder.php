<?php

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
        factory(App\Models\User::class, 1)->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'role' => 0,
            'status' => 1,
            'account' => 'super admin',
            'password' => 'admin',
        ]);

        factory(App\Models\User::class, 1)->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 1,
            'status' => 1,
            'account' => 'admin',
            'password' => 'admin',
        ]);

        factory(App\Models\User::class, 1)->create([
            'name' => 'Front-desk Staff',
            'email' => 'frontdesk@gmail.com',
            'role' => 2,
            'status' => 1,
            'account' => 'front desk staff',
            'password' => '123123',
        ]);

        factory(App\Models\User::class, 1)->create([
            'name' => 'Faculty Staff',
            'email' => 'faculty@gmail.com',
            'role' => 3,
            'status' => 1,
            'account' => 'faculty staff',
            'password' => '123123',
        ]);

        for ($i = 0; $i < 30; $i ++) {
            factory(App\Models\User::class, 1)->create();
        }
    }
}
