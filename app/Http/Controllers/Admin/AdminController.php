<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function displayLogin()
    {
        return view('admin.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6']
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return  to_route('dashboard.welcome');
        }

        return back()->withErrors([
            'email' => 'The email must be a valid email address.',
            'password' => 'The password must be a valid password.'
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return view('admin.login');
    }
}
