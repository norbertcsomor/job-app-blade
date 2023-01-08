<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * A felhasználó bejelentkeztetési űrlapjának megjelenítése.
     * 
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function login()
    {
        return view('users.login');
    }

    /**
     * A felhasználó bejelentkeztetése.
     * 
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function authenticate(AuthRequest $request)
    {
        // dd(auth()->attempt($request->validated()));
        if (auth()->attempt($request->validated())) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'Sikerült a bejelentkezés!');
        }

        return back()->withErrors(['email' => 'Helytelen adatok.'])->onlyInput('email');
    }

    /**
     * A felhasználó kijelentkeztetése.
     * 
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Sikerült a kijelentkezés!');
    }
}
