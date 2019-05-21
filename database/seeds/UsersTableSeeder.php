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
        \DB::table('users')->delete();
        
        /*$data = [
        	['id'=>1, 'name'=>'Yazid Asykurillah', 'email'=>'yazasykurillah@gmail.com', 'password'=>\Hash::make('1234')],
        	['id'=>2, 'name'=>'Binar Ilman', 'email'=>'ilman@gmail.com', 'password'=>\Hash::make('1234')],
        ];*/
        //\DB::table('users')->insert($data);
        
        $super_admin = User::create(
            ['id'=>1, 'name'=>'Yazid Asykurillah', 'email'=>'yazasykurillah@gmail.com', 'password'=>\Hash::make('1234')]
        );
        $super_admin->assignRole('super-admin');

        $owner = User::create(
            ['id'=>2, 'name'=>'Binar Ilman', 'email'=>'ilman@gmail.com', 'password'=>\Hash::make('1234')]
        );
        $owner->assignRole('owner');
    }
}
