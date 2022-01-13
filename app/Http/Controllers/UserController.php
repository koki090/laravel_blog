<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function show($id){
        $user = User::find($id);
        return view('users.show', [
            'title' => 'ユーザー情報',
            'user' => $user]);
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
        User::find($id)->update($request->only([
            'name', 'email']));
        return redirect()->route('users.show', $id);
    }

}
