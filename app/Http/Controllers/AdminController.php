<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    /**
     * Az admin szerkesztő felületének megjelenítése.
     */
    public function settings()
    {
        return view('admin.settings');
    }
}
