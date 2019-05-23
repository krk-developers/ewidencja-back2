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
        $this->call(TypesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SuperAdminsTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(EmployersTableSeeder::class);
        $this->call(WorkersTableSeeder::class);
        $this->call(LegendsTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(EmployerWorkerTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
    }
}
