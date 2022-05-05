<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Login(Request $request){
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        $user = User::where('email',$request->email)->first();
        
        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email' => 'Invalid username or password',
                'password' => $user
            ]);
        }

        return $user->createToken('client token')->accessToken;
    }

    public function index(){
        dd("aslam");
    }

    public function Logout(){
        Auth::user()->tokens->each(function($token, $key) {
            $token->delete();
        });
    
        return response()->json('Successfully logged out');
    }
}
