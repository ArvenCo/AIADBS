<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Educator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class MainController extends Controller
{
    //
    public function register (Request $request){
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|min:8|unique:users|max:100',
            
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('iameducator');
        

        $save = $user->save();

        $userId = $user->id;
        
        Educator::insert([
            'user_id'=> $userId,
            'department_id' => $request->department,
            'subjects' => join(', ', request('subjects'))
        ]);


        if($save){
            return back()->withErrors(['success'=>'User registration success.']);
        }else{
            return back()->withErrors(['fail'=>'Registration failed.']);
        }
    }
}
