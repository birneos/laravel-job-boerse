<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email'=>['required','email'],
            'password'=>['required']
        ]);

        // login user
        if( !Auth::attempt($attributes)){
            throw ValidationException::withMessages(['email'=>'E-Mail and Password doesnt match']);
        }

        // regenerate session token
        request()->session()->regenerate();

        // redirect
        return redirect('/jobs'); 
    }

     public function destroy(){
        Auth::logout();
        return redirect('/');
    }


}
