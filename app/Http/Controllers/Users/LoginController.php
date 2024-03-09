<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Users\LoginRequest;

class LoginController extends Controller
{
    /**
     * Show login form
     */
    public function show()
    {
        if (Auth::check()) {
            return redirect()->route('tasks.list');
        }

        return view('users.login');
    }

    /**
     * Submit login form
     */
    public function login(LoginRequest $request)
    {
        $user = Auth::attempt($request->validated());

        if ($user) {
            return redirect()->route('tasks.list');
        }

        // add error message: Invalid credentials to errors list when redirecting
        return redirect()->route('login')->withErrors(['Invalid credentials']);
    }
}
