<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function handleLogout(Request $request)
    {
        $result = app('logout')->execute(['user_id' => auth()->id()]);

        if (!$result['success']) return back()->with('fail', $result['message']);

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.login-page')->with('success', $result['message']);
    }
}
