<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function login(){
        return Socialite::driver('google')->redirect();
    }

    public function callback(){

        $user = Socialite::driver('google')->user();
    
        $userExists = User::where('email',$user->email)->first();

        if($userExists){
            Auth::login($userExists);
            return redirect()->route('home');
        }else{
            $userNew=User::create([
                'name'=>$user->name,
                'email'=>$user->email,
                'avatar'=>$user->avatar,
                'external_id'=>$user->id,
                'external_auth'=>'google'
            ]);
            Auth::login($userNew);
            Cache::flush();
            return redirect()->route('home');
        }
        // $user->token
    }
}
