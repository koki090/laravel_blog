<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [[
            'id' => 1,
            'name' => 'test1',
            'email' => 'test1@test.com',
            'password' => Hash::make('12345678')], [
            'id' => 2,
            'name' => 'test2',
            'email' => 'test2@test.com',
            'password' => Hash::make('12345678')], [
            'id' => 3,
            'name' => 'test3',
            'email' => 'test3@test.com',
            'password' => Hash::make('12345678')], [
            'id' => 4,
            'name' => 'test4',
            'email' => 'test4@test.com',
            'password' => Hash::make('12345678')], [
            'id' => 5,
            'name' => 'test5',
            'email' => 'test5@test.com',
            'password' => Hash::make('12345678')], [
            'id' => 6,
            'name' => 'test6',
            'email' => 'test6@test.com',
            'password' => Hash::make('12345678')]];
        
        foreach($users as $user){
            DB::table('users')->insert($user);
        }
    }
}
