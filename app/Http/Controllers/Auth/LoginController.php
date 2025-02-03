<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
class LoginController extends Controller
{
    public function create()
    {
   
        return view('auth.login');
    }

    public function store(Request $request)
    {

     
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('products.index'));
        }
        
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    
    public function destroy(Request $request)
    {
        Auth::logout();

        // Redirect to login after logout
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}