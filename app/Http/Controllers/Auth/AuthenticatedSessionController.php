<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {

        // If the user is not authenticated, show the login page
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Redirect based on role
        $user = Auth::user();
        $role = $user->role;
        switch ($role) {
            case 'admin':
                // dd(redirect()->intended('/admin/users'));
                return redirect('/admin/users');
            case 'sales':
                return redirect('/invoice');
            case 'accounts':
                return redirect('/invoice');
            case 'stock':
                return redirect('/invoice');
            default:
            return redirect('/unauthorized'); // or any other unauthorized response    }
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
