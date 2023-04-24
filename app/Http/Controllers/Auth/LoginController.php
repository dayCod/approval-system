<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function page()
    {
        return view('page.auth.login');
    }

    public function handleAuthenticate(Request $request)
    {
        $result = app('authenticate')->execute($request->except('_token'));

        if (!$result['success']) return back()->with('fail', $result['message'])->onlyInput('email');

        $request->session()->regenerate();

        return redirect()->route('dashboard.home')->with('success', $result['message']);
    }
}
