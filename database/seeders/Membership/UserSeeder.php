<?php

namespace Database\Seeders\Membership;

use App\Models\Membership\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'username' => '0640707726',
                'email' => 'amir@gmail.com',
                'password' => Hash::make('amir1234'),
                'first_name' => 'امیررضا',
                'last_name' => 'رضایی',
                'sex_id' => 2,
                'mobile' => '09150531090',
//                'organization_id' => 1,
                'status' => 1,
            ],
            [
                'username' => '0640802230',
                'email' => 'ahmad@gmail.com',
                'password' => Hash::make('ahmad1234'),
                'first_name' => 'احمدعلی',
                'last_name' => 'بی خویش',
                'sex_id' => 2,
                'mobile' => '09906835273',
//                'organization_id' => 1,
                'status' => 1,
            ],
            [
                'username' => '0640779573',
                'email' => 'ali@gmail.com',
                'password' => Hash::make('ali1234'),
                'first_name' => 'علی',
                'last_name' => 'پناهی',
                'sex_id' => 2,
                'mobile' => '09159387321',
//                'organization_id' => 1,
                'status' => 1,
            ],
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
