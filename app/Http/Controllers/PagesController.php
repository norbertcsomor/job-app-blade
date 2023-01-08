<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * A kapcsolattartás szolgáló oldal megjelenítése.
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * A kapcsolattartásra szolgáló oldalról email küldése.
     */
    public function email(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
            'name' => ['required', 'min:1'],
            'subject' => ['required', 'min:1'],
            'message' => ['required', 'min:1'],
            
            'accept1' => ['accepted'],
            'accept2' => ['accepted']
        ]);

        return redirect('/')->with('message', 'Sikerült az email elküldése!');
    }

    /**
     * Az oldal felhasználásához kapcsolódó információkat tartalmazó oldal megjelenítése.
     */
    public function informations() {
        return view('pages.informations');
    }
}
