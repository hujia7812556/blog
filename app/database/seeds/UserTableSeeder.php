<?php
/**
 * Created by PhpStorm.
 * User: jiahu
 * Date: 2015/4/10
 * Time: 15:56
 */
class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'email' => 'hujia7812556@gmail.com',
            'password' => Hash::make(''),
            'nickname' => 'admin',
            'is_admin' => 1,
        ]);
    }
}