<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(SuperAdminProfilesTableSeeder::class);
        $this->call(AdminProfilesTableSeeder::class);
        $this->call(EmployerProfilesTableSeeder::class);
        $this->call(WorkerProfilesTableSeeder::class);
    }
}
