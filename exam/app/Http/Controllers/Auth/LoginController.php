<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo()
    {
        if (Auth::guard('admin')->check()) {
            return route('admin.dashboard');
        } elseif (Auth::guard('teacher')->check()) {
            return route('teacher.dashboard');
        } elseif (Auth::guard('users')->check()) {
            return route('student.dashboard');
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $match = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if ($request->role == 1 && Auth::guard('admin')->attempt($match)) {
            return redirect()->route('admin.dashboard');
        } elseif ($request->role == 2 && Auth::guard('teacher')->attempt($match)) {
            return redirect()->route('teacher.dashboard');
        } elseif ($request->role == 3 && Auth::guard('users')->attempt($match)) {
            return redirect()->route('student.dashboard');
        } else {
            return redirect()->route('login')->with('error', 'Invalid Credentials');
        }
    }
}
