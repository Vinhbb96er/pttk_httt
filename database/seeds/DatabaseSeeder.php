<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FacultiesTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PatientsTableSeeder::class);
        $this->call(RegistrationsTableSeeder::class);
        $this->call(MedicalRecordsTableSeeder::class);
    }
}
