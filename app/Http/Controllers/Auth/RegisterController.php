<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function page()
    {
        return view('page.auth.register');
    }

    public function handleRegister(RegisterRequest $request)
    {
        try {
            $result = app('register')->execute($request->validated());

            return redirect()->route('auth.login-page')->with('success', $result['message']);

        } catch (\Exception $err) {
            $result['success'] = false;
            $result['message'] = $err->getMessage();
            $result['data'] = [];

            return back()->with([
                'fail' => $result['message'],
                'result' => $result,
            ]);
        }

    }
}
