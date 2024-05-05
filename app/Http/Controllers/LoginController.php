<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            switch ($user->role) {
                case 'kasir':
                    return redirect()->intended('/');
                    break;

                case 'admin':
                    return redirect()->intended('/');
                    break;

                case 'owner':
                    return redirect()->intended('/');
                    break;
            }
        }
        return view('auth.index');
    }

    public function cekUserLogin(AuthRequest $request)
    {
        $credential = $request->only('email', 'password');
        $request->session()->regenerate();
        if (Auth::attempt($credential)) {
            $user = Auth::user();
            switch ($user->role) {
                case 'kasir':
                    return redirect()->intended('/');
                    break;

                case 'admin':
                    return redirect()->intended('/');
                    break;

                case 'owner':
                    return redirect()->intended('/');
                    break;
            }
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'notfound' => 'Email or password is wrong '
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
