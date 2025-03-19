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

    public function createSupplier()
    {
        return view('auth.supplier-login', ['userType' => 'supplier']);
    }

    public function createBusinessTeamMember()
    {
        return view('auth.business-team-member-login', ['userType' => 'business_manager']);
    }

     public function createBusinessManager()
    {
        return view('auth.business-manager-login', ['userType' => 'business_manager']);
    }

    public function createBusinessSearch()
    {
        return view('auth.business-search-login', ['userType' => 'secondary_manager']);
    }


    /**
     * Handle login for all user types.
     */
    public function store(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

    // Authenticate user
    if (Auth::attempt($credentials)) {
        // Define restricted user types
        $restrictedUserTypes = ['global_team', 'global_manager', 'user','supplier','business_team_member','business_manager','secondary_manager'];

        // Check if the authenticated user's user_type is in the restricted list
        if (in_array(Auth::user()->user_type, $restrictedUserTypes)) {
            // Logout the user
            Auth::logout();
            return back()->withErrors(['email' => 'You do not have permission to access the admin login.']);
        }

        // Allow login for other user types
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    // Return error for invalid credentials
    return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function storeGlobalManager(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt(array_merge($credentials, ['user_type' => 'global_manager']))) {
            $request->session()->regenerate();
            return redirect()->intended('/adminapp/get-recruitment');
        }

        return back()->withErrors(['email' => 'Invalid credentials for Global Manager.']);
    }
    public function storeEmployee(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

    // Authenticate user
    if (Auth::attempt($credentials)) {
        // Check user_type
        if (in_array(Auth::user()->user_type, ['global_team', 'user'])) {
            $request->session()->regenerate();
            return redirect()->intended('adminapp/dashboard/view');
        } else {
            // Logout if user_type does not match
            Auth::logout();
            return back()->withErrors(['email' => 'Invalid credentials for Employee.']);
        }
    }

    // Return error for invalid credentials
    return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function storeSupplier(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt(array_merge($credentials, ['user_type' => 'supplier']))) {
            $request->session()->regenerate();
            return redirect()->intended('adminapp/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials for Supplier.']);
    }


    public function storeteamMember(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt(array_merge($credentials, ['user_type' => 'business_team_member']))) {
            $request->session()->regenerate();
            return redirect()->intended('adminapp/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials for Team Member.']);
    }

    public function storebusinessManager(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt(array_merge($credentials, ['user_type' => 'business_manager']))) {
            $request->session()->regenerate();
            return redirect()->intended('adminapp/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials for Team Member.']);
    }
     

    public function storebusinessSearch(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt(array_merge($credentials, ['user_type' => 'Secondary_manager']))) {
            $request->session()->regenerate();
            return redirect()->intended('adminapp/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials for Team Member.']);
    }

    
    





    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/adminapp');
    }
}

