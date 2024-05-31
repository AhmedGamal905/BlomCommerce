<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function show()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        if (! Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return back()->withErrors([
                'email' => 'The email must be a valid email address.',
            ]);
        }

        return to_route('dashboard.welcome');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return view('admin.login');
    }
}
