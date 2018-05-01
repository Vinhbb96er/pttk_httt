<?php

use Illuminate\Database\Seeder;

class MedicalRecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 30; $i ++) {
            factory(App\Models\MedicalRecord::class, 1)->create();
        }
    }
}
