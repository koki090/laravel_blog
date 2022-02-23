<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\DeleteImageRequest;
use App\Http\Requests\PushImageRequest;
use App\User;
use App\Blog;
use App\BlogImage;

class BlogController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        $recommend_users = \Auth::user()->recommend_users();
        $blogs = Blog::MyBlog(\Auth::user()->not_follow_users()->pluck('id'))->get();
        return view('blogs.index', [
            'title' => '投稿ブログ一覧',
            'recommend_users' => $recommend_users,
            'blogs' => $blogs]);
    }

    public function create(){
        return view('blogs.create', [
            'title' => '新規投稿']);
    }

    public function store(BlogRequest $request){
        $blog = Blog::create($request->only([
            'user_id', 'title', 'log']));
        foreach($request->file('files') as $image){
            $path = $image->store('blog_images', 'public');
            $blog->blogImages()->create([
                'image' => $path]);
        }
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
        $images = Blog::find($id)->blogImages()->get();
        foreach($images as $image){
            \Storage::disk('public')->delete($image->image);
        }
        Blog::find($id)->delete();
        return redirect()->route('blogs.index');
    }
    
    public function editImage($blog_id){
        $blogImages = Blog::find($blog_id)->blogImages()->get();
        return view('blogs.edit_image', [
            'title' => '画像を選んで削除',
            'blog_id' => $blog_id,
            'blogImages' => $blogImages]);
    }
    
    public function selectDeleteImage(DeleteImageRequest $request, $blog_id){
        foreach($request->get('image_ids') as $id){
            $image = BlogImage::find($id)->image;
            \Storage::disk('public')->delete($image);
            BlogImage::find($id)->delete();
        }
        return redirect()->route('blogs.index');
    }
    
    public function search(Request $request){
        $search_word = $request->get('search_word');
        if(isset($search_word)){
            $search_blogs = Blog::SearchBlogs($search_word)->get();
            return view('blogs.search', [
                'title' => '検索結果',
                'search_word' => $search_word,
                'search_blogs' => $search_blogs]);
        }else{
            return redirect()->route('blogs.index');
        }
    }
    
    public function pushImage($blog_id){
        $blogImages = Blog::find($blog_id)->blogImages()->get();
        return view('blogs.push_image', [
            'title' => '画像を追加',
            'blog_id' => $blog_id,
            'blogImages' => $blogImages]);
    }
    
    public function selectPushImage(PushImageRequest $request, $blog_id){
        foreach($request->file('files') as $image){
            $path = $image->store('blog_images', 'public');
            BlogImage::create([
                'blog_id' => $blog_id,
                'image' => $path]);
        }
        return redirect()->route('blogs.index');
    }
}
