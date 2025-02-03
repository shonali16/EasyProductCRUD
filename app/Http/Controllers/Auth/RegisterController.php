<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    
     public function create()
     {
         return view('auth.register');
     }
     
     public function store(RegisterRequest $request)
     {
         $user = User::create($request->validated());
     
         // Optionally, log in the user after registration
        dd("suces");
     
         return redirect()->route('home')->with('success', 'Registration successful.');
     }
     
     
}
