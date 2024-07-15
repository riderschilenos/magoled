<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{   
    public function __construct()
    {
        $this->middleware('can:Leer usuarios')->only('index');
        $this->middleware('can:Editar usuarios')->only('edit','update');
        
    }

    public function index() 
    {
        return view('admin.users.index');
    }

    public function usergetin(User $user) 
    {   Auth::login($user);
        return redirect()->route('home');
       
    }

    public function edit(User $user)    
    {   
        $roles= Role::all();

        return view('admin.users.edit',compact('user','roles'));
    }

 
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        
        return redirect()->route('admin.users.edit',$user);

    }

    public function passupdate(Request $request, User $user)
    {
        $user->forceFill([
            'password' => Hash::make($request->password),
        ])->save();
        
        return redirect()->back();

    }

}
