<?php

use Illuminate\Database\Seeder;

class RegistrationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 30; $i ++) {
            factory(App\Models\Registration::class, 1)->create();
        }
    }
}
