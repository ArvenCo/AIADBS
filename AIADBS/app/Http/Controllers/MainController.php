<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Educator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Rule;


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
        $user->role = 'instructor';
        

        $save = $user->save();

        $userId = $user->id;
        
        Educator::insert([
            'user_id'=> $userId,
            'department_id' => $request->department,
            'subjects' => join(', ', request('subjects')),
            'education_office' => $request->education_office,
        ]);


        if($save){
            return back()->withErrors(['success'=>'User registration success.']);
        }else{
            return back()->withErrors(['fail'=>'Registration failed.']);
        }
    }
    
    public function update(Request $request, $id){
        try {
            //code...
            $user = User::find($id);

            
            $checked = $request->has('change-pass');
            
            
            
            if ($checked){
                $request->validate([
                    'email' => ['required','string','min:8','unique:users,email,'.$id,'max:100'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
            }else {
                $request->validate([
                    'email' => ['required','string','min:8','unique:users,email,'.$id,'max:100'],
                ]);
                $user->email = $request->email;
            }
            $save = $user->save();
            if ($save) {
                return ['success' => 'Account updated successfully'];
            }
            
        } catch (ValidationException $e) {
            //throw $th;
            return ['error' => $e->validator->errors()->first()];
        } catch (Exception $e) {
            return ['error' => 'Exception error'];
        }
    }
}