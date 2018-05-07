<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new \App\User();
      $user->name = 'Pietras';
      $user->password = bcrypt('qwerty123');
      $user->email = 'pzdziarski.2001@gmail.com';
      $user->save();
    }
}
