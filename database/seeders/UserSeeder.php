<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         User::create(
          [ 'name' => 'user',
           'email'=> 'user@gmail.com',
           'password'=>bcrypt('password'),]
       );
    }
}
