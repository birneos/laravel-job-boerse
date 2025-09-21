<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class RegistredUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
    
      // 1: Validate User 
      /**
       * @description Validierung der Eingabedaten
       * @see https://laravel.com/docs/10.x/validation#available-validation-rules
       * name: 'required|min:3' -> Name ist erforderlich und muss mindestens 3 Zeichen lang sein
       * email: 'required|email|max:254' -> E-Mail ist erforderlich, muss ein gültiges E-Mail-Format haben und darf maximal 254 Zeichen lang sein
       * password: 'unique:users,email' -> E-Mail muss in der users Tabelle, Feld 'email' einzigartig sein
       * password: 'confirmed' -> Passwort muss mit dem Passwort Bestätigungsfeld übereinstimmen, Passwort Rules Password::min(6) -> Passwort muss mindestens 6 Zeichen lang sein
       * password_confirmation: 'same:password' -> Passwort Bestätigungsfeld muss mit dem Passwort übereinstimmen
       */
      $userAttributes = $request->validate([ 
        'name'=>['required','min:3'],
        'email'=>[  'required','email','unique:users,email','max:254'],
        'password'=>['required','confirmed',Password::min(6)],
        'password_confirmation'=>['required','same:password']
        
      ]);


      // 2: Validate Employer

      $employerAttributes = $request->validate([
        'employer'=>['required'],
        'logo'=>['required',File::types(['png','jpg','webp'])->max(5*1024)],
       
      ]);

      // 3: Store User
        $user = User::create($userAttributes);

        // Store Logo by upload, logo instance was automatically created by the validation
        $path = $request->logo->store('logo','public');  // store in storage/app/public/logo


        // Assign Employer to User
        $user->employer()->create([
         //   'name'=>$employerAttributes['name'], //name is the user input field in the view
            'name'=>$employerAttributes['employer'],    //employer is the name of the input field in the view
            'logo'=>$path
        ]);


    // 4: Login user
    Auth::login($user);   
    
    // 5: Redirect to homepage
    return redirect('/')->with('success','Your account has been created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
