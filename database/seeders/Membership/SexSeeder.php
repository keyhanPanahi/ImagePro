<?php

namespace Database\Seeders\Membership;

use App\Models\Membership\Sex;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sexes = [
            ['name' => 'زن' , 'status' => 1],
            ['name' => 'مرد' , 'status' => 1],
        ];

        foreach ($sexes as $sex) {
            Sex::create($sex);
        }
    }
}
