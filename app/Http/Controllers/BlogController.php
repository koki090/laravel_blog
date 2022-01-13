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
        $blogs = Blog::all();
        return view('blogs.index', [
            'title' => '投稿ブログ一覧',
            'blogs' => $blogs]);
    }

    public function create(){
        return view('blogs.create', [
            'title' => '新規投稿']);
    }

    public function store(BlogRequest $request){
        Blog::create($request->only([
            'title', 'log']));
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
