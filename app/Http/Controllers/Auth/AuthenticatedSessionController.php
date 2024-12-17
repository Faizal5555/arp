<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view for admin.
     */
    public function create()
    {
        return view('auth.login', ['userType' => 'admin']);
    }

    /**
     * Display the login view for Global Manager.
     */
    public function createGlobalManager()
    {
        return view('auth.global-manager-login', ['userType' => 'global-manager']);
    }

    /**
     * Display the login view for Employee.
     */
    public function createEmployee()
    {
        return view('auth.employee-login', ['userType' => 'employee']);
    }

    /**
     * Handle login for all user types.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function storeGlobalManager(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt(array_merge($credentials, ['user_type' => 'global_manager']))) {
            $request->session()->regenerate();
            return redirect()->intended('/adminapp/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials for Global Manager.']);
    }
    public function storeEmployee(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt(array_merge($credentials, ['user_type' => 'user']))) {
            $request->session()->regenerate();
            return redirect()->intended('adminapp/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials for Employee.']);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/adminapp');
    }
}

