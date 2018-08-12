<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $allData = \App\User::get();
        if(count($allData)<1)
        {
            $admin = new \App\User([
                'name'     => 'admin',
                'email'    => 'admin@bytelab.com.bd',
                'password' => bcrypt('123456'),

            ]);
            $admin->save();
        }
    }
}
