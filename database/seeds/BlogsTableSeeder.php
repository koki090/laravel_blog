<?php

use Illuminate\Database\Seeder;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blogs = [[
            'id' => 1,
            'user_id' => 1,
            'title' => 'test1作成1',
            'log' => 'test1作成1'], [
            'id' => 2,
            'user_id' => 1,
            'title' => 'test1作成2',
            'log' => 'test1作成2'], [
            'id' => 3,
            'user_id' => 2,
            'title' => 'test2作成1',
            'log' => 'test2作成1'], [
            'id' => 4,
            'user_id' => 2,
            'title' => 'test2作成2',
            'log' => 'test2作成2'], [
            'id' => 5,
            'user_id' => 3,
            'title' => 'test3作成1',
            'log' => 'test3作成1'], [
            'id' => 6,
            'user_id' => 3,
            'title' => 'test3作成2',
            'log' => 'test3作成2']];
        
        foreach($blogs as $blog){
            DB::table('blogs')->insert($blog);
        }
    }
}
