<?php

namespace Database\Seeders;

use Database\Seeders\Admin\Membership\PermissionSeeder;
use Database\Seeders\Admin\Membership\RoleSeeder;
use Database\Seeders\Membership\OrganizationSeeder;
use Database\Seeders\Membership\SexSeeder;
use Database\Seeders\Membership\UserSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
//            PermissionSeeder::class,
//            RoleSeeder::class,
            SexSeeder::class,
//            OrganizationSeeder::class,
            UserSeeder::class,
        ]);
    }
}
