<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\FollowRequest;
use App\User;
use App\Blog;
use App\Follow;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        
    }
    
    public function show($id){
        $user = User::find($id);
        $blogs = Blog::where('user_id', '=', $id)->get();
        $follow_users = $user->follow_users()->get();
        return view('users.show', [
            'title' => 'ユーザー情報',
            'user' => $user,
            'blogs' => $blogs,
            'follow_users' => $follow_users]);
    }

    public function edit($id){
        if(\Auth::id() !== User::find($id)->id){
            return redirect()->route('blogs.index');
        }else{
            return view('users.edit', [
                'title' => 'ユーザー情報編集',
                'user' => \Auth::user()]);
        }
    }

    public function update(UserRequest $request, $id){
        $user = User::find($id);
        $path = '';
        $image = $request->file('image');
        if(isset($image)){
            $path = $image->store('user_images', 'public');
        };
        if($user->image !== ''){
            \Storage::disk('public')->delete(\Storage::url($user->image));
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $path,
            ]);
        return redirect()->route('users.show', $id);
    }
    
    public function follow(FollowRequest $request, $id){
        if(\Auth::user()->isFollowUser($id)){
            Follow::where('user_id', '=', \Auth::id())->where('follow_id', '=', $id)->delete();
            return redirect()->route('blogs.index');
        }else{
            Follow::create($request->only([
                'user_id', 'follow_id']));
                return redirect()->route('blogs.index');
        }
    }

}
