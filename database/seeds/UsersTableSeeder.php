<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $save_user = new User();
        $save_user->name = "BetIQ Admin";
        $save_user->phone_number = "256787444081";
        $save_user->email = "admin@betiq.pro";
        $save_user->password = Hash::make("password@");
        $save_user->save();
        
    }
}
