<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class MainController extends Controller
{
    //
    public function register (Request $request){
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|min:8|unique:users|max:100',
            'password' => 'required|string|min:8|max:20',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $save = $user->save();

        if($save){
            return back()->withErrors(['success'=>'User registration success.']);
        }else{
            return back()->withErrors(['fail'=>'Registration failed.']);
        }
    }
}