<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\User;
use App\Blog;

class BlogController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        // この部分は直したい
        // $login_user_id = \Auth::id();
        // $follow_users_id = User::find($login_user_id)->follow_users()->pluck('follow_id');
        // $not_follow_users = User::all()->whereNotIn('id', $follow_users_id)->whereNotIn('id', $login_user_id);
        // $not_follow_users = \Auth::user()->not_follow_users();
        // $not_follow_users_id = $not_follow_users->pluck('id');
        // $number_of_displays = 0;
        // if($not_follow_users_id->count() > 5){
        //     $number_of_displays = 5;
        // }else{
        //     $number_of_displays = $not_follow_users_id->count();
        // }
        // $recomend_users = $not_follow_users->random($number_of_displays);
        $recommend_users = \Auth::user()->recommend_users();
        
        //$blogs = Blog::all()->whereNotIn('user_id', $not_follow_users_id)->sortByDesc('created_at');
        $blogs = Blog::MyBlog(\Auth::user()->not_follow_users()->pluck('id'));
        
        return view('blogs.index', [
            'title' => '投稿ブログ一覧',
            'recomend_users' => $recommend_users,
            'blogs' => $blogs]);
    }

    public function create(){
        return view('blogs.create', [
            'title' => '新規投稿']);
    }

    public function store(BlogRequest $request){
        Blog::create($request->only([
            'user_id', 'title', 'log']));
        return redirect()->route('blogs.index');
    }

    public function show($id){
        
    }

    public function edit($id){
        $blog = Blog::find($id);
        return view('blogs.edit', [
            'title' => '投稿内容編集画面',
            'blog' => $blog]);
    }

    public function update(BlogRequest $request, $id){
        Blog::find($id)->update($request->only([
            'title', 'log']));
        return redirect()->route('blogs.index');
    }

    public function destroy($id){
        Blog::find($id)->delete();
        return redirect()->route('blogs.index');
    }
}
