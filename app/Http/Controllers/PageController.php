<?php

namespace App\Http\Controllers;

use App\Models\Registration;

class PageController extends Controller
{
    public function landing()
    {
        return view('landing');
    }

    public function registerForm()
    {
        return view('register');
    }

    public function confirmation(string $code)
    {
        $registration = Registration::where('confirmation_code', $code)->firstOrFail();

        return view('confirmation', compact('registration'));
    }
}
